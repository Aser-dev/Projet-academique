<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'phone', 'address', 'avatar', 'is_active', 'assigned_agent_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Rôles disponibles
    const ROLES = ['client', 'bailleur', 'agent', 'manager'];

    // Relations
    public function properties()
    {
        return $this->hasMany(Property::class, 'user_id');
    }

    public function validatedProperties()
    {
        return $this->hasMany(Property::class, 'validated_by');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'user_id');
    }

    public function visitRequests()
    {
        return $this->hasMany(VisitRequest::class, 'client_id');
    }

    public function assignedVisits()
    {
        return $this->hasMany(VisitRequest::class, 'agent_id');
    }

    public function clientAffectation()
    {
        return $this->hasOne(ClientAgent::class, 'client_id');
    }

    public function agentAffectations()
    {
        return $this->hasMany(ClientAgent::class, 'agent_id');
    }

    public function assignedAgent()
    {
        return $this->belongsTo(User::class, 'assigned_agent_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // Vérification du rôle
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }
}