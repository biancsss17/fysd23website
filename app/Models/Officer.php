<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    protected $guarded = ['id'];

    public function photo()
    {
        return $this->belongsTo(Media::class, 'photo_id');
    }
}
