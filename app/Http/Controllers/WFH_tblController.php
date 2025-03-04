<?php

namespace App\Http\Controllers;

use App\Models\WFH_tbl;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\TempClient;
use App\Models\ClientAssignment;


class WFH_tblController extends Controller
{
    public function index()
{
    $wfh_requests = WFH_tbl::where('IsArchived', 0)->paginate(10);


    // Fetch only one employee (assuming all records have the same emp_num)
    $employee = Employee::whereIn('emp_num', $wfh_requests->pluck('emp_num'))->first();

    return view('wfh.index', compact('wfh_requests', 'employee'));
}

    
    public function personalindex()
{
    $user = Auth::user();
    $employee = Employee::where('uuid', $user->uuid)->firstOrFail();
    $empnum = $employee->emp_num;

    $wfh_requests = WFH_tbl::where('IsArchived', 0)
        ->where('emp_num', $empnum)
        ->select('uuid', 'Date_filed', 'Date_WFH', 'client_name', 'Status') // Select only relevant columns
        ->groupBy('uuid', 'Date_filed', 'Date_WFH', 'client_name', 'Status') // Group by UUID and relevant columns
        ->paginate(10);

    return view('wfh.personalWFH', compact('wfh_requests', 'employee'));
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
        return view('wfh.create', compact('clients'));
    }

    public function store(Request $request)
{
    $request->validate([
        'client_name' => 'required',
        'Date_filed' => 'required|date',
        'Date_WFH' => 'required|date',
        'Engagement' => 'required|string|max:255',
        'Budgetted_time' => 'required|array',
        'Budgetted_time.*' => 'required|numeric|min:1',
        'Details' => 'required|array',
        'Details.*' => 'required|string',
        'SummaryOfWorkDone' => 'nullable|array',
        'SummaryOfWorkDone.*' => 'nullable|string',
        'TimeSubmitted' => 'nullable|array',
        'TimeSubmitted.*' => 'nullable|date_format:H:i',
    ]);

    // Retrieve the current user's emp_num from employees table using the uuid
    $user = Auth::user();
    $employee = Employee::where('uuid', $user->uuid)->first();

    if (!$employee) {
        return back()->with('error', 'Employee record not found.');
    }

    // Generate a single UUID for all records
    $uuid = Str::uuid()->toString();

    foreach ($request->Budgetted_time as $key => $budgetedTime) {
        WFH_tbl::create([
            'uuid' => $uuid, // Use the same UUID for all rows
            'emp_num' => $employee->emp_num,
            'client_name' => $request->client_name,
            'Date_filed' => $request->Date_filed,
            'Date_WFH' => $request->Date_WFH,
            'Engagement' => $request->Engagement,
            'Budgetted_time' => $budgetedTime,
            'Details' => $request->Details[$key],
            'SummaryOfWorkDone' => $request->SummaryOfWorkDone[$key] ?? null,
            'TimeSubmitted' => $request->TimeSubmitted[$key] ?? null,
            'PreparedDate' => now(),
            'PreparedBy' => $employee->emp_num,
            'ApprovedBy' => null,
            'ApprovedDate' => $request->ApprovedDate ?? null,
            'Status' => 'Pending',
            'Reason' => $request->Reason ?? null,
            'IsArchived' => 0,
            'ArchivedDate' => null,
            'CreatedBy' => $user->id,
            'EditedBy' => null,
        ]);
    }

    return back()->with('success', 'Work From Home record successfully saved.');
}


public function show($uuid)
{
    $wfhRecords = WFH_tbl::where('uuid', $uuid)->get(); // Fetch all records with the same UUID

    if ($wfhRecords->isEmpty()) {
        return redirect()->route('wfh.index')->with('error', 'No records found.');
    }

    $employee = Employee::where('emp_num', $wfhRecords->first()->emp_num)->first();

    return view('wfh.show', compact('wfhRecords', 'employee'));
}



public function updateStatus(Request $request, WFH_tbl $wfh)
{
    $request->validate([
        'status' => 'required|string|in:Approved,Disapproved',
        'reason' => $request->status == 'Disapproved' ? 'required|string' : 'nullable',
    ]);

    $wfh->update([
        'Status' => $request->status,
        'Reason' => $request->status == 'Disapproved' ? $request->reason : null,
    ]);

    return redirect()->route('wfh.show', $wfh->id)->with('success', 'Status updated successfully.');
}



    public function edit(WFH_tbl $wfh)
    {
        return view('wfh.edit', compact('wfh'));
    }

    public function update(Request $request, WFH_tbl $wfh)
    {
        $request->validate([
            'emp_num' => 'required|string',
            'client_id' => 'required|exists:clients,id',
            'Date_filed' => 'required|date',
            'Date_WFH' => 'required|date',
            'Engagement' => 'required|string',
            'Budgetted_time' => 'required|integer',
            'Status' => 'required|string',
            'EditedBy' => 'required|exists:users,id',
        ]);

        $wfh->update($request->all());

        return redirect()->route('wfh.index')->with('success', 'Record updated successfully.');
    }

    public function destroy(WFH_tbl $wfh)
    {
        $wfh->delete();
        return redirect()->route('wfh.index')->with('success', 'Record deleted successfully.');
    }

    public function approve($uuid)
{
    $wfh = WFH_tbl::where('uuid', $uuid)->first();

    if (!$wfh) {
        return redirect()->back()->with('error', 'Record not found.');
    }

    $wfh->update(['Status' => 'Approved']);

    return redirect()->back()->with('success', 'WFH request approved successfully.');
}

public function disapprove(Request $request, $uuid)
{
    $wfh = WFH_tbl::where('uuid', $uuid)->first();

    if (!$wfh) {
        return redirect()->back()->with('error', 'Record not found.');
    }

    $wfh->update([
        'Status' => 'Disapproved',
        'Reason' => $request->disapproval_reason
    ]);

    return redirect()->back()->with('success', 'WFH request disapproved successfully.');
}
public function archive($uuid)
{
    $wfh = WFH_tbl::where('uuid', $uuid)->firstOrFail(); // Ensure it finds by UUID

    $wfh->IsArchived = true;
    $wfh->ArchivedDate = now();
    $wfh->save();

    return redirect()->back()->with('success', 'Work From Home request archived successfully.');
}




}
