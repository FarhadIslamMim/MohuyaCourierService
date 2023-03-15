<?php

namespace App\Models\Backend\Accounts;

use App\Models\Deliveryman;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliverymanExpense extends Model
{
    use HasFactory;

    public function deliverymanDetails()
    {
        return $this->belongsTo(Deliveryman::class, 'deliveryman_id', 'id')->select('id', 'name', 'phone');
    }
}
