<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAssignment extends Model
{
    use HasFactory;

    protected $table = 'clientassignment_tbl';

    protected $fillable = [
        'emp_num',
        'uuid',
        'client_id',
        'client_type',
        'assigned_by',
        'created_by',
        'edited_by',
        'is_archived',
        'archived_by'
    ];

    // In ClientAssignment model
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_num', 'emp_num');
    }

    // ClientAssignment.php (Model)
public function client()
{
    return $this->belongsTo(ClientTbl::class, 'client_id', 'client_id');
}


    public function assignedBy()
    {
        return $this->belongsTo(UserAccount::class, 'assigned_by');
    }

    public function createdBy()
    {
        return $this->belongsTo(UserAccount::class, 'created_by');
    }

    public function editedBy()
    {
        return $this->belongsTo(UserAccount::class, 'edited_by');
    }

    public function archivedBy()
    {
        return $this->belongsTo(UserAccount::class, 'archived_by');
    }
}
