<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserAccount extends Authenticatable
{
    use HasFactory;

    protected $table = 'user_accounts_tbl';
    protected $fillable = [
        'uuid', 'username', 'password', 'user_role', 'is_archived',
        'archived_by', 'created_by', 'edited_by', 'profile_picture'
    ];
}
