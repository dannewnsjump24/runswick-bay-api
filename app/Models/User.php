<?php

declare(strict_types=1);

namespace App\Models;

use App\Domain\Trips\Models\Trip;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use HasRoles;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * @phpstan-return \Illuminate\Database\Eloquent\Relations\HasMany<\App\Domain\Trips\Models\Trip>
     */
    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class, 'owner_id');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if (str_contains($this->email, '@jump24.co.uk')) {
            return true;
        }

        return $this->hasRole('Admin');
    }
}
