<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contract extends Model
{
    use HasFactory;

    // Specify the attributes that can be mass-assigned
    protected $fillable = [
        'appointment_id',
        'provider_id',
        'homeowner_id',
        'contract_details',
    ];
    // In the Contract model
public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    public function homeowner()
    {
        return $this->belongsTo(User::class, 'homeowner_id');
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

    public function works()
{
    return $this->hasMany(Work::class);
}

}
