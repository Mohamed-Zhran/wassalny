<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;

class Trip extends Model
{
    use HasSpatial;
    use HasFactory;

    protected $fillable = [
        'beginning_lat', 'beginning_lng', 'destination_lat', 'destination_lng', 'available_seats'
    ];


    public function users()
    {
        return $this->belongsToMany(User::class)->using(TripUser::class);
    }

    protected function beginning(): Attribute
    {
        return Attribute::make(
            get: fn () => new Point($this->beginning_lat, $this->beginning_lng)
        );
    }

    protected function destination(): Attribute
    {
        return Attribute::make(get: fn ($vale) => new Point($this->destination_lat, $this->destination_lng));
    }
}
