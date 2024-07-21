<?php

declare(strict_types=1);

namespace App\Domain\Locations\Models;

use Database\Factories\LocationImageFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static \Database\Factories\LocationImageFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|LocationImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationImage onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationImage withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationImage withoutTrashed()
 * @mixin \Eloquent
 */
class LocationImage extends Model
{
    /** @use HasFactory<LocationImageFactory> */
    use HasFactory;
    use HasUlids;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'location_id',
        'name',
        'path',
    ];

    protected static function newFactory(): LocationImageFactory
    {
        return LocationImageFactory::new();
    }
}
