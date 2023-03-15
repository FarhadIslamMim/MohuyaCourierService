<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupmanAttendence extends Model
{
    use HasFactory;

    protected $fillable = ['pickupman_id', 'status', 'starttime', 'endtime', 'date', 'created_at', 'updated_at'];

    // get employee data
    public function employeData()
    {
        return $this->belongsTo(Pickupman::class, 'pickupman_id', 'id')->select('id', 'name');
    }
}
