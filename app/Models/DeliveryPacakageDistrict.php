<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryPacakageDistrict extends Model
{
    use HasFactory;

    /**
     * Method getThanas
     *
     * @return void
     */
    public function getThanas()
    {
        return $this->belongsTo(Thana::class, 'district_id', 'id');
    }
    
    /**
     * Method getDistricts
     *
     * @return void
     */
    public function getDistricts()
    {
        return $this->belongsTo(District::class,'district_id','id');
    }
}
