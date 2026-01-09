<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerKyc extends Model
{
    protected $table = 'seller_kyc';

    protected $fillable = [
        'seller_profile_id',
        'gst_certificate',
        'business_registration_doc',
        'id_proof',
        'cancelled_cheque',
        'status',
        'admin_remark',
    ];

    public function sellerProfile()
    {
        return $this->belongsTo(SellerProfile::class);
    }

    
}
