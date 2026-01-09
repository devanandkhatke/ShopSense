<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerWallet extends Model
{
    protected $fillable = [
        'seller_profile_id',
        'available_balance',
        'pending_balance',
    ];

    public function sellerProfile()
    {
        return $this->belongsTo(SellerProfile::class);
    }
}
