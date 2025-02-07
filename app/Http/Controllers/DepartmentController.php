<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::where('archived', false)->latest()->get();
        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'DepartmentName' => 'required|string|max:255|unique:departments,DepartmentName',
        ]);

        $lastDepartment = Department::latest('id')->first();
        $nextNumber = $lastDepartment ? ((int) substr($lastDepartment->DepartmentID, 3)) + 1 : 1;
        $departmentID = 'MTC' . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);

        Department::create([
            'DepartmentID' => $departmentID,
            'uuid' => Str::uuid(),
            'DepartmentName' => $request->DepartmentName,
            'created_by' => Auth::id() ?? null, 
            'edited_by' =>  Auth::id() ?? null, 
        ]);

        return redirect()->route('departments.index')->with('success', 'Department created successfully.');
    }

    public function edit($uuid)
    {
        $department = Department::where('uuid', $uuid)->firstOrFail();
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, $uuid)
    {
        $department = Department::where('uuid', $uuid)->firstOrFail();

        $request->validate([
            'DepartmentName' => 'required|string|max:255|unique:departments,DepartmentName,' . $department->id,
        ]);

        $department->update([
            'DepartmentName' => $request->DepartmentName,
            'edited_by' => Auth::id(),
        ]);

        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    public function archive($uuid)
    {
        $department = Department::where('uuid', $uuid)->firstOrFail();
        $department->update([
            'archived' => true,
            'archived_by' => Auth::id(),
            'date_of_archived' => now(),
        ]);

        return redirect()->route('departments.index')->with('success', 'Department archived successfully.');
    }
}
