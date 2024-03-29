<?php

declare(strict_types=1);

namespace App\Domain\Locations\Models;

use Database\Factories\LocationImageFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LocationImage extends Model
{
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
