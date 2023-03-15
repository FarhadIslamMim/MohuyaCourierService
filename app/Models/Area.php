<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    public function division()
    {
        return $this->belongsTo(Division::class)->select(['id', 'name']);
    }

    public function district()
    {
        return $this->belongsTo(District::class)->select(['id', 'name']);
    }

    public function thana()
    {
        return $this->belongsTo(Thana::class)->select(['id', 'name']);
    }

    public function deliveryman()
    {
        return $this->belongsTo(Deliveryman::class, 'deliverymen_id');
    }

    public function pickupman()
    {
        return $this->belongsTo(Pickupman::class);
    }
}
