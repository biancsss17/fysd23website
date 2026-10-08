<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';

    protected $guarded = ['id'];

    public function getUrlAttribute()
    {
        return route('media.show', $this);
    }

    public function getIsVideoAttribute(): bool
    {
        return in_array(strtolower(pathinfo($this->path, PATHINFO_EXTENSION)), ['mp4', 'webm', 'ogg'], true);
    }
}
