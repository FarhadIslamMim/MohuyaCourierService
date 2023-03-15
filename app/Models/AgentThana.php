<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentThana extends Model
{
    use HasFactory;

    protected $fillable = ['agent_id'];


    // get thana name
    public function getThanaName()
    {
        return $this->belongsTo(Thana::class,'thana_id','id');
    }
}
