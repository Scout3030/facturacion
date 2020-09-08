<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\OrderLine
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLine query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLine whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $order_id
 * @property int $product_id
 * @property float $price
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLine whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLine wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLine whereProductId($value)
 * @property int $qty
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLine whereQty($value)
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Product $product
 * @method static \Illuminate\Database\Query\Builder|OrderLine onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLine whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|OrderLine withTrashed()
 * @method static \Illuminate\Database\Query\Builder|OrderLine withoutTrashed()
 */
class OrderLine extends Model
{
    use softDeletes;

    protected $fillable = [
        'order_id', 'product_id', 'price'
    ];

    public function product () {
        return $this->belongsTo(Product::class);
    }
}
