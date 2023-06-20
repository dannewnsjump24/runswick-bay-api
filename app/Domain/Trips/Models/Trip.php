<?php

declare(strict_types=1);

namespace App\Domain\Trips\Models;

use App\Domain\Trips\Collections\TripCollection;
use App\Models\User;
use Database\Factories\TripFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trip extends Model
{
    use SoftDeletes;
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'id',
        'owner_id',
        'name',
        'start_date',
        'end_date',
        'cover_photo',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    /**
     * @phpstan-return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\User, \App\Domain\Trips\Models\Trip>
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    protected static function newFactory(): TripFactory
    {
        return TripFactory::new();
    }

    /**
     * @return \App\Domain\Trips\Collections\TripCollection<int, \App\Domain\Trips\Models\Trip>
     */
    public function newCollection(array $models = []): TripCollection
    {
        return new TripCollection($models);
    }
}
