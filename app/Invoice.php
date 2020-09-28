<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Invoice
 *
 * @property int $id
 * @property int $proof_id
 * @property int $order_id
 * @property string $name
 * @property string $status
 * @property int $correlative
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Order $order
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newQuery()
 * @method static \Illuminate\Database\Query\Builder|Invoice onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice query()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereCorrelative($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereProofId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Invoice withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Invoice withoutTrashed()
 * @mixin \Eloquent
 */
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
