<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    public function getHeadDetails()
    {
        return $this->belongsTo(IncomeCateogry::class, 'cat_id', 'id');
    }
}
