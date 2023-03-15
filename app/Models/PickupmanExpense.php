<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupmanExpense extends Model
{
    use HasFactory;

    public function pickupmanDetails()
    {
        return $this->belongsTo(Pickupman::class, 'pickupman_id', 'id')->select('id', 'name', 'phone');
    }
}
