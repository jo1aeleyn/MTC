<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempClient extends Model
{
    use HasFactory;

    protected $table = 'temp_client_tbl'; // Define the table name

    protected $fillable = [
        'emp_num',
        'requested_by',
        'DepartmentID',
        'client_id',
        'status',
        'purpose',
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_num', 'emp_num');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'DepartmentID', 'id');
    }

    public function client()
    {
        return $this->belongsTo(ClientTbl::class, 'client_id', 'client_id');
    }
    public function requestedByEmployee()
{
    return $this->belongsTo(Employee::class, 'requested_by', 'emp_num');
}

}
