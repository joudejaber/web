<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['homeowner_id','provider_id','service_id','status','notes','appointment_time'];
    protected $casts = [
        'appointment_time' => 'datetime',
    ];

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
    public function damage()
{
    return $this->belongsTo(DamageDocumentation::class);
}

public function contract()
{
    return $this->hasOne(Contract::class);
}
public function damageDetails()
{
    return $this->hasMany(Damage::class, 'damage_report_id'); // Adjust the relationship according to your database schema
}

}
