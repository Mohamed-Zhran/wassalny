<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;

class Trip extends Model
{
    use HasSpatial;
    use HasFactory;

    protected $fillable = [
        'beginning', 'destination', 'available_seats'
    ];

    protected $casts = [
        'beginning' => Point::class,
        'destination' => Point::class,
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->using(TripUser::class);
    }
}
