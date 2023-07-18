<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Domain\Locations\Models{
/**
 * App\Domain\Locations\Models\Location
 *
 * @property string $id
 * @property string $trip_id
 * @property string $name
 * @property float|null $longitude
 * @property float|null $latitude
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domain\Locations\Models\LocationImage> $images
 * @property-read int|null $images_count
 * @property-read \App\Domain\Trips\Models\Trip|null $trip
 * @method static \Database\Factories\LocationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Location newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Location query()
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereTripId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Location withoutTrashed()
 */
	class Location extends \Eloquent {}
}

namespace App\Domain\Locations\Models{
/**
 * App\Domain\Locations\Models\LocationImage
 *
 * @property int $id
 * @property string $location_id
 * @property string $name
 * @property string $path
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\LocationImageFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|LocationImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationImage onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationImage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationImage whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationImage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationImage wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationImage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationImage withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationImage withoutTrashed()
 */
	class LocationImage extends \Eloquent {}
}

namespace App\Domain\Trips\Models{
/**
 * App\Domain\Trips\Models\Trip
 *
 * @property string $id
 * @property string $name
 * @property int $owner_id
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property \Illuminate\Support\Carbon|null $end_date
 * @property string|null $cover_photo
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $owner
 * @method static \App\Domain\Trips\Collections\TripCollection<int, static> all($columns = ['*'])
 * @method static \Database\Factories\TripFactory factory($count = null, $state = [])
 * @method static \App\Domain\Trips\Collections\TripCollection<int, static> get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Trip newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Trip newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Trip onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Trip query()
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereCoverPhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Trip withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Trip withoutTrashed()
 */
	class Trip extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read \App\Domain\Trips\Collections\TripCollection<int, \App\Domain\Trips\Models\Trip> $trips
 * @property-read int|null $trips_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

