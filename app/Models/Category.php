<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug'];

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
