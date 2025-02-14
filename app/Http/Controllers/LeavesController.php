<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leave;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;

class LeavesController extends Controller
{
    // Display all leave applications
    public function index()
    {
        $leaves = Leave::orderBy('created_at', 'desc')->paginate(10);
        return view('leaves.index', compact('leaves'));
    }
    public function PersonalLeaves()
    {

        $user = Auth::user();  // Retrieve the authenticated user
        $uuid = $user->uuid;   // Get the user's uuid
        $employee = Employee::where('uuid', $user->uuid)->firstOrFail();
        $empnum = $employee->emp_num;
        
        $leaves = Leave::where('IsArchived', 0)-> where('emp_num', $empnum)->paginate(10);
        return view('leaves.PersonalLeaves', compact('leaves'));
    }

    // Show form to create a new leave
    public function create()
    {
        return view('leaves.create');
    }

    // Store the new leave in the database
    public function store(Request $request)
    {

        $user = Auth::user();  // Retrieve the authenticated user
        $uuid = $user->uuid;   // Get the user's uuid
        $employee = Employee::where('uuid', $user->uuid)->firstOrFail();
        $empnum = $employee->emp_num;
        $fullname = $employee->first_name . ' ' . ($employee->middle_name ? $employee->middle_name . ' ' : '') . $employee->surname;
        $request->validate([
            'DateOfLeave' => 'required|date',
            'TotalDays' => 'required|integer|min:1',
            'TypeOfLeave' => 'required|string',
            'OtherLeaveType' => 'nullable|string',
            'Remarks' => 'nullable|string',
        ]);

        Leave::create([
            'uuid' => $uuid,
            'emp_num' => $empnum,
            'name' => $fullname,
            'DateOfLeave' => $request->DateOfLeave,
            'TotalDays' => $request->TotalDays,
            'TypeOfLeave' => $request->TypeOfLeave,
            'OtherLeaveType' => $request->TypeOfLeave === 'Other Leave' ? $request->OtherLeaveType : null,
            'Remarks' => $request->Remarks,
        ]);

        return redirect()->route('leaves.PersonalLeaves')->with('success', 'Leave application submitted successfully.');
    }

    // Show details of a leave application
    public function show($id)
    {
        $user = Auth::user();
        $uuid = $user->uuid;
        $employee = Employee::where('uuid', $uuid)->firstOrFail();
        $empnum = $employee->emp_num;
        $leave = Leave::findOrFail($id);
        $empnum = $employee->emp_num; return view('leaves.show', compact('leave','empnum'));
    }

    // Show edit form for a leave application
    public function edit($id)
    {
        $leave = Leave::findOrFail($id);
        return view('leaves.edit', compact('leave'));
    }
    
    public function update(Request $request, $id)
    {
        $leave = Leave::findOrFail($id);
    
        $request->validate([
            'DateOfLeave' => 'required|date',
            'TotalDays' => 'required|integer|min:1',
            'TypeOfLeave' => 'required|string',
            'Remarks' => 'nullable|string',
            'Status' => 'required|string|in:Pending,Approved,Disapproved,Recommended,cancelled,Declined,Rejected',
        ]);
    
        $leave->update([
            'DateOfLeave' => $request->DateOfLeave,
            'TotalDays' => $request->TotalDays,
            'TypeOfLeave' => $request->TypeOfLeave,
            'OtherLeaveType' => $request->TypeOfLeave === 'Other Leave' ? $request->OtherLeaveType : null,
            'Remarks' => $request->Remarks,
            'Status' => $request->Status,
            'EditedBy' => auth()->user()->id,
        ]);
    
        return redirect()->route('leaves.index')->with('success', 'Leave updated successfully.');
    }

    public function updateStatus($id, $status)
    {
        
        $user = Auth::user();  // Retrieve the authenticated user
        $uuid = $user->uuid;   // Get the user's uuid
        $employee = Employee::where('uuid', $uuid)->firstOrFail(); // Find the employee
        $fullname = $employee->first_name . ' ' . ($employee->middle_name ? $employee->middle_name . ' ' : '') . $employee->surname;

        $leave = Leave::findOrFail($id);
        $leave->Status = $status;
        
        if ($status == 'approved') {
            $leave->ReviewedBy = $fullname;  // Set ApprovedBy to the authenticated user's name
        }

        $leave->save();

        return redirect()->route('leaves.index', $leave->id)
                        ->with('success', "Leave request has been $status.");
    }

    // Archive (soft delete) a leave application
    public function archive($id)
    {
        $leave = Leave::findOrFail($id);
        $leave->delete(); // Soft delete

        return redirect()->route('leaves.index')->with('success', 'Leave application archived successfully.');
    }

    public function cancel($id)
    {
        $leave = Leave::findOrFail($id);
        $leave->Status = 'cancelled';
        $leave->save();
    
        return redirect()->route('leaves.PersonalLeaves')->with('success', 'Leave request cancelled successfully.');
    }
     
}
