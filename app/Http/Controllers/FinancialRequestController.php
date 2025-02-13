<?php

namespace App\Http\Controllers;

use App\Models\FinancialReq;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinancialRequestController extends Controller
{
    public function index()
    {
        $financialRequests = FinancialReq::where('IsArchived', 0)->paginate(10);
        return view('financial_req.index', compact('financialRequests'));
    }

    public function personalindex()
    {
        $user = Auth::user();  // Retrieve the authenticated user
        $uuid = $user->uuid;   // Get the user's uuid
        $employee = Employee::where('uuid', $user->uuid)->firstOrFail();
        $empnum = $employee->emp_num;

        $financialRequests = FinancialReq::where('IsArchived', 0)-> where('emp_num', $empnum)->paginate(10);
        return view('financial_req.personalindex', compact('financialRequests'));
    }

    public function create()
    {
        return view('financial_req.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();  // Retrieve the authenticated user
        $uuid = $user->uuid;   // Get the user's uuid
        $employee = Employee::where('uuid', $user->uuid)->firstOrFail();
        $empnum = $employee->emp_num;
        $fullname = $employee->first_name . ' ' . ($employee->middle_name ? $employee->middle_name . ' ' : '') . $employee->surname;

        $validated = $request->validate([
            'Chargeto' => 'nullable|string|max:255',
            'PaymentForm' => 'nullable|string|max:50',
            'RequestType' => 'nullable|string|max:100',
            'Ammount' => 'nullable|numeric',
            'purpose' => 'nullable|string',
            'RequestedBy' => 'nullable|string|max:100',
            'ApprovedBy' => 'nullable|string|max:100',
            'PaymentReceivedBy' => 'nullable|string|max:100',
            'Date' => 'nullable|date',
        ]);

        // Add the user's uuid to the validated data
        $validated['uuid'] = $uuid;
        $validated['emp_num'] = $empnum;
        $validated['payee'] = $fullname;
        $validated['RequestedBy'] = $fullname;
        $validated['PaymentReceivedBy'] = $fullname;
        $validated['status'] = 'pending'; 

        // Create the record with the validated data
        FinancialReq::create($validated);

        return redirect()->route('financial_req.create')->with('success', 'Financial Request created successfully.');
    }

    public function show($id)
    {
        $user = Auth::user();
        $uuid = $user->uuid;
        $employee = Employee::where('uuid', $uuid)->firstOrFail();
        $empnum = $employee->emp_num;
    
        $financialRequest = FinancialReq::findOrFail($id);
        
        return view('financial_req.show', compact('financialRequest', 'empnum'));
    }
    

        public function edit($id)
    {
        $financialRequest = FinancialReq::findOrFail($id);
        return view('financial_req.edit', compact('financialRequest'));
    }

    public function update(Request $request, $id)
    {
        $financialRequest = FinancialReq::findOrFail($id);

        $validated = $request->validate([
            'Chargeto' => 'nullable|string|max:255',
            'PaymentForm' => 'nullable|string|max:50',
            'RequestType' => 'nullable|string|max:100',
            'Ammount' => 'nullable|numeric',
            'purpose' => 'nullable|string',
            'RequestedBy' => 'nullable|string|max:100',
            'ApprovedBy' => 'nullable|string|max:100',
            'PaymentReceivedBy' => 'nullable|string|max:100',
            'Date' => 'nullable|date',
            'status' => 'nullable|string|max:50',
        ]);

        $financialRequest->update($validated);

        return redirect()->route('financial_req.index')->with('success', 'Financial Request updated successfully.');
    }

    public function updateStatus($id, $status)
    {
        $user = Auth::user();  // Retrieve the authenticated user
        $uuid = $user->uuid;   // Get the user's uuid
        $employee = Employee::where('uuid', $uuid)->firstOrFail(); // Find the employee
        $fullname = $employee->first_name . ' ' . ($employee->middle_name ? $employee->middle_name . ' ' : '') . $employee->surname;

        $financialRequest = FinancialReq::findOrFail($id);
        $financialRequest->status = $status;
        
        if ($status == 'approved') {
            $financialRequest->ApprovedBy = $fullname;  // Set ApprovedBy to the authenticated user's name
        }

        $financialRequest->save();

        return redirect()->route('financial_req.show', $financialRequest->id)
                        ->with('success', 'Financial Request status updated to ' . ucfirst($status) . '.');
    }

    public function archive($id)
    {
        $financialRequest = FinancialReq::findOrFail($id);
        $financialRequest->IsArchived = 1;
        $financialRequest->save();

        return redirect()->route('financial_req.index')->with('success', 'Financial request archived successfully.');
    }
    public function cancel($id)
{
    $financialRequest = FinancialReq::findOrFail($id);
    $financialRequest->status = 'cancelled';
    $financialRequest->save();

    return redirect()->route('financial_req.index')->with('success', 'Financial request cancelled successfully.');
}
 


}
