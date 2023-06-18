<?php

declare(strict_types=1);

namespace App\Domain\Trips\Models;

use Database\Factories\TripFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    protected static function newFactory(): TripFactory
    {
        return TripFactory::new();
    }
}
