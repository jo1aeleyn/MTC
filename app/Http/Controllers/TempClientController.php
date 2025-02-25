<?php

namespace App\Http\Controllers;

use App\Models\TempClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\Department;
use App\Models\ClientTbl;

class TempClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Get the logged-in user
    $user = auth()->user();
    
    // Retrieve the employee's emp_num using the UUID
    $employee = Employee::where('uuid', $user->uuid)->first();

    // Initialize an empty collection
    $tempClients = collect();

    if ($employee) {
        if ($user->user_role === 'Partners') {
            // If user is a Partner, get "Recommended" records + their own requests
            $tempClients = TempClient::with(['employee', 'department', 'client', 'requestedByEmployee'])
                ->where('status', 'Recommended')
                ->orWhere('requested_by', $employee->emp_num)
                ->get();
        } else {
            // If not a Partner, get only their own requested records
            $tempClients = TempClient::with(['employee', 'department', 'client', 'requestedByEmployee'])
                ->where('requested_by', $employee->emp_num)
                ->get();
        }
    }

    return view('temp_clients.index', compact('tempClients'));
}

    public function create()
{
    $employees = Employee::all();
    $departments = Department::all();
    $clients = ClientTbl::all();

    return view('temp_clients.create', compact('employees', 'departments', 'clients'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'requested_by' => 'required',
        'DepartmentID' => 'required|exists:departments,id',
        'client_id' => 'required|exists:client_tbl,client_id',
        'purpose' => 'required',
    ]);

    // Get the current logged-in user's UUID
    $user = Auth::user();

    // Fetch the employee record associated with the logged-in user
    $employee = Employee::where('uuid', $user->uuid)->first();

    if (!$employee) {
        return redirect()->back()->with('error', 'Employee record not found.');
    }

    // Create the TempClient record with the employee's emp_num
    TempClient::create([
        'emp_num' => $employee->emp_num, // Get emp_num from   employees table
        'requested_by' =>$request->requested_by,
        'DepartmentID' => $request->DepartmentID,
        'client_id' => $request->client_id,
        'purpose' => $request->purpose,
        'status' => 'Pending'
    ]);

    return redirect()->route('temp.clients.index')->with('success', 'Temporary client added successfully.');
}


    /**
     * Display the specified resource.
     */
    public function show(TempClient $tempClient)
    {
        // Eager load the related employee, department, and client
        $tempClient->load(['requestedByEmployee', 'department', 'client','employee']);
    
        return view('temp_clients.show', compact('tempClient'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TempClient $tempClient)
    {
        return view('temp_clients.edit', compact('tempClient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TempClient $tempClient)
    {
        $request->validate([
            'emp_num' => 'required',
            'DepartmentID' => 'required|exists:departments,id',
            'client_id' => 'required|exists:client_tbl,client_id',
            'status' => 'required|string',
            'purpose' => 'required|string',
        ]);

        $tempClient->update([
            'emp_num' => $request->emp_num,
            'DepartmentID' => $request->DepartmentID,
            'client_id' => $request->client_id,
            'status' => $request->status,
            'purpose' => $request->purpose,
        ]);

        return redirect()->route('temp_clients.index')->with('success', 'Temporary client updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function updateStatus(Request $request, TempClient $tempClient)
    {
        $request->validate([
            'status' => 'required|in:Recommended,Approved',
        ]);
    
        $tempClient->update(['status' => $request->status]);
    
        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }
    
}
