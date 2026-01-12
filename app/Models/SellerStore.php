<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerStore extends Model
{
    protected $fillable = [
        'seller_profile_id',
        'store_logo',
        'website',
        'whatsapp_number',
        'shipping_method',
        'default_tax_rate',
        'is_completed',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'default_tax_rate' => 'decimal:2',
    ];

    public function sellerProfile()
    {
        return $this->belongsTo(SellerProfile::class);
    }
}
