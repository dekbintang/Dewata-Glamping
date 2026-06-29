<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\Reservation;

class BillingService
{
    /**
     * Calculate invoice breakdown for a reservation.
     * Always recalculates F&B from order details to prevent stale totals.
     */
    public function calculateInvoice(Reservation $reservation): array
    {
        $reservation->load(['unit', 'fnbOrders.details']);
        
        $nights = $reservation->total_nights;
        $accommodationCost = $reservation->unit->price_per_night * $nights;
        
        // Always recalculate F&B total from individual order details
        $fnbCost = 0;
        foreach ($reservation->fnbOrders as $order) {
            $orderTotal = $order->details->sum(function ($detail) {
                return ($detail->quantity ?? 0) * ($detail->price ?? 0);
            });
            $fnbCost += $orderTotal;
        }

        $dpPaid = $reservation->dp_amount ?? 0;
        $grandTotal = $accommodationCost + $fnbCost;
        $remaining = $grandTotal - $dpPaid;

        return [
            'total_days'         => $nights,
            'accommodation_cost' => $accommodationCost,
            'fnb_cost'           => $fnbCost,
            'grand_total'        => $grandTotal,
            'dp_paid'            => $dpPaid,
            'remaining'          => max(0, $remaining),
        ];
    }

    /**
     * Generate or update invoice record.
     * Should only be called at checkout time.
     */
    public function generateInvoice(Reservation $reservation): Invoice
    {
        $billing = $this->calculateInvoice($reservation);

        return Invoice::updateOrCreate(
            ['reservation_id' => $reservation->reservation_id],
            [
                'invoice_date' => now(),
                'room_charge'  => $billing['accommodation_cost'],
                'fnb_charge'   => $billing['fnb_cost'],
                'total_amount' => $billing['grand_total'],
                'status'       => 'unpaid',
            ]
        );
    }
}
