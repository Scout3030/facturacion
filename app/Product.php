<?php

namespace App;

use App\Helpers\Currency;
use App\Traits\Hashidable;
use Illuminate\Database\Eloquent\Model;
use NumberFormatter;

/**
 * App\Product
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $category_id
 * @property string $name
 * @property float $cost
 * @property float $price
 * @property int $stock
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStock($value)
 * @property-read mixed $formatted_price
 * @property string $code
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCode($value)
 * @property-read mixed $price_with_taxes
 * @property-read mixed $taxes
 */
class Product extends Model
{
    protected $fillable = [
        "category_id", "name", "code",
        "price", "cost", "stock", "picture"
    ];

    protected $appends = [
        "formatted_price",
        "price_with_taxes",
        "taxes"
    ];

    public function pathAttachment () {
        return $this->picture ? "/images/products/" . $this->picture : asset('assets/images/default/default_user.png');
    }

    public function getFormattedPriceAttribute() {
        return Currency::formatCurrency($this->price);
    }

    public function getTaxesAttribute() {
        return Currency::formatCurrency($this->price * env('TAXES'));
    }

    public function getPriceWithTaxesAttribute() {
        return Currency::formatCurrency($this->price + ($this->price * env('TAXES')));
    }
}
