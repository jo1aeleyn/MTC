<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class WFH_tbl extends Model
{
    use HasFactory;

    protected $table = 'WFH_tbl';

    protected $fillable = [
        'uuid',
        'emp_num',
        'client_name',
        'Date_filed',
        'Date_WFH',
        'Engagement',
        'Budgetted_time',
        'Details',
        'SummaryOfWorkDone',
        'TimeSubmitted',
        'PreparedBy',
        'ApprovedBy',
        'PreparedDate',
        'ApprovedDate',
        'Status',
        'Reason',
        'IsArchived',
        'ArchivedDate',
        'CreatedBy',
        'EditedBy',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'CreatedBy');
    }

    public function editedBy()
    {
        return $this->belongsTo(User::class, 'EditedBy');
    }
}
