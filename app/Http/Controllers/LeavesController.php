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
        $user = auth()->user();
    
        if ($user->user_role == 'HR Admin') {
            $leaves = Leave::where('Status', 'Pending')->orderBy('created_at', 'desc')->paginate(10);
        } elseif ($user->user_role == 'Partners') {
            $leaves = Leave::where('Status', 'recommended')->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $leaves = Leave::orderBy('created_at', 'desc')->paginate(10); // Default behavior
        }
    
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
    public function show($uuid)
{
    $user = Auth::user();
    $leave = Leave::where('uuid', $uuid)->firstOrFail(); 

    if ($user->user_role == 'Partners') {
        $employee = Employee::where('uuid', $user->uuid)->first();
        $empnum = $employee ? $employee->emp_num : null; // Avoid errors if employee record is missing
    } else {
        $empnum = null;
    }

    return view('leaves.show', compact('leave', 'empnum'));
}


    // Show edit form for a leave application
    public function edit($uuid)
{
    $leave = Leave::where('uuid', $uuid)->first();
    if (!$leave) {
        return redirect()->route('leaves.PersonalLeaves')->with('error', 'Leave not found');
    }

    return view('leaves.edit', compact('leave'));
}


    
    public function update(Request $request, $uuid)
{
    $leave = Leave::where('uuid', $uuid)->firstOrFail(); // Use uuid instead of id
 
    $request->validate([
        'DateOfLeave' => 'required|date',
        'TotalDays' => 'required|integer|min:1',
        'TypeOfLeave' => 'required|string',
        'Remarks' => 'nullable|string',
       'Status' => 'sometimes|string|in:Pending,Approved,Disapproved,Recommended,Cancelled,Declined,Rejected',
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


    public function updateStatus($uuid, $status)
    {
        
        $user = Auth::user();  // Retrieve the authenticated user
        $uuid = $user->uuid;   // Get the user's uuid
        $employee = Employee::where('uuid', $uuid)->firstOrFail(); // Find the employee
        $fullname = $employee->first_name . ' ' . ($employee->middle_name ? $employee->middle_name . ' ' : '') . $employee->surname;

        $leave = Leave::where('uuid', $uuid)->firstOrFail();
        $leave->Status = $status;
        
        if ($status == 'Approved') {
            $leave->ReviewedBy = $fullname;  // Set ApprovedBy to the authenticated user's name
        }

        $leave->save();

        return redirect()->route('leaves.index', $leave->id)
                        ->with('success', "Leave request has been $status.");
    }

    public function archive(Leave $leave)
    {
        $leave->update(['IsArchived' => 1]);
    
        return redirect()->route('leaves.index')->with('success', 'Leave request archived successfully.');
    }
    
    

    public function cancel($uuid)
    {
        $leave = Leave::findOrFail($uuid);
        $leave->Status = 'Cancelled';
        $leave->save();
    
        return redirect()->route('leaves.PersonalLeaves')->with('success', 'Leave request cancelled successfully.');
    }

    public function leavestore(Request $request, $uuid)
    {
        $leave = Leave::where('uuid', $uuid)->firstOrFail();

        $request->validate([
            'LeavesCredits' => 'nullable|numeric',
            'WithPay' => 'nullable|numeric',
            'WithoutPay' => 'nullable|numeric',
            'LessApprovedDays' => 'nullable|numeric',
            'RemainingLeaves' => 'nullable|numeric',
            'FilledUpBy' => 'nullable|string|max:255',
            'FilledUpDate' => 'nullable|date',
        ], [
            'LeavesCredits.required' => 'Leave credits are required.',
            'LeavesCredits.numeric' => 'Leave credits must be a number.',
            'WithPay.required' => 'With pay field is required.',
            'FilledUpDate.date' => 'Invalid date format.',
        ]);
        
        $leave->update([
            'LeavesCredits' => $request->LeavesCredits,
            'WithPay' => $request->WithPay,
            'WithoutPay' => $request->WithoutPay,
            'LessApprovedDays' => $request->LessApprovedDays,
            'RemainingLeaves' => $request->RemainingLeaves,
            'FilledUpBy' => $request->FilledUpBy,
            'FilledUpDate' => $request->FilledUpDate,
            'Status' => 'Recommended',
        ]);

        return redirect()->route('leaves.index') 
                        ->with('success', 'Leave request has been updated and recommended.');
    }   
}
