<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\Reservation;

class BillingService
{
    /**
     * Calculate invoice breakdown for a reservation
     */
    public function calculateInvoice(Reservation $reservation): array
    {
        $nights = $reservation->total_nights;
        $roomCharge = $reservation->unit->price_per_night * $nights;
        $fnbCharge = $reservation->fnbOrders->sum('total_amount');
        $dpPaid = $reservation->dp_amount ?? 0;
        $totalAmount = $roomCharge + $fnbCharge;
        $remaining = $totalAmount - $dpPaid;

        return compact('roomCharge', 'fnbCharge', 'totalAmount', 'dpPaid', 'remaining', 'nights');
    }

    /**
     * Generate or update invoice record
     */
    public function generateInvoice(Reservation $reservation): Invoice
    {
        $billing = $this->calculateInvoice($reservation);

        return Invoice::updateOrCreate(
            ['reservation_id' => $reservation->reservation_id],
            [
                'invoice_date' => now(),
                'room_charge'  => $billing['roomCharge'],
                'fnb_charge'   => $billing['fnbCharge'],
                'total_amount' => $billing['totalAmount'],
                'status'       => 'unpaid',
            ]
        );
    }
}
