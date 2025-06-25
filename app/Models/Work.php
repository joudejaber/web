<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = [
        'contract_id', 'description', 'cost', 'start_date', 'end_date'
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function images()
    {
        return $this->hasMany(WorkImage::class);
    }
}