<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'company_tbl'; // Explicitly defining the table name

    protected $fillable = [
        'emp_num',
        'AccessCard_release',
        'AccesCard_return',
        'CompanyEmail',
        'PayrollAccount',
        'Cocolife_HMO',
        'Cocolife_ReleaseDate',
        'Cocolife_ReturnDate',
    ];

    protected $dates = [
        'AccessCard_release',
        'AccesCard_return',
        'Cocolife_ReleaseDate',
        'Cocolife_ReturnDate',
    ];
}
