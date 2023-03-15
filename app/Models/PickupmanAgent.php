<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupmanAgent extends Model
{
    use HasFactory;

    protected $fillable = ['pickupman_id'];

    public function agentDetails()
    {
        return $this->hasMany(Agent::class, 'id', 'agent_id');
    }

    // get deliveryman
    public function getPickupMan()
    {
        return $this->hasMany(Pickupman::class, 'id', 'pickupman_id')->select('id', 'name', 'phone');
    }
}
