<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitGlamping extends Model
{
    protected $table = 'unit_glamping';
    protected $primaryKey = 'unit_id';

    protected $fillable = [
        'unit_name', 'unit_type', 'price_per_night',
        'status', 'description', 'capacity',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'unit_id');
    }

    public function housekeeping()
    {
        return $this->hasMany(Housekeeping::class, 'unit_id');
    }

    public function latestHousekeeping()
    {
        return $this->hasOne(Housekeeping::class, 'unit_id')->latestOfMany();
    }
}
