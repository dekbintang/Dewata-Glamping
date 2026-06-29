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
        $bookedUnitIds = $this->getBookedUnitIds($checkIn, $checkOut);

        $query = UnitGlamping::whereNotIn('unit_id', $bookedUnitIds)
            ->where('status', 'available');

        if ($unitType) {
            $query->where('unit_type', $unitType);
        }

        return $query->get();
    }

    /**
     * Check if a specific unit is still available for the given date range.
     * Used inside DB::transaction with lockForUpdate to prevent double booking.
     */
    public function isUnitAvailable(int $unitId, string $checkIn, string $checkOut): bool
    {
        // Check unit exists and is bookable
        $unit = UnitGlamping::where('unit_id', $unitId)
            ->whereIn('status', ['available', 'occupied']) // occupied units can still be booked for future dates
            ->first();

        if (!$unit) {
            return false;
        }

        // Check no overlapping reservations (with pessimistic lock)
        $conflicting = Reservation::where('unit_id', $unitId)
            ->whereNotIn('status', ['cancelled', 'checked_out'])
            ->lockForUpdate() // Pessimistic lock to prevent race conditions
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->where(function ($q) use ($checkIn, $checkOut) {
                    // New booking starts during existing booking
                    $q->where('check_in_date', '<', $checkOut)
                      ->where('check_out_date', '>', $checkIn);
                });
            })
            ->exists();

        return !$conflicting;
    }

    /**
     * Get unit IDs that are booked for the given date range
     */
    private function getBookedUnitIds(string $checkIn, string $checkOut): array
    {
        return Reservation::whereNotIn('status', ['cancelled', 'checked_out'])
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->where('check_in_date', '<', $checkOut)
                      ->where('check_out_date', '>', $checkIn);
            })
            ->pluck('unit_id')
            ->toArray();
    }
}
