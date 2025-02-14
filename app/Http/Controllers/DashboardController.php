<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\ClientTbl;
use App\Models\Announcement;


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
        $clientCount = ClientTbl::count();
        $announcements = Announcement::where('IsArchived', 0)->latest()->take(3)->get();


        // Pass the data to the dashboard view
        return view('dashboard', compact('employeeCount','announcements','clientCount'));
    }
}
