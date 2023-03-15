<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantExcludedWeights extends Model
{
    use HasFactory;

    protected $fillable = ['merchant_id', 'weight_id'];


    /**
     * Method getWeightName
     *
     * @return void
     */
    public function getWeightName()
    {
        return $this->belongsTo(Weight::class, 'weight_id', 'id');
    }
}
