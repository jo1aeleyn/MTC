<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with statistics.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Count the number of rows in the employees table
        $employeeCount = Employee::count();

        // Pass the data to the dashboard view
        return view('dashboard', compact('employeeCount'));
    }
}
