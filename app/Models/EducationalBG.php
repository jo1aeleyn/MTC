<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalBG extends Model
{
    use HasFactory;

    protected $table = 'educational_bg_tbl';
    protected $fillable = [
        'emp_num', 'level', 'school', 'degree', 'year_attended_from', 'year_attended_to', 'honors_received',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_num', 'emp_num');
    }
}
