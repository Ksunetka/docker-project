<?php

namespace App\Models;

use App\Events\User\Creating;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string $phone
 * @property string $address
 * @property string $city
 *
 * @method static self firstWhere(...$params)
 * @method static self updateOrCreate(...$params)
 * @method static self find(...$params)
 * @method get()
 */
class User extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $dispatchesEvents = [
        'creating' => Creating::class,
    ];
}
