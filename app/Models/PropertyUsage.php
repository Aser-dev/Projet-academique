<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyUsage extends Model
{
    public $timestamps = false;

    protected $fillable = ['property_id', 'usage'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}