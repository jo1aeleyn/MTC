<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Overtime; // Import the model
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;


class OvertimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    // Get all overtime records, paginated
    $overtimes = Overtime::paginate(10);  // Adjust the number of records per page as needed

    // Return the 'index' view with the 'overtimes' variable
    return view('overtime.index', compact('overtimes'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string',
            'number_of_hours' => 'required|integer',
            'purpose' => 'nullable|string',
            'request_date' => 'required|date',
        ]);


        $user = Auth::user();
     
         $employee = Employee::where('uuid', $user->uuid)->firstOrFail();
         $fullName = $employee->first_name . ' ' . ($employee->middle_name ? $employee->middle_name . ' ' : '') . $employee->surname;

        $overtime = new Overtime();
        $overtime->uuid = (string) Str::uuid();


        $overtime->emp_num = $employee->emp_num;


        $overtime->emp_name = $fullName;
        $overtime->client_name = $request->client_name;
        $overtime->date_filed = now();
        $overtime->number_of_hours = $request->number_of_hours;
        $overtime->purpose = $request->purpose;
        $overtime->requested_by = $fullName;
        $overtime->request_date = $request->request_date;
        $overtime->created_by = auth()->id();
        $overtime->created_at = now();
        $overtime->updated_at = now();
        $overtime->save();

        return redirect()->route('overtime.index')->with('success', 'Overtime Successfully Requested.');
    }

    public function show($id)
    {
        // Find the overtime request by its ID
        $overtime = Overtime::find($id);
    
        // If not found, redirect back with an error message
        if (!$overtime) {
            return redirect()->route('overtime.index')->with('error', 'Overtime request not found');
        }
    
        // Return the show view with the overtime request data
        return view('overtime.show', compact('overtime'));
    }
    
    
    /**
 * Show the form for editing the specified resource.
 */
public function edit($id)
{
    $overtime = Overtime::find($id);

    if (!$overtime) {
        return redirect()->route('overtime.index')->with('error', 'Overtime request not found');
    }

    return view('overtime.edit', compact('overtime'));
}


    public function create()
    {
        return view('overtime.create');
    }



    public function update(Request $request, $id)
    {
        $overtime = Overtime::find($id);

        if (!$overtime) {
            return response()->json(['message' => 'Overtime request not found'], 404);
        }

        $request->validate([
            'emp_name' => 'required|string',
            'client_name' => 'required|string',
            'date_filed' => 'required|date',
            'number_of_hours' => 'required|integer',
            'purpose' => 'nullable|string',
            'edited_by' => 'required|string',
        ]);

        $overtime->emp_name = $request->emp_name;
        $overtime->client_name = $request->client_name;
        $overtime->date_filed = $request->date_filed;
        $overtime->number_of_hours = $request->number_of_hours;
        $overtime->purpose = $request->purpose;
        $overtime->edited_by = $request->edited_by;
        $overtime->updated_at = now();
        $overtime->save();

        return response()->json(['message' => 'Overtime request updated successfully', 'data' => $overtime]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $overtime = Overtime::find($id);

        if (!$overtime) {
            return response()->json(['message' => 'Overtime request not found'], 404);
        }

        $overtime->delete();

        return response()->json(['message' => 'Overtime request deleted successfully']);
    }
}
