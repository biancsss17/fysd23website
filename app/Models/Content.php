<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['featured' => 'boolean', 'published_at' => 'datetime', 'event_date' => 'date'];
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')->whereNotNull('published_at')->where('published_at', '<=', now());
    }

    public function cover()
    {
        return $this->belongsTo(Media::class, 'cover_id');
    }

    public function gallery()
    {
        return $this->belongsToMany(Media::class, 'activity_images')->withPivot('sort_order')->orderByPivot('sort_order');
    }
}
