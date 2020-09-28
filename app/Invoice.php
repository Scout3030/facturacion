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

//    public static function boot ()
//    {
//        parent::boot();
//
//        static::saving(function (Invoice $invoice) {
//            if (!\App::runningInConsole()) {
//                $lastInvoice = Invoice::whereProofId($invoice->proof_id)
//                    ->select('correlative')
//                    ->latest()
//                    ->first();
//
//                $invoice->fill([
//                    'correlative' => ($lastInvoice->correlative + 1)
//                ])->save();
//            }
//        });
//    }

    public function order () {
        return $this->belongsTo(Order::class);
    }
}
