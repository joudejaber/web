<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DamageImage extends Model
{
    protected $fillable = ['damage_id', 'image_path'];

    public function damage()
    {
        return $this->belongsTo(Damage::class); // Relates to the Damage model
    }
}
