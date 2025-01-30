<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentHistory extends Model
{
    use HasFactory;

    protected $table = 'employment_histories';
    protected $fillable = [
        'emp_num', 'date', 'position', 'salary', 'superior',
        'department', 'address', 'company', 'telephone', 'reason_for_leaving',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_num', 'emp_num');
    }
}
