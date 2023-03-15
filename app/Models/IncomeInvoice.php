<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeInvoice extends Model
{
    use HasFactory;

    public function getIncomeDetails()
    {
        return $this->hasMany(Income::class, 'invoice_id', 'invoice_id')->with('getHeadDetails');
    }
}
