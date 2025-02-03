<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['user_id','type'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function productofservice()
    {
        return $this->hasMany(ProductOfService::class, 'service_id');
    }

    // App/Models/Service.php
    public function provider()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
