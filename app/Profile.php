<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Profile
 *
 * @property int $id
 * @property string $name
 * @property string $phone_number
 * @property string $address
 * @property string $email
 * @property string|null $image
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile query()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Profile extends Model
{
    protected $table = 'profile';

    protected $fillable = [
        'name',
        'address',
        'phone_number',
        'email',
        'image',
        'description'
    ];

    public function pathAttachment () {
        return $this->image ? "/images/profile/" . $this->image : asset('assets/images/default/default_profile.png');
    }
}
