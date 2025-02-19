<?php

namespace App\Http\Controllers;

use App\Models\CompanyPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CompanyPositionController extends Controller
{
    /**
     * Display a listing of the positions.
     */
    public function index()
    {
        $positions = CompanyPosition::where('IsArchived', false)->get();
        return view('company_positions.index', compact('positions'));
    }

    /**
     * Show the form for creating a new position.
     */
    public function create()
    {
        return view('company_positions.create');
    }

    /**
     * Store a newly created position in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'PositionName' => 'required|string|max:255|unique:CompanyPositions_tbl,Position_name',
        ]);

        CompanyPosition::create([
            'uuid' => Str::uuid(),
            'Position_name' => $request->PositionName,
            'IsArchived' => false,
            'created_by' => Auth::id(),
        ]);
        
        
        

        return redirect()->route('company_positions.index')->with('success', 'Position created successfully.');
    }

    /**
     * Show the form for editing the specified position.
     */
    public function edit($uuid)
{
    $companyPosition = CompanyPosition::where('uuid', $uuid)->firstOrFail();
    return view('company_positions.edit', compact('companyPosition'));
}

    
    
    /**
     * Update the specified position in the database.
     */
    public function update(Request $request, $uuid)
{
    $companyPosition = CompanyPosition::where('uuid', $uuid)->firstOrFail();

    $request->validate([
        'PositionName' => 'required|string|max:255|unique:companypositions_tbl,Position_name,' . $companyPosition->id,
    ]);

    $companyPosition->update([
        'Position_name' => $request->PositionName,
        'edited_by' => Auth::id(),
    ]);

    return redirect()->route('company_positions.index')->with('success', 'Position updated successfully.');
}



    /**
     * Archive the specified position instead of deleting it.
     */
    public function archive($uuid)
{
    $companyPosition = CompanyPosition::where('uuid', $uuid)->firstOrFail();

    $companyPosition->update([
        'IsArchived' => true,
        'archived_by' => Auth::id(),
        'date_of_archived' => now(),
    ]);

    return redirect()->route('company_positions.index')->with('success', 'Position archived successfully.');
}

}
