<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Overtime;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\ClientAssignment;

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

    public function archive(Overtime $overtime)
    {
        $overtime->update(['is_archived' => 1]);

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
        ]);

        $user = Auth::user();
        $employee = Employee::where('uuid', $user->uuid)->firstOrFail();
        $fullName = $employee->first_name . ' ' . ($employee->middle_name ? $employee->middle_name . ' ' : '') . $employee->surname;

        $overtime = new Overtime();
        $overtime->uuid = (string) Str::uuid();
        $overtime->emp_num = $employee->emp_num;
        $overtime->emp_name = $fullName;
        $overtime->client_name = $request->client_name;
        $overtime->date_filed = now();
        $overtime->purpose = $request->purpose;
        $overtime->requested_by = $fullName;
        $overtime->request_date = $request->request_date;
        $overtime->created_by = auth()->id();
        $overtime->created_at = now();
        $overtime->updated_at = now();
        $overtime->start_time = $request->start_time;
        $overtime->end_time = $request->end_time;
        $overtime->TotalDuration = $request->input('TotalDuration');
        $overtime->DeductedDuration = $request->input('DeductedDuration');
        $overtime->save();

        return redirect()->route('overtime.personalindex')->with('success', 'Overtime Successfully Requested.');
    }

    public function show(Overtime $overtime)
    {
        $user = Auth::user();
        $employee = Employee::where('uuid', $user->uuid)->firstOrFail();
        $empnum = $employee->emp_num;

        return view('overtime.show', compact('overtime', 'empnum'));
    }

    public function updateStatus($uuid, $status)
    {
        $overtime = Overtime::where('uuid', $uuid)->firstOrFail();
        $overtime->status = $status;
        $overtime->save();

        return redirect()->route('overtime.index')->with('success', 'Overtime status updated to ' . ucfirst($status) . '.');
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
            'purpose' => 'nullable|string',
        ]);

        $overtime->emp_name = $request->emp_name;
        $overtime->client_name = $request->client_name;
        $overtime->date_filed = $request->date_filed;
        $overtime->TotalDuration = $request->TotalDuration;
        $overtime->DeductedDuration = $request->DeductedDuration;
        $overtime->purpose = $request->purpose;
        $overtime->edited_by = auth::id();
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
