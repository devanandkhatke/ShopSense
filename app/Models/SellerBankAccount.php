<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerBankAccount extends Model
{
    protected $fillable = [
        'seller_profile_id',
        'account_holder_name',
        'bank_name',
        'account_number',
        'ifsc_code',
        'is_verified',
    ];

    public function sellerProfile()
    {
        return $this->belongsTo(SellerProfile::class);
    }
}
