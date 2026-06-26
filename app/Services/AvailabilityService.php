<?php

namespace App\Services;

use App\Models\Reservation;
use App\Models\UnitGlamping;
use Illuminate\Database\Eloquent\Collection;

class AvailabilityService
{
    /**
     * Get available units for given date range and optional type filter
     */
    public function getAvailableUnits(string $checkIn, string $checkOut, string $unitType = null): Collection
    {
        $bookedUnitIds = Reservation::where('status', '!=', 'cancelled')
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->whereBetween('check_in_date', [$checkIn, $checkOut])
                    ->orWhereBetween('check_out_date', [$checkIn, $checkOut])
                    ->orWhere(function ($q) use ($checkIn, $checkOut) {
                        $q->where('check_in_date', '<=', $checkIn)
                            ->where('check_out_date', '>=', $checkOut);
                    });
            })->pluck('unit_id');

        $query = UnitGlamping::whereNotIn('unit_id', $bookedUnitIds)
            ->where('status', 'available');

        if ($unitType) {
            $query->where('unit_type', $unitType);
        }

        return $query->get();
    }
}
