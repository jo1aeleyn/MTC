<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $table = 'training_tbl';
    protected $fillable = [
        'emp_num', 'title', 'inclusive_dates', 'conducted_by', 'venue',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_num', 'emp_num');
    }
}
