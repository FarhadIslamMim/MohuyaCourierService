<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliverymanArea extends Model
{
    use HasFactory;

    protected $fillable = ['deliveryman_id'];

    public function getAreaName()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }
}
