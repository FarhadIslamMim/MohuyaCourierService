<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentPayment extends Model
{
    use HasFactory;

    public function getPercelDetails()
    {
        return $this->belongsTo(Parcel::class, 'id', 'agent_payment_invoice')->with('agent');
    }

    public function geDeatilsAgent()
    {
        return $this->belongsTo(Parcel::class, 'agentId', 'agentId')->with('agent');
    }
}
