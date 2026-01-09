<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerPayout extends Model
{
    protected $fillable = [
        'seller_profile_id',
        'amount',
        'status',
        'admin_remark',
        'paid_at',
    ];

    public function sellerProfile()
    {
        return $this->belongsTo(SellerProfile::class);
    }
}
