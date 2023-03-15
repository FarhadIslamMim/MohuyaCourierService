<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    public function getHeadDetails()
    {
        return $this->belongsTo(ExpenseCategory::class, 'cat_id', 'id');
    }
}
