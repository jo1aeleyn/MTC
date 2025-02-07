<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'DepartmentID',
        'uuid',
        'DepartmentName',
        'created_by',
        'edited_by',
        'archived',
        'archived_by',
        'date_of_archived'
    ];
}
