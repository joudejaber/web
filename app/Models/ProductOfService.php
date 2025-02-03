<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOfService extends Model
{
    protected $fillable = ['user_id','service_id','name','category','image','price'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
