<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['homeowner_id','provider_id','service_id','status','notes','appointment_time'];

    public function homeowner()
    {
        return $this->belongsTo(User::class, 'homeowner_id');
    }

    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
