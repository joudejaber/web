<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DamageDocumentation extends Model
{
    protected $fillable = ["location","type","user_id","notes"];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function damage_image()
    {
        return $this->hasMany(DamageImage::class, 'damage_id');
    }
}
