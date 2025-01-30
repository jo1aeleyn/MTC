<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $table = 'applications';

    protected $fillable = [
        'emp_num',
        'referred_by',
        'date_applied',
        'date_hired',
        'position',
        'EmploymentStatus',
        'DateOfRegularization'
    ];

    /**
     * Define a relationship with the Employee model.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_num', 'emp_num');
    }
}
