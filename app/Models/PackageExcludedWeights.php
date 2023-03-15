<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageExcludedWeights extends Model
{
    use HasFactory;
    protected $fillable = ['package_id', 'weight_id'];

    public function weigtsName()
    {
        $this->belongsTo(Weight::class,'weight_id','id');
    }
}
