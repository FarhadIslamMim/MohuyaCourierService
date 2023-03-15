<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliverymanAgent extends Model
{
    use HasFactory;

    protected $fillable = ['deliveryman_id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function agentDetails()
    {
        return $this->hasMany(Agent::class, 'id', 'agent_id');
    }

    // get deliveryman
    public function getDeliveryMan()
    {
       return $this->hasMany(Deliveryman::class,'id','deliveryman_id')->select('id','name','phone');
    }
}
