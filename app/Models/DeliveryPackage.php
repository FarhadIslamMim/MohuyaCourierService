<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryPackage extends Model
{
    use HasFactory;


    /**
     * Method getDeliveryAreas
     *
     * @return void
     */
    public function getDeliveryAreas()
    {
        return $this->hasMany(DeliveryPackageArea::class, 'delivery_package_id', 'id')->with('getThanas');
    }

    /**
     * Method getDeliveryHead
     *
     * @return void
     */
    public function getDeliveryHead()
    {
        return $this->belongsTo(DeliveryChargeHead::class, 'delivery_charge_head', 'id');
    }


    /**
     * Method getDeliveryDistrict
     *
     * @return void
     */
    public function getDeliveryDistrict()
    {
        return $this->hasMany(DeliveryPacakageDistrict::class, 'package_id', 'id');
    }

    /**
     * Method getWeights
     *
     * @return void
     */
    public function getWeights()
    {
        return $this->hasMany(PackageExcludedWeights::class, 'package_id', 'id');
    }
    
    /**
     * Method getDistricts
     *
     * @return void
     */
    public function getDistricts()
    {
       return $this->hasMany(DeliveryPacakageDistrict::class,'package_id','id')->with('getDistricts');
    }
}
