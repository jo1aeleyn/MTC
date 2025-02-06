<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientTbl extends Model
{
    use HasFactory;

    protected $table = 'client_tbl'; // Explicit table name

    protected $primaryKey = 'id'; // Primary key

    public $incrementing = true; // ID is auto-incrementing

    protected $keyType = 'int'; // Primary key type

    protected $fillable = [
        'uuid',
        'client_id',
        'registered_company_name',
        'registered_address',
        'engagement_year',
        'type_of_engagement',
        'authorized_personnel',
        'position_of_authorized_personnel',
        'email_address_of_authorized_personnel',
        'revenue_for_current_year',
        'prior_years_auditor',
        'NewClient',
        'LAFS',
        'TBCY',
        'BIR_CoR',
        'IsArchived',
        'ArchivedBy',
        'ArchivedDate',
        'CreatedBy',
        'EditedBy',
    ];

    // Relationship with ClientDistributionTbl
    public function clientDistributions()
    {
        return $this->hasMany(ClientDistributionTbl::class, 'client_id', 'client_id');
    }
    
    public function clientServices()
    {
        return $this->hasMany(ClientServiceOfInvoiceTbl::class, 'client_id', 'client_id');
    }
}
