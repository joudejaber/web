<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DamageImage extends Model
{
    protected $fillable = ['image','user_id','damage_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function damage_documentation()
    {
        return $this->belongsTo(DamageDocumentation::class, 'damage_id');
    }
}
