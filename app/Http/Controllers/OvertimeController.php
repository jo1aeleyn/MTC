<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Overtime;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\TempClient;
use App\Models\ClientAssignment;
use App\Models\Event;
use App\Models\Application;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;


class OvertimeController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->user_role == 'HR Admin') {
            $overtimes = Overtime::where('status', 'pending')->paginate(10);

        }  elseif ($user->user_role == 'Auditing Supervisor') {
            $userUuid = $user->uuid;
        
            // Get the employee record
            $employee = Employee::where('uuid', $userUuid)->first();
        
            if ($employee) {
                $empNum = $employee->emp_num;
        
                // Ensure overtimes are only from employees in the Audit department
                $overtimes = Overtime::whereIn('status', ['recommended', 'pending'])
                    ->whereHas('employee.application', function ($query) {
                        $query->where('DepartmentName', 'Audit');
                    })
                    ->paginate(10);
            } else {
                $overtimes = collect(); // Return empty collection if employee not found
            }

        }   elseif ($user->user_role == 'Accounting Supervisor') {
            $userUuid = $user->uuid;
        
            // Get the employee record
            $employee = Employee::where('uuid', $userUuid)->first();
        
            if ($employee) {
                $empNum = $employee->emp_num;
        
                // Ensure overtimes are only from employees in the Audit department
                $overtimes = Overtime::whereIn('status', ['recommended', 'pending'])
                    ->whereHas('employee.application', function ($query) {
                        $query->where('DepartmentName', 'Accounting');
                    })
                    ->paginate(10);
            } else {
                $overtimes = collect(); // Return empty collection if employee not found
            }

            
        } elseif ($user->user_role == 'Partners') {
            $overtimes = Overtime::whereIn('status', ['recommended', 'approved'])->paginate(10);
        } else {
            $overtimes = Overtime::paginate(10); // Default behavior
        }

        return view('overtime.index', compact('overtimes'));
    }

    public function generatePDF()
    {
        $user = Auth::user();
        $employee = Employee::where('uuid', $user->uuid)->firstOrFail();
        $empnum = $employee->emp_num;

        $overtimes = Overtime::where('is_archived', 0)
        ->where('status', 'approved')
        ->where('emp_num', $empnum)
        ->get();

        if ($overtimes->isEmpty()) {
            return back()->with('error', 'No approved Overtimes available.');
         }


        $pdf = Pdf::loadView('overtime.EmployeeOTSummary', ['overtimes' => $overtimes])
         ->setPaper([0, 0, 612, 1008], 'landscape'); // 8.5 x 13 inches

        return $pdf->download('Overtime_Summary.pdf');
    }

    

    public function archive(Overtime $overtime)
    {
        $user = Auth::user();
        $employee = Employee::where('uuid', $user->uuid)->firstOrFail();
        $fullName = $employee->first_name . ' ' . ($employee->middle_name ? $employee->middle_name . ' ' : '') . $employee->surname;
    
        $overtime->update([
            'is_archived' => 1,
            'archived_by' => $fullName, // Set archived_by in update
        ]);
    
        return redirect()->route('overtime.index')->with('success', 'Overtime request archived successfully.');
    }
    

    public function cancel(Overtime $overtime)
    {
        $overtime->update(['status' => 'Cancelled']);

        return redirect()->route('overtime.personalindex')->with('message', 'Overtime request has been cancelled successfully.');
    }

    public function personalindex()
    {
        $user = Auth::user();
        $employee = Employee::where('uuid', $user->uuid)->firstOrFail();
        $empnum = $employee->emp_num;

        $overtimes = Overtime::where('is_archived', 0)->where('emp_num', $empnum)->paginate(10);  

        return view('overtime.personalindex', compact('overtimes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'client_name' => 'required|string',
        'TotalDuration' => 'required|numeric',
        'DeductedDuration' => 'required|numeric',
        'purpose' => 'nullable|string',
        'request_date' => 'required|date',
        'activitycode' => 'required|string',
        'activityname' => 'required|string',
    ]);

    $user = Auth::user();
    $employee = Employee::where('uuid', $user->uuid)->firstOrFail();
    $fullName = $employee->first_name . ' ' . ($employee->middle_name ? $employee->middle_name . ' ' : '') . $employee->surname;

    $requestDate = Carbon::parse($request->request_date);

    if ($requestDate->isSunday()) {
        $holiday = 'Sunday';
    } else {
        $holiday = Event::whereDate('start_date', '<=', $requestDate)
            ->whereDate('end_date', '>=', $requestDate)
            ->whereIn('holiday_type', [
                'Regular Holiday', 
                'Special Holiday', 
                'Legal Holiday', 
                'Legal Holiday on a Rest Day', 
                'Spcl Holiday on a Rest Day'
            ])
            ->value('holiday_type');
    }

    $typeOfDay = $holiday ?? 'Regular Day';

    $overtime = new Overtime();
    $overtime->uuid = (string) Str::uuid();
    $overtime->emp_num = $employee->emp_num;
    $overtime->emp_name = $fullName;
    $overtime->client_name = $request->client_name;
    $overtime->date_filed = now();
    $overtime->purpose = $request->purpose;
    $overtime->requested_by = $fullName;
    $overtime->request_date = $request->request_date;
    $overtime->Type_of_Day = $typeOfDay;
    $overtime->created_by = auth()->id();
    $overtime->created_at = now();
    $overtime->updated_at = now();
    $overtime->start_time = $request->start_time;
    $overtime->end_time = $request->end_time;
    $overtime->TotalDuration = $request->input('TotalDuration');
    $overtime->DeductedDuration = $request->input('DeductedDuration');
    $overtime->ActivityCode = $request->input('activitycode');
    $overtime->ActivityName = $request->input('activityname');
    
    // Check if user is HR Admin
    if ($user->user_role === 'HR Admin') {
        $overtime->status = 'Recommended';
    }
    
    $overtime->save();

    return redirect()->route('overtime.personalindex')->with('success', 'Overtime Successfully Requested.');
}

    

    public function show(Overtime $overtime)
    {
        $user = Auth::user();
        $employee = Employee::where('uuid', $user->uuid)->firstOrFail();
        $empnum = $employee->emp_num;
        $fullname = $employee->first_name . ' ' . ($employee->middle_name ? $employee->middle_name . ' ' : '') . $employee->surname;


        return view('overtime.show', compact('overtime', 'empnum'));
    }

    public function updateStatus(Request $request, Overtime $overtime, $status)
{
    $user = Auth::user();
    $employee = Employee::where('uuid', $user->uuid)->firstOrFail();
    $fullname = $employee->first_name . ' ' . ($employee->middle_name ? $employee->middle_name . ' ' : '') . $employee->surname;

    // Validate inputs
    $request->validate([
        'deducted_duration' => 'nullable|numeric|min:0',
        'sup_deduction' => 'nullable|numeric|min:0',
        'partner_deduction' => 'nullable|numeric|min:0',
    ]);

    // Assign sup_deduction if user is an Auditing or Accounting Supervisor
    if (in_array($user->user_role, ['Auditing Supervisor', 'Accounting Supervisor']) && $request->has('sup_deduction')) {
        $overtime->sup_deduction = $request->input('sup_deduction');
    }

    // Assign partner_deduction if user is a Partner
    if ($user->user_role === 'Partners' && $request->has('partner_deduction')) {
        $overtime->partner_deduction = $request->input('partner_deduction');
    }

    // Handle approval
    if ($status === 'approved' && $user->user_role === 'Partners') {
        $overtime->approved_by = $fullname;
        $overtime->WithPay = $request->input('WithPay'); 
        $overtime->approved_date = now();
    }

    // Handle recommendation
    if ($status === 'recommended' && $user->user_role === 'HR Admin') {
        $overtime->approved_by = $fullname;
        $overtime->recommended_date = now();
    }

    // Handle rejection
    if ($status === 'Rejected' && in_array($user->user_role, ['Partners', 'Auditing Supervisor', 'Accounting Supervisor'])) {
        $request->validate([
            'rejection_reason' => 'required|string|max:255'
        ]);
        $overtime->approved_by = $fullname;
        $overtime->reason = $request->input('rejection_reason');
        $overtime->approved_date = now();
    }

    $overtime->status = $status;
    $overtime->save();

    return redirect('overtime')->with('success', 'Overtime request updated successfully.');
}

    
    

