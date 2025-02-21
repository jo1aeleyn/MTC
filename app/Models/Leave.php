<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Leave extends Model
{
    use HasFactory;

    protected $table = 'leaves_tbl';

    protected $fillable = [
        'uuid',
        'emp_num',
        'name',
        'DateOfLeave',
        'TotalDays',
        'TypeOfLeave',
        'Remarks',
        'Status',
        'ReasonForDisapproved',
        'ReviewedBy',
        'ReviewedDate',
        'LeavesCredits',
        'LessApprovedDays',
        'RemainingLeaves',
        'WithPay',
        'WithoutPay',
        'FilledUpBy',
        'FilledUpDate',
        'IsArchived',
        'DateOfArchived',
        'EditedBy',
        'CreatedBy',
        'VacationLeaveCount',  // New column added here
        'SickLeaveCount'       // New column added here
    ];
    

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($leave) {
            $leave->Status = $leave->Status ?? 'Pending';
            $leave->ReasonForDisapproved = $leave->ReasonForDisapproved ?? '';
            $leave->ReviewedBy = $leave->ReviewedBy ?? '';
            $leave->ReviewedDate = $leave->ReviewedDate ?? null;
            $leave->LeavesCredits = $leave->LeavesCredits ?? 0;
            $leave->LessApprovedDays = $leave->LessApprovedDays ?? 0;
            $leave->RemainingLeaves = $leave->RemainingLeaves ?? 0;
            $leave->WithPay = $leave->WithPay ?? 0;
            $leave->WithoutPay = $leave->WithoutPay ?? 0;
            $leave->FilledUpBy = $leave->FilledUpBy ?? '';
            $leave->FilledUpDate = $leave->FilledUpDate ?? null;
            $leave->IsArchived = $leave->IsArchived ?? false;
            $leave->DateOfArchived = $leave->DateOfArchived ?? null;
            $leave->EditedBy = $leave->EditedBy ?? '';
            $leave->CreatedBy = $leave->CreatedBy ?? '';
        });
    }
    protected $casts = [
        'DateOfLeave' => 'date',
        'ReviewedDate' => 'date',
        'FilledUpDate' => 'date',
        'DateOfArchived' => 'date',
    ];
}
