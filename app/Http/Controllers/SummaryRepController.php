<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OvertimeSummary;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;



class SummaryRepController extends Controller
{
    public function OvertimeSummary(Request $request, $emp_num = null)
    {
        $query = Employee::query();
        
        if ($emp_num) {
            $query->where('emp_num', $emp_num);
        }
        
        $employees = $query->get();
        
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        foreach ($employees as $employee) {
            $overtimeQuery = DB::table('overtime_tbl')
                ->where('emp_num', $employee->emp_num);
            
            if ($startDate && $endDate) {
                $overtimeQuery->whereBetween('updated_at', [$startDate, $endDate]);
            }
            
            $employee->overtime_count = $overtimeQuery->count();
            $employee->total_hours = $overtimeQuery->sum('partner_deduction');
        }
        
        return view('SummaryReports.SummaryOvertime', [
            'employees' => $employees,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
    }

    public function exportOvertimePDF(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
    
        // Get all employees
        $employees = Employee::all();
    
        foreach ($employees as $employee) {
            // Query overtime records directly from the database
            $overtimeQuery = DB::table('overtime_tbl')
                ->where('emp_num', $employee->emp_num);
    
            if ($startDate && $endDate) {
                $overtimeQuery->whereBetween('updated_at', [$startDate, $endDate]);
            }
    
            // Add overtime data to the employee object
            $employee->overtime_count = $overtimeQuery->count();
            $employee->total_hours = $overtimeQuery->sum('partner_deduction');
        }
    
        // Generate the PDF
        $pdf = Pdf::loadView('SummaryReports.summary_overtime_pdf', [
            'employees' => $employees,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
    
        return $pdf->download('overtime_report.pdf');
    }
    

    
}