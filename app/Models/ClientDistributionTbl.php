<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ClientDistributionTbl extends Model
{
    use HasFactory;

    protected $table = 'client_distribution_tbl'; // Explicit table name

    protected $primaryKey = 'id'; // Primary key

    public $incrementing = true; // ID is auto-incrementing

    protected $keyType = 'int'; // Primary key type

    protected $fillable = [
        'uuid',
        'client_id',
        'company_name',
        'delivery_address',
        'contact_person',
        'mobile_number',
        'email_address',
    ];

    // Relationship with ClientTbl
    public function client()
    {
        return $this->belongsTo(ClientTbl::class, 'uuid', 'uuid');
    }
}
