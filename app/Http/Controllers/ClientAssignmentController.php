<?php

namespace App\Http\Controllers;

use App\Models\ClientAssignment;
use App\Models\Employee;
use App\Models\ClientTbl;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ClientAssignmentController extends Controller
{
    public function index()
    {
        // Get assignments with relationships for assignedBy, createdBy, editedBy, and archivedBy
        $assignments = ClientAssignment::where('is_archived', false)
            ->with(['assignedBy', 'createdBy', 'editedBy', 'archivedBy'])
            ->latest()
            ->get();
    
        // Manually fetch employee full name (first_name + surname) and client registered_company_name for each assignment
        foreach ($assignments as $assignment) {
            // Fetch employee full name (first_name + surname) based on emp_num
            $employee = Employee::where('emp_num', $assignment->emp_num)->first();
            if ($employee) {
                $assignment->employee_name = $employee->first_name . ' ' . $employee->surname;
            }
    
            // Fetch client's registered_company_name based on client_id
            $client = ClientTbl::where('client_id', $assignment->client_id)->first();
            if ($client) {
                $assignment->client_name = $client->registered_company_name;
            }
    
            // Fetch assignedBy user details using id (assigned_by column is storing the UserAccount id)
            $assignedByUser = UserAccount::find($assignment->assigned_by);
            if ($assignedByUser) {
                // Get Employee details using uuid from the UserAccount
                $employeeAssignedBy = Employee::where('uuid', $assignedByUser->uuid)->first();
                if ($employeeAssignedBy) {
                    // Combine first_name and surname for the full name
                    $assignment->assigned_by_name = $employeeAssignedBy->first_name . ' ' . $employeeAssignedBy->surname;
                }
            }
        }
    
        return view('client_assignments.index', compact('assignments'));
    }
    
    public function create()
    {
        $employees = Employee::all();
        $clients = ClientTbl::all();

        return view('client_assignments.create', compact('employees', 'clients'));
    }

    public function store(Request $request)
{
    // Validate employee and client
    $request->validate([
        'emp_num' => 'required|exists:employees,emp_num',  // Ensure emp_num is validated correctly
        'client_id' => 'required|exists:client_tbl,client_id',  // Ensure client_id is validated correctly
    ]);

    // Create new client assignment
    ClientAssignment::create([
        'uuid' => Str::uuid(),
        'emp_num' => $request->emp_num,  // Ensure you are using the correct field names
        'client_id' => $request->client_id,
        'assigned_by' => Auth::id(),
        'created_by' => Auth::id(),
        'edited_by' => null, 
        'is_archived' => false,
    ]);

    return redirect()->route('client.assignment.index')->with('success', 'Client assigned successfully.');
}


    public function edit($uuid)
    {
        $assignment = ClientAssignment::where('uuid', $uuid)->firstOrFail();
        $employees = Employee::all();
        $clients = ClientTbl::all();
        return view('client_assignments.edit', compact('assignment', 'employees', 'clients'));
    }

    public function update(Request $request, $uuid)
    {
        $request->validate([
            'emp_num' => 'required|exists:employees,emp_num',
            'client_id' => 'required|exists:client_tbl,client_id',
        ]);

        $assignment = ClientAssignment::where('uuid', $uuid)->firstOrFail();
        $assignment->update([
            'emp_num' => $request->emp_num,
            'client_id' => $request->client_id,
            'edited_by' => Auth::id(),
        ]);

        return redirect()->route('client.assignment.index')->with('success', 'Client assignment updated successfully.');
    }
    
    public function archive($uuid)
    {
        $assignment = ClientAssignment::where('uuid', $uuid)->firstOrFail();
    
        $assignment->is_archived = true;
        $assignment->archived_by = Auth::id();
        
        if ($assignment->save()) {
            return redirect()->route('client.assignment.index')->with('success', 'Client assignment archived successfully.');
        }
    
        return redirect()->route('client.assignment.index')->with('error', 'Failed to archive assignment.');
    }
    
}
