<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnitGlamping extends Model
{
    use SoftDeletes;

    protected $table = 'unit_glamping';
    protected $primaryKey = 'unit_id';

    protected $fillable = [
        'unit_name', 'unit_type', 'price_per_night',
        'status', 'description', 'capacity',
    ];

    /**
     * Accessor: $unit->base_price (alias for price_per_night)
     */
    public function getBasePriceAttribute()
    {
        return $this->price_per_night;
    }

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

    /**
     * Scope: only bookable units (available status, not soft-deleted)
     */
    public function scopeBookable($query)
    {
        return $query->where('status', 'available');
    }

    /**
     * Check if unit has active reservations before deleting
     */
    public function hasActiveReservations(): bool
    {
        return $this->reservations()
            ->whereNotIn('status', ['cancelled', 'checked_out'])
            ->exists();
    }

    /**
     * Override delete to prevent deleting units with active reservations
     */
    public function delete()
    {
        if ($this->hasActiveReservations()) {
            throw new \LogicException(
                "Unit '{$this->unit_name}' tidak bisa dihapus karena masih memiliki reservasi aktif."
            );
        }
        return parent::delete();
    }
}
