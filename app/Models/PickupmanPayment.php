<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupmanPayment extends Model
{
    use HasFactory;

    protected $fillable = ['pickupman_id'];

    public function pickupman()
    {
        return $this->belongsTo(Pickupman::class);
    }

    public function parcel()
    {
        return $this->belongsTo(Parcel::class);
    }


    public function getPercelDetails()
    {
        return $this->belongsTo(Parcel::class, 'id', 'pickupman_payment_invoice')->with('pickupman');
    }

    public function geDeatilsPickupman()
    {
        return $this->belongsTo(Parcel::class, 'pickupmanId', 'pickupmanId')->with('pickupman');
    }
    public function getCreatedAtAttribute($value) {
        return date("d M Y",strtotime($value));
    }
    
    public function getUpdatedAtAttribute($value) {
        return date("d M Y",strtotime($value));
    }
}
