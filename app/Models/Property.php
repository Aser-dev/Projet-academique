<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'title', 'description', 'price', 'superficie', 'location',
        'type', 'option', 'status', 'rooms', 'floor', 'furnished',
        'is_agency', 'views_count', 'validated_by', 'rejection_reason',
    ];

    protected $casts = [
        'furnished' => 'boolean',
        'is_agency' => 'boolean',
        'views_count' => 'integer',
        'rooms' => 'integer',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }

    public function photos()
    {
        return $this->hasMany(PropertyPhoto::class);
    }

    public function usages()
    {
        return $this->hasMany(PropertyUsage::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function visitRequests()
    {
        return $this->hasMany(VisitRequest::class);
    }

    // Accessors for compatibility
    public function getBathroomsAttribute()
    {
        // Simplified calculation: 1 bathroom per 2 rooms, minimum 1
        return max(1, intval($this->rooms / 2));
    }

    public function getSquareFeetAttribute()
    {
        return $this->superficie ?? 0;
    }

    public function getPhotoUrlAttribute()
    {
        $photo = $this->photos()->first();
        return $photo ? $photo->url : null;
    }

    // Methods
    public function similarProperties($limit = 4)
    {
        return Property::where('status', 'publiee')
            ->where('type', $this->type)
            ->where('id', '!=', $this->id)
            ->where('option', $this->option)
            ->limit($limit)
            ->get();
    }

    public function isFavoritedBy($user = null)
    {
        if (!$user) {
            $user = auth()->user();
        }
        return $this->favorites()->where('user_id', $user->id)->exists();
    }
}