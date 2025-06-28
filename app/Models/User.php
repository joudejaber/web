<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function damage_documentation()
    {
        return $this->hasMany(DamageDocumentation::class, 'user_id');
    }

    public function damage_image()
    {
        return $this->hasMany(DamageImage::class, 'user_id');
    }

    public function service()
    {
        return $this->hasMany(Service::class, 'user_id');
    }

    public function productofservice()
    {
        return $this->hasMany(ProductOfService::class, 'user_id');
    }

    public function homeownerAppointments()
    {
        return $this->hasMany(Appointment::class, 'homeowner_id');
    }

    public function providerAppointments()
    {
        return $this->hasMany(Appointment::class, 'provider_id');
    }

    public function provider()
{
    return $this->hasOne(Provider::class);
}

public function damageReports()
{
    return $this->hasMany(DamageReport::class);
}

public function services()
{
    return $this->hasMany(Service::class);
}


    protected $hidden = [
        'password',
        'remember_token',
    ];

}
