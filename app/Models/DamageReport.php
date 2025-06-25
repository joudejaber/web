<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DamageReport extends Model
{
    protected $fillable = [
        'user_id', 'full_name', 'phone_number', 'email',
        'city', 'street', 'building_name', 'floor_number', 'report_date'
    ];

    public function damages()
    {
        return $this->hasMany(Damage::class);
    }
    public function user()
{
    return $this->belongsTo(User::class);
}

}