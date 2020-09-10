<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    const NOSENT = 1;
    const REJECTED = 2;
    const OBSERVED = 3;
    const APPROVED = 4;

    protected $fillable = [
        "name", "proof_id", "order_id", "status", "correlative"
    ];

    public function order () {
        return $this->belongsTo(Order::class);
    }
}
