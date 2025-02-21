<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Overtime;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\ClientAssignment;
use App\Models\Event;
use Barryvdh\DomPDF\Facade\Pdf;


class OvertimeController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->user_role == 'HR Admin') {
            $overtimes = Overtime::where('status', 'pending')->paginate(10);
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

        $overtimes = Overtime::where('is_archived', 0)->where('emp_num', $empnum)->get();

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
            'activitycode' => 'required|string', // Added validation for activity_code
            'activityname' => 'required|string', // Added validation for activity_name
        ]);
    
        $user = Auth::user();
        $employee = Employee::where('uuid', $user->uuid)->firstOrFail();
        $fullName = $employee->first_name . ' ' . ($employee->middle_name ? $employee->middle_name . ' ' : '') . $employee->surname;
    
        // Check if request_date exists in Events table with a holiday type
        $holiday = Event::whereDate('start_date', '<=', $request->request_date)
            ->whereDate('end_date', '>=', $request->request_date)
            ->whereIn('holiday_type', ['Regular Holiday', 'Special Holiday'])
            ->value('holiday_type');
    
        // Set the Type_of_Day based on the holiday check
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
        $overtime->Type_of_Day = $typeOfDay; // Assigning the computed type of day
        $overtime->created_by = auth()->id();
        $overtime->created_at = now();
        $overtime->updated_at = now();
        $overtime->start_time = $request->start_time;
        $overtime->end_time = $request->end_time;
        $overtime->TotalDuration = $request->input('TotalDuration');
        $overtime->DeductedDuration = $request->input('DeductedDuration');
        $overtime->ActivityCode = $request->input('activitycode'); // Added activity_code
        $overtime->ActivityName = $request->input('activityname'); // Added activity_name
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

    if ($status === 'approved' && $user->user_role === 'Partners') {
        $overtime->approved_by = $fullname;
        $overtime->WithPay = $request->input('WithPay'); 
        $overtime->approved_date = now();
    }

    if ($status === 'recommended' && $user->user_role === 'HR Admin') {
        $overtime->approved_by = $fullname;
-        $overtime->recommended_date = now();
    }

    if ($status === 'rejected' && $user->user_role === 'Partners') {
        $request->validate([
            'rejection_reason' => 'required|string|max:255'
        ]);
        $overtime->approved_by = $fullname;
        $overtime->reason = $request->rejection_reason;
        $overtime->approved_date = now();
    }

    $overtime->status = $status;
    $overtime->save();

    return redirect()->back()->with('success', 'Overtime request updated successfully.');
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

        if ($employee) {
            $assignedClients = ClientAssignment::where('emp_num', $employee->emp_num)
                ->with('client')  
                ->get();
        } else {
            $assignedClients = collect();
        }

        return view('overtime.create', compact('assignedClients'));
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
