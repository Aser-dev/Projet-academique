<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyPhoto extends Model
{
    public $timestamps = false;

    protected $fillable = ['property_id', 'path', 'original_name', 'mime_type', 'size', 'is_main', 'sort_order'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function getUrlAttribute(): string
    {
        if (str_starts_with($this->path, 'http')) {
            return $this->path;
        }

        return asset('storage/' . $this->path);
    }
}