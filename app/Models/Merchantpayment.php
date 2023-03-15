<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchantpayment extends Model
{
    use HasFactory;

    public function getPercelDetails()
    {
        return $this->belongsTo(Parcel::class, 'id', 'paymentInvoice')->with('merchant');
    }

    public function geDeatilsMarchent()
    {
        return $this->belongsTo(Parcel::class, 'merchantId', 'merchantId')->with('merchant');
    }

    public function getPercelDetailsbyDate()
    {
        return $this->belongsTo(Parcel::class, 'created_at', 'updated_at')->with('merchant');
    }
}
