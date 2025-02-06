<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientServiceOfInvoiceTbl extends Model
{
    use HasFactory;

    protected $table = 'client_service_of_invoice_tbl'; // Explicit table name

    protected $primaryKey = 'id'; // Primary key

    public $incrementing = true; // ID is auto-incrementing

    protected $keyType = 'int'; // Primary key type

    protected $fillable = [
        'uuid',
        'client_id',
        'company_name',
        'registered_address',
        'tax_identification_number',
    ];

    // Relationship with ClientTbl
    public function client()
    {
        return $this->belongsTo(ClientTbl::class, 'uuid', 'uuid');
    }
}
