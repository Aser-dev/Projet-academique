<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientAgent extends Model
{
    public $timestamps = false;

    protected $fillable = ['client_id', 'agent_id', 'assigned_by'];

    protected $table = 'client_agent';

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }
}