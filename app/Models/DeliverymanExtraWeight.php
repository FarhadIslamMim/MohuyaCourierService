<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliverymanExtraWeight extends Model
{
    use HasFactory;

    protected $fillable = ['deliveryman_id','weight_id'];
}
