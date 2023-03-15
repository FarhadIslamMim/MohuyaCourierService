<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliverycharge extends Model
{
    use HasFactory;

    public function parcels()
    {
        return $this->hasMany(Parcel::class, 'orderType', 'id');
    }

    public function deliveryChargeHead()
    {
        return $this->belongsTo(DeliveryChargeHead::class);
    }
}
