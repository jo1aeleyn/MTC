<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid', // keep the UUID if you want a separate UUID field
        'announcementID',
        'title',
        'content',
        'category',
        'image', // Add image to the fillable array
        'createdBy',
        'editedBy',
        'IsArchived',
        'ArchivedBy',
    ];

}
