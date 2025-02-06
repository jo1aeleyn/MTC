<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientTbl;
use App\Models\ClientDistributionTbl;
use App\Models\ClientServiceOfInvoiceTbl;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        $clients = ClientTbl::orderBy('created_at', 'desc')->get();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'registered_company_name' => 'required',
            'registered_address' => 'required',
            'email_address_of_authorized_personnel' => 'required|email',
            'engagement_year' => 'required',
            'company_name' => 'required',
            'delivery_address' => 'required',
            'contact_person' => 'required',
            'mobile_number' => 'required',
            'tax_identification_number' => 'required',
            'revenue_for_current_year' => 'required',
            'client_type' => 'required|in:new,old', // Ensure client type is selected
        ]);
    
        try {
           
    
            $lastClient = ClientTbl::latest()->first();
            $newClientId = $lastClient ? 'MTC_CL' . str_pad(((int)substr($lastClient->client_id, 7)) + 1, 2, '0', STR_PAD_LEFT) : 'MTC_CL01';
    
            $uuid = Str::uuid();
    
            // Determine if it's a new client or old client
            $isNewClient = $request->client_type === 'new';
    
            // Create the ClientTbl record
            $client = ClientTbl::create([
                'uuid' => $uuid,
                'client_id' => $newClientId,
                'registered_company_name' => $request->registered_company_name,
                'registered_address' => $request->registered_address,
                'engagement_year' => $request->engagement_year,
                'authorized_personnel' => $request->authorized_personnel,
                'position_of_authorized_personnel' => $request->position_of_authorized_personnel,
                'email_address_of_authorized_personnel' => $request->email_address_of_authorized_personnel,
                'revenue_for_current_year' => $request->revenue_for_current_year,
                'prior_years_auditor' => $request->prior_years_auditor,
                'NewClient' => $isNewClient, // Store whether the client is new or old
                'LAFS' => $isNewClient && $request->has('latest_audited_financial_statement') ? true : false, // Save the Latest Audited Financial Statement checkbox
                'TBCY' => $request->has('trial_balance_current_year') ? true : false, // Save the Trial Balance checkbox
                'BIR_CoR' => $isNewClient && $request->has('bir_certificate_of_registration') ? true : false, // Save the BIR Certificate checkbox
                'created_by' => 1
            ]);
    
            // Create the ClientDistributionTbl record
            ClientDistributionTbl::create([
                'uuid' => $uuid,
                'client_id' => $newClientId,
                'company_name' => $request->company_name,
                'delivery_address' => $request->delivery_address,
                'contact_person' => $request->contact_person,
                'mobile_number' => $request->mobile_number,
                'authorized_personnel' => $request->authorized_personnel,
                'position_of_authorized_personnel' => $request->position_of_authorized_personnel,
                'prior_years_auditor' => $request->prior_years_auditor,
                'email_address' => $request->email_address_of_authorized_personnel,
            ]);
    
            // Create the ClientServiceOfInvoiceTbl record
            ClientServiceOfInvoiceTbl::create([
                'uuid' => $uuid,
                'client_id' => $newClientId,
                'company_name' => $request->company_name,
                'registered_address' => $request->registered_address,
                'tax_identification_number' => $request->tax_identification_number,
            ]);
    
            return redirect()->route('clients.index')->with('success', 'Client created successfully.');
        } catch (\Exception $e) {
            // Log the error to debug
            \Log::error('Error creating client: ' . $e->getMessage());
    
            // In case of an exception, return with an error message
            return redirect()->back()->withErrors(['error' => 'An error occurred while saving the client.'])->withInput();
        }
    }
    
    
    public function edit(ClientTbl $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, ClientTbl $client)
    {
        $request->validate([
            'registered_company_name' => 'required',
            'registered_address' => 'required',
        ]);

        $client->update([
            'registered_company_name' => $request->registered_company_name,
            'registered_address' => $request->registered_address,
            'EditedBy' => Auth::id(),
        ]);

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    public function show(ClientTbl $client)
    {
        return view('clients.show', compact('client'));
    }

    public function destroy(ClientTbl $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}
