<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Proof
 *
 * @property int $id
 * @property int $code
 * @property string $name
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Proof newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Proof newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Proof query()
 * @method static \Illuminate\Database\Eloquent\Builder|Proof whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proof whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proof whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proof whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proof whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Proof whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Proof extends Model
{
    const ACTIVE = 1;
    const INACTIVE = 2;
}
