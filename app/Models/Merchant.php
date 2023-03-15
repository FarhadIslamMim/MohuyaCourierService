<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function thana()
    {
        return $this->belongsTo(Thana::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function scopeVerify($query)
    {
        return $query->where('verify', 1);
    }

    public function parcelCount()
    {
        $parcelTypes = Parceltype::all();
        $data = [
            'total' => Parcel::where('merchantId', $this->id)->count(),
        ];
        foreach ($parcelTypes as $parcelType) {
            $data[$parcelType->slug] = Parcel::where('merchantId', $this->id)->where('status', $parcelType->id)->count();
        }
        $data['total_amount'] = Parcel::where('merchantId', $this->id)->sum('merchantAmount');
        $data['total_paid'] = Parcel::where('merchantId', $this->id)->sum('merchantPaid');
        $data['total_due'] = Parcel::where('merchantId', $this->id)->sum('merchantDue');

        return $data;
    }
}
