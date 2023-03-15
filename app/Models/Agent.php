<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    public function paymentSummary()
    {
        return [
            'total_parcel' => Parcel::where('agentId', $this->id)->count(),
            'total_parcel_paid' => Parcel::where('agentId', $this->id)->where('agent_paid', '>', 0)->count(),
            'due_parcel' => Parcel::where('agentId', $this->id)->where('agent_paid', '=', 0)->count(),
            'total_amount' => Parcel::where('agentId', $this->id)->sum('agent_amount'),
            'total_paid' => Parcel::where('agentId', $this->id)->sum('agent_paid'),
            'total_due' => Parcel::where('agentId', $this->id)->sum('agent_due'),
        ];
    }


    // get thana
    public function getThana()
    {
        return $this->hasMany(AgentThana::class)->with('getThanaName');
    }
}
