<?php

declare(strict_types=1);

namespace App\Domain\Locations\Models;

use App\Domain\Trips\Models\Trip;
use Database\Factories\LocationFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory;
    use HasUlids;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'trip_id',
        'name',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    /**
     * @return BelongsTo<\App\Domain\Trips\Models\Trip, \App\Domain\Locations\Models\Location>
     */
    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }

    /**
     * @return HasMany<\App\Domain\Locations\Models\LocationImage>
     */
    public function images(): HasMany
    {
        return $this->hasMany(LocationImage::class);
    }

    protected static function newFactory(): LocationFactory
    {
        return LocationFactory::new();
    }
}
