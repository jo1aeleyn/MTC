<?php

namespace App\Http\Controllers;

use App\Models\FinancialReq;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FinancialReqImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class FinancialRequestController extends Controller
{
    public function index()
{
    $user = auth()->user();

    if ($user->role == 'HR Admin') {
        $financialRequests = FinancialReq::where('IsArchived', 0)
            ->where('status', 'Pending')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    } elseif ($user->role == 'Partners') {
        $financialRequests = FinancialReq::where('IsArchived', 0)
            ->where('status', 'Recommended')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    } else {
        $financialRequests = FinancialReq::where('IsArchived', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    return view('financial_req.index', compact('financialRequests'));
}

    public function personalindex()
    {
        $user = Auth::user();  // Retrieve the authenticated users
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
    $user = Auth::user();
    $employee = Employee::where('uuid', $user->uuid)->firstOrFail();

    // Validate input
    $validated = $request->validate([
        'Chargeto' => 'nullable|string|max:255',
        'PaymentForm' => 'nullable|string|max:50',
        'RequestType' => 'required|string|max:100',
        'Amount' => 'nullable|numeric',  // Ensure this is numeric
        'purpose' => 'nullable|string',
        'Date' => 'nullable|date',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate images
    ]);

    // Set additional fields
    $validated['uuid'] = $user->uuid;
    $validated['emp_num'] = $employee->emp_num;
    $validated['payee'] = $employee->first_name . ' ' . ($employee->middle_name ? $employee->middle_name . ' ' : '') . $employee->surname;
    $validated['RequestedBy'] = $validated['payee'];
    $validated['PaymentReceivedBy'] = $validated['payee'];
    $validated['status'] = 'pending';

    // Create financial request and get its ID
    $financialRequest = FinancialReq::create($validated);

    // Handle image uploads and store them in the database
if ($request->hasFile('images')) {
    foreach ($request->file('images') as $image) {
        $path = $image->store('financial_images', 'public'); // Save file
        $filename = basename($path); // Extract only the filename

        // Insert into financial_req_images table
        DB::table('financial_req_images')->insert([
            'financial_req_id' => $financialRequest->id, 
            'image_path' => $filename, // Store only the filename
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}


    return redirect()->route('financial_req.create')->with('success', 'Financial Request created successfully.');
}

    public function show($uuid)
{
    $user = Auth::user();
    $employee = Employee::where('uuid', $user->uuid)->firstOrFail();
    $empnum = $employee->emp_num;

    // Fetch financial request by UUID
    $financialRequest = FinancialReq::where('uuid', $uuid)->firstOrFail();

    // Fetch related images from financial_req_images table
    $images = DB::table('financial_req_images')
        ->where('financial_req_id', $financialRequest->id)
        ->pluck('image_path'); // Retrieve only the image_path column

    return view('financial_req.show', compact('financialRequest', 'empnum', 'images'));
}

    
    

    public function edit($uuid)
    {
        // Fetch the FinancialReq by its UUID
        $financialRequest = FinancialReq::where('uuid', $uuid)->firstOrFail();
        
        return view('financial_req.edit', compact('financialRequest'));
    }
    

    public function update(Request $request, $uuid)
    {
        $financialRequest = FinancialReq::where('uuid', $uuid)->firstOrFail();


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

    public function updateStatus($uuid, $status)
    {
        $user = Auth::user();  // Retrieve the authenticated user
        $uuid = $user->uuid;   // Get the user's uuid
        $employee = Employee::where('uuid', $uuid)->firstOrFail(); // Find the employee
        $fullname = $employee->first_name . ' ' . ($employee->middle_name ? $employee->middle_name . ' ' : '') . $employee->surname;

        $financialRequest = FinancialReq::findOrFail($uuid);
        $financialRequest->status = $status;
        
        if ($status == 'approved') {
            $financialRequest->ApprovedBy = $fullname;  // Set ApprovedBy to the authenticated user's name
        }

        $financialRequest->save();

        return redirect()->route('financial_req.show', $financialRequest->id)
                        ->with('success', 'Financial Request status updated to ' . ucfirst($status) . '.');
    }

    public function archive(FinancialReq $financialRequest)
    {
        // Update the IsArchived field to 1 (indicating archived)
        $financialRequest->update(['IsArchived' => 1]);
    
        // Redirect back to the financial request index page with a success message
        return redirect()->route('financial_req.index')->with('success', 'Financial request archived successfully.');
    }
    



    public function cancel($uuid)
{
    $financialRequest = FinancialReq::findOrFail($uuid);
    $financialRequest->status = 'cancelled';
    $financialRequest->save();

    return redirect()->route('financial_req.index')->with('success', 'Financial request cancelled successfully.');
}
 


}