public function export()
{
    $user = Auth::user();
    $employee = Employee::where('uuid', $user->uuid)->firstOrFail();
    $empnum = $employee->emp_num;

    // Fetch the overtime records
    $overtimes = Overtime::where('is_archived', 0)
                         ->where('emp_num', $empnum)
                         ->where('status', 'approved')
                         ->get(); // Use get() instead of paginate() for PDF generation

    if ($overtimes->isEmpty()) {
        return back()->with('error', 'No approved Overtimes available.');
     }

    // Load the Blade view and set landscape orientation
    $pdf = Pdf::loadView('overtime.ot_request', compact('overtimes'))
              ->setPaper('a4', 'portrait');

    return $pdf->download('Overtime_Requests.pdf');
}

    public function edit($uuid)
    {
        $overtime = Overtime::where('uuid', $uuid)->firstOrFail();

        return view('overtime.edit', compact('overtime'));
    }

    public function create()
{
    $user = auth()->user();
    $employee = Employee::where('uuid', $user->uuid)->first();

    $clients = collect(); // Initialize an empty collection

    if ($employee) {
        // Fetch assigned clients from ClientAssignment
        $assignedClients = ClientAssignment::where('emp_num', $employee->emp_num)
            ->with('client')
            ->get()
            ->map(function ($assignment) {
                return [
                    'name' => $assignment->client->registered_company_name,
                    'type' => 'Assigned'
                ];
            });

        // Define the start of the current payroll period (last 14 days)
        $payrollStart = now()->subDays(14);

        // Fetch only "Approved" temp clients created within the last payroll period
        $tempClients = TempClient::where('emp_num', $employee->emp_num)
            ->where('status', 'Approved')
            ->where('created_at', '>=', $payrollStart) // ✅ Filter last 2 weeks
            ->with('client')
            ->get()
            ->map(function ($tempClient) {
                return [
                    'name' => $tempClient->client->registered_company_name,
                    'type' => 'Temporary'
                ];
            });

        // Merge both collections and remove duplicates based on client name
        $clients = $assignedClients->merge($tempClients)->unique('name');
    }

    return view('overtime.create', compact('clients'));
}





    public function update(Request $request, Overtime $overtime)
{
    $request->validate([
        'emp_name' => 'required|string',
        'client_name' => 'required|string',
        'date_filed' => 'required|date',
        'TotalDuration' => 'required|numeric',
        'DeductedDuration' => 'required|numeric',
        'activitycode' => 'required|string',
        'activityname' => 'required|string',
        'purpose' => 'nullable|string',
    ]);

    $overtime->emp_name = $request->emp_name;
    $overtime->client_name = $request->client_name;
    $overtime->date_filed = $request->date_filed;
    $overtime->TotalDuration = $request->TotalDuration;
    $overtime->DeductedDuration = $request->DeductedDuration;
    $overtime->activitycode = $request->activitycode;
    $overtime->activityname = $request->activityname;
    $overtime->purpose = $request->purpose;
    $overtime->edited_by = auth()->id();
    $overtime->updated_at = now();
    $overtime->save();

    return redirect()->route('overtime.personalindex')->with('success', 'Overtime request updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        $overtime = Overtime::find($uuid);

        if (!$overtime) {
            return response()->json(['message' => 'Overtime request not found'], 404);
        }

        $overtime->delete();

        return response()->json(['message' => 'Overtime request deleted successfully']);
    }
}
