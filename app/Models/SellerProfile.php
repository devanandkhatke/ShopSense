<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerProfile extends Model
{
    protected $fillable = [
        'user_id',
        'business_name',
        'store_display_name',
        'business_type',
        'industry',
        'store_name',
        'store_slug',
        'store_description',
        'gst_number',
        'pan_number',
        'contact_name',
        'contact_phone',
        'address',
        'city',
        'state',
        'pincode',
        'status',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function store()
    {
        return $this->hasOne(\App\Models\SellerStore::class);
    }
    

    public function bankAccount()
    {
        return $this->hasOne(SellerBankAccount::class);
    }

    public function wallet()
    {
        return $this->hasOne(SellerWallet::class);
    }

    public function payouts()
    {
        return $this->hasMany(SellerPayout::class);
    }

    public function isKycVerified(): bool
    {
        return $this->status === 'kyc_verified';
    }
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }
  
    public function kyc()
    {
        return $this->hasOne(SellerKyc::class);
    }

    public function hasFullAccess(): bool
    {
        return
            $this->application_status === 'approved'
            && $this->kyc
            && $this->kyc->status === 'verified';
    }

    public function isActive()
    {
        return $this->status === 'active';
    }
}