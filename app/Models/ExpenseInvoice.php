<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseInvoice extends Model
{
    use HasFactory;

    // get details
    public function getExpenseDetails()
    {
        return $this->hasMany(Expense::class, 'invoice_id', 'invoice_id')->with('getHeadDetails');
    }
}
