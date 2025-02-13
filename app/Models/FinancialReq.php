<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialReq extends Model
{
    use HasFactory;

    protected $table = 'FinancialReq_tbl'; // Table name

    protected $fillable = [
        'uuid',
        'emp_num',
        'payee',
        'Chargeto',
        'PaymentForm',
        'RequestType',
        'Ammount',
        'purpose',
        'RequestedBy',
        'ApprovedBy',
        'status',
        'PaymentReceivedBy',
        'Date'
    ];

    // Optionally, if you want to cast some attributes
    protected $casts = [
        'Date' => 'date',
        'Ammount' => 'decimal:2',
    ];
}
