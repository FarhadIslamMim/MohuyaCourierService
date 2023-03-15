<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliverymanPayment extends Model
{
    use HasFactory;

    protected $fillable = ['deliveryman_id'];

    public function deliveryman()
    {
        return $this->belongsTo(Deliveryman::class);
    }

    public function parcel()
    {
        return $this->belongsTo(Parcel::class);
    }


    public function getPercelDetails()
    {
        return $this->belongsTo(Parcel::class, 'id', 'deliveryman_payment_invoice')->with('deliveryman');
    }

    public function geDeatilsDeliveryman()
    {
        return $this->belongsTo(Parcel::class, 'deliverymanId', 'deliverymanId')->with('deliveryman');
    }
    public function getCreatedAtAttribute($value) {
        return date("d M Y",strtotime($value));
    }
    
    public function getUpdatedAtAttribute($value) {
        return date("d M Y",strtotime($value));
    }
}
