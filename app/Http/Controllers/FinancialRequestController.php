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
        $financialRequests = FinancialReq::paginate(10); // Paginate results
        return view('financial_req.index', compact('financialRequests'));
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
        $financialRequest = FinancialReq::findOrFail($id);
        return view('financial_req.show', compact('financialRequest'));
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

}
