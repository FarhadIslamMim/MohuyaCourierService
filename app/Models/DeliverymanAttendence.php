<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliverymanAttendence extends Model
{
    use HasFactory;

    protected $fillable = ['deliveryman_id', 'status', 'starttime', 'endtime', 'date', 'created_at', 'updated_at'];

    // get employee data
    public function employeData()
    {
        return $this->belongsTo(Deliveryman::class, 'deliveryman_id', 'id')->select('id', 'name');
    }
}
