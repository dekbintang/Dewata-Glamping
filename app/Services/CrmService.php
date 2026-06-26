<?php

namespace App\Services;

use App\Models\Customer;

class CrmService
{
    /**
     * Get comprehensive customer summary for CRM profile
     */
    public function getCustomerSummary(Customer $customer): array
    {
        $reservations = $customer->reservations()->with('unit', 'invoice')->get();
        $completedReservations = $reservations->where('status', 'checked_out');

        return [
            'total_visits'       => $customer->total_visits,
            'total_spent'        => $completedReservations->sum(fn($r) => $r->invoice?->total_amount ?? 0),
            'average_spend'      => $completedReservations->count() > 0
                ? $completedReservations->avg(fn($r) => $r->invoice?->total_amount ?? 0)
                : 0,
            'favorite_unit_type' => $completedReservations
                ->groupBy(fn($r) => $r->unit?->unit_type)
                ->sortByDesc(fn($group) => $group->count())
                ->keys()
                ->first(),
            'last_visit'         => $completedReservations
                ->sortByDesc('check_out_date')
                ->first()?->check_out_date,
            'segment'            => $customer->customer_segment,
        ];
    }
}
