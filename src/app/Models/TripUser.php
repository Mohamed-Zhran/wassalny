<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\TripUser
 *
 * @property int $id
 * @property int $user_id
 * @property int $trip_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TripUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TripUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TripUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|TripUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TripUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TripUser whereTripId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TripUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TripUser whereUserId($value)
 *
 * @mixin \Eloquent
 */
class TripUser extends Pivot
{
    //
}
