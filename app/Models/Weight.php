<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    use HasFactory;
    
    /**
     * Method getMerchantExcludedWeight
     *
     * @return void
     */
    public static function getMerchantExcludedWeight($weight_id, $id)
    {
        // return "1";
      return MerchantExcludedWeights::where('weight_id', $weight_id)->where('merchant_id', $id)->first();
    }
}
