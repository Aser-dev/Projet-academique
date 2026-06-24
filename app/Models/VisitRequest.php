<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VisitRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id', 'property_id', 'agent_id',
        'visit_date', 'visit_time', 'status',
    ];

    protected $casts = [
        'visit_date' => 'date',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }
}