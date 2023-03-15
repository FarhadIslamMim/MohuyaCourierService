<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryManSalary extends Model
{
    use HasFactory;

    // get Employee Details
    public function employeeDetails()
    {
        return $this->belongsTo(Deliveryman::class, 'deliveryman_id', 'id');
    }
}
