<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialReqImage extends Model
{
    use HasFactory;

    protected $fillable = ['financial_req_id', 'image_path'];

    public function financialRequest()
    {
        return $this->belongsTo(FinancialReq::class);
    }
}
