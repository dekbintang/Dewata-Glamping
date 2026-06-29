<?php

namespace App\Services;

use App\Models\Reservation;
use App\Models\UnitGlamping;
use Carbon\Carbon;

class DynamicPricingService
{
    /**
     * Bobot kriteria SAW
     */
    private array $weights = [
        'occupancy_last_week'  => 0.40,
        'occupancy_last_month' => 0.30,
        'is_weekend'           => 0.20,
        'is_peak_season'       => 0.10,
    ];

    /**
     * Calculate recommendation for a specific unit
     */
    public function calculateRecommendation(int $unitId, string $date): array
    {
        $unit = UnitGlamping::findOrFail($unitId);
        
        // Fallback Logic: Cek apakah ada data yang cukup dalam 30 hari terakhir
        $lastMonth = [
            Carbon::parse($date)->subDays(30)->toDateString(),
            Carbon::parse($date)->toDateString(),
        ];
        $totalReservations = Reservation::where('unit_id', $unitId)
            ->whereBetween('check_in_date', $lastMonth)
            ->where('status', '!=', 'cancelled')
            ->count();
            
        if ($totalReservations < 3) {
            return [
                'score'           => 0.5,
                'adjustment'      => 1.00,
                'suggested_price' => $unit->base_price,
                'criteria'        => $this->getCriteriaForUnit($unit, $date),
                'insufficient_data' => true,
                'message'         => 'Data historis belum cukup untuk analisis.'
            ];
        }

        $criteria = $this->getCriteriaForUnit($unit, $date);
        $normalized = $this->normalize($criteria);
        $score = $this->calculateSAW($normalized);

        // Map skor ke adjustment harga
        if ($score >= 0.75) {
            $adjustment = 1.20;
        } elseif ($score >= 0.50) {
            $adjustment = 1.10;
        } elseif ($score >= 0.25) {
            $adjustment = 1.00;
        } else {
            $adjustment = 0.90;
        }

        return [
            'score'           => round($score, 4),
            'adjustment'      => $adjustment,
            'suggested_price' => round($unit->base_price * $adjustment, -3),
            'criteria'        => $criteria,
        ];
    }

    /**
     * Generate pricing recommendation using SAW method (by unit type)
     */
    public function recommend(string $unitType, string $date): array
    {
        $lastMonth = [
            Carbon::parse($date)->subDays(30)->toDateString(),
            Carbon::parse($date)->toDateString(),
        ];
        
        $totalReservations = Reservation::whereHas('unit', fn($q) => $q->where('unit_type', $unitType))
            ->whereBetween('check_in_date', $lastMonth)
            ->where('status', '!=', 'cancelled')
            ->count();
            
        $basePrice = UnitGlamping::where('unit_type', $unitType)->avg('base_price');
            
        if ($totalReservations < 5) {
            return [
                'unit_type'         => $unitType,
                'date'              => $date,
                'score'             => 0.5,
                'label'             => 'Data Historis Belum Cukup',
                'base_price'        => $basePrice,
                'recommended_price' => $basePrice,
                'adjustment'        => 1.00,
                'criteria'          => $this->getCriteria($unitType, $date),
                'insufficient_data' => true
            ];
        }

        $criteria = $this->getCriteria($unitType, $date);
        $normalized = $this->normalize($criteria);
        $score = $this->calculateSAW($normalized);

        if ($score >= 0.75) {
            $adjustment = 1.20;
            $label = 'Harga Tinggi (High Demand)';
        } elseif ($score >= 0.50) {
            $adjustment = 1.10;
            $label = 'Harga Sedang (Normal Demand)';
        } else {
            $adjustment = 1.00;
            $label = 'Harga Normal (Low Demand)';
        }

        $basePrice = UnitGlamping::where('unit_type', $unitType)->avg('base_price');

        return [
            'unit_type'         => $unitType,
            'date'              => $date,
            'score'             => round($score, 4),
            'label'             => $label,
            'base_price'        => $basePrice,
            'recommended_price' => round($basePrice * $adjustment, -3),
            'adjustment'        => $adjustment,
            'criteria'          => $criteria,
        ];
    }

    /**
     * Get criteria for a specific unit
     */
    private function getCriteriaForUnit(UnitGlamping $unit, string $date): array
    {
        $lastWeek = [
            Carbon::parse($date)->subDays(7)->toDateString(),
            Carbon::parse($date)->toDateString(),
        ];
        $lastMonth = [
            Carbon::parse($date)->subDays(30)->toDateString(),
            Carbon::parse($date)->toDateString(),
        ];

        $occupancyWeek = Reservation::where('unit_id', $unit->unit_id)
            ->whereBetween('check_in_date', $lastWeek)
            ->where('status', '!=', 'cancelled')
            ->count() / 7;

        $occupancyMonth = Reservation::where('unit_id', $unit->unit_id)
            ->whereBetween('check_in_date', $lastMonth)
            ->where('status', '!=', 'cancelled')
            ->count() / 30;

        $isWeekend = in_array(Carbon::parse($date)->dayOfWeek, [5, 6]);
        $isPeakSeason = in_array(Carbon::parse($date)->month, [7, 8, 12]);

        return [
            'occupancy_last_week'  => min($occupancyWeek, 1),
            'occupancy_last_month' => min($occupancyMonth, 1),
            'is_weekend'           => $isWeekend ? 1 : 0,
            'is_peak_season'       => $isPeakSeason ? 1 : 0,
        ];
    }

    /**
     * Get criteria values for SAW calculation (by unit type)
     */
    private function getCriteria(string $unitType, string $date): array
    {
        $lastWeek = [
            Carbon::parse($date)->subDays(7)->toDateString(),
            Carbon::parse($date)->toDateString(),
        ];
        $lastMonth = [
            Carbon::parse($date)->subDays(30)->toDateString(),
            Carbon::parse($date)->toDateString(),
        ];

        $totalUnits = UnitGlamping::where('unit_type', $unitType)->count();

        $occupancyWeek = $totalUnits > 0
            ? Reservation::whereHas('unit', fn($q) => $q->where('unit_type', $unitType))
                ->whereBetween('check_in_date', $lastWeek)
                ->where('status', '!=', 'cancelled')
                ->count() / ($totalUnits * 7)
            : 0;

        $occupancyMonth = $totalUnits > 0
            ? Reservation::whereHas('unit', fn($q) => $q->where('unit_type', $unitType))
                ->whereBetween('check_in_date', $lastMonth)
                ->where('status', '!=', 'cancelled')
                ->count() / ($totalUnits * 30)
            : 0;

        $isWeekend = in_array(Carbon::parse($date)->dayOfWeek, [5, 6]);
        $isPeakSeason = in_array(Carbon::parse($date)->month, [7, 8, 12]);

        return [
            'occupancy_last_week'  => min($occupancyWeek, 1),
            'occupancy_last_month' => min($occupancyMonth, 1),
            'is_weekend'           => $isWeekend ? 1 : 0,
            'is_peak_season'       => $isPeakSeason ? 1 : 0,
        ];
    }

    /**
     * Normalize criteria (all benefit type, already 0-1)
     */
    private function normalize(array $criteria): array
    {
        return $criteria;
    }

    /**
     * Calculate SAW score
     */
    private function calculateSAW(array $normalized): float
    {
        $score = 0;
        foreach ($this->weights as $key => $weight) {
            $score += ($normalized[$key] ?? 0) * $weight;
        }
        return $score;
    }
}
