<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Damage extends Model
{
    protected $fillable = ['damage_report_id', 'name', 'description', 'image_path', 'status'];

    public function report()
    {
        return $this->belongsTo(DamageReport::class, 'damage_report_id');
    }

    public function images()
    {
        return $this->hasMany(DamageImage::class);
    }
}
