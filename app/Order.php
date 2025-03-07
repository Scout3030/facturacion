<?php

namespace App;

use App\Traits\Hashidable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Order
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $client_id
 * @property float $total
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTotal($value)
 * @property-read \App\Client $client
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\OrderLine[] $orderLines
 * @property-read int|null $order_lines_count
 * @property int $currency_id
 * @property-read \App\Currency $currency
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCurrencyId($value)
 */
class Order extends Model
{
    use Hashidable;

    protected $fillable = [
        'client_id', 'total',
    ];

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function orderLines(){
        return $this->hasMany(OrderLine::class);
    }

    public function currency () {
        return $this->belongsTo(Currency::class);
    }
}
