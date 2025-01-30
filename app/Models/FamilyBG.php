<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyBG extends Model
{
    use HasFactory;

    protected $table = 'family_bg_tbl';
    protected $fillable = [
        'emp_num', 'name', 'relationship', 'occupation', 'birthdate', 'age', 'address', 'phone',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_num', 'emp_num');
    }
}
