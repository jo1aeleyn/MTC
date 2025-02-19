<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class CompanyPosition extends Model
{
    use HasFactory;

    protected $table = 'CompanyPositions_tbl';


    protected $fillable = [
        'uuid', 
        'Position_name',
        'IsArchived',
        'created_by',
        'edited_by',
        'archived_by',
        'date_of_archived',
    ];

    protected $casts = [
        'IsArchived' => 'boolean',
        'date_of_archived' => 'datetime',
    ];
}

