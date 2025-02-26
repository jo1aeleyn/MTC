<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Overtime extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'overtime_tbl';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'uuid',
        'emp_num',
        'emp_name',
        'client_name',
        'date_filed',
        'number_of_hours',
        'purpose',
        'requested_by',
        'request_date',
        'approved_by',
        'approved_date',
        'approved_wt_pay',
        'approved_wo_pay',
        'disapproved',
        'reason',
        'is_archived',
        'archived_by',
        'created_by',
        'edited_by',
        'created_at',
        'updated_at',
        'status',
        'WithPay',
        'Type_Of_Day',
        'activitycode',  
        'activityname' 
    ];
    

    /**
     * Automatically generate a UUID for the `uuid` field on creating.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function employee()
{
    return $this->belongsTo(Employee::class, 'emp_num', 'emp_num');
}

}
