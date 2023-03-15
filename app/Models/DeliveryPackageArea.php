<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryPackageArea extends Model
{
    use HasFactory;

    public function getThanas()
    {
        return $this->belongsTo(Thana::class, 'delivery_thanas', 'id');
    }
}
