<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Services\AvailabilityService;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        return view('transaksi.reservasi.index');
    }

    public function create()
    {
        return view('transaksi.reservasi.create');
    }

    public function store(Request $request)
    {
        // Handled via Livewire AvailabilityChecker
    }

    public function show(Reservation $reservasi)
    {
        $reservasi->load(['customer', 'unit', 'fnbOrders', 'payment', 'invoice']);
        return view('transaksi.reservasi.show', compact('reservasi'));
    }

    /**
     * Confirm a reservation (only from 'pending' status)
     */
    public function confirm(Reservation $reservasi, AvailabilityService $availabilityService)
    {
        // Guard: only pending can be confirmed
        if (!$reservasi->canTransitionTo('confirmed')) {
            return back()->with('error', "Reservasi tidak bisa dikonfirmasi dari status '{$reservasi->status}'.");
        }

        // Guard: reject if check-in date has passed
        if ($reservasi->check_in_date->isPast()) {
            return back()->with('error', 'Tanggal check-in sudah lewat. Reservasi tidak bisa dikonfirmasi.');
        }

        // Guard: re-check unit availability to prevent double booking
        if (!$availabilityService->isUnitAvailable(
            $reservasi->unit_id,
            $reservasi->check_in_date->toDateString(),
            $reservasi->check_out_date->toDateString()
        )) {
            return back()->with('error', 'Unit sudah tidak tersedia untuk tanggal tersebut.');
        }

        $reservasi->transitionTo('confirmed');
        return back()->with('success', 'Reservasi berhasil dikonfirmasi.');
    }

    /**
     * Cancel a reservation (only from 'pending' or 'confirmed')
     */
    public function cancel(Reservation $reservasi)
    {
        if (!$reservasi->canTransitionTo('cancelled')) {
            return back()->with('error', "Reservasi tidak bisa dibatalkan dari status '{$reservasi->status}'.");
        }

        $message = 'Reservasi dibatalkan.';

        // If customer already paid DP, flag it
        if ($reservasi->has_dp) {
            $dpAmount = number_format($reservasi->dp_amount, 0, ',', '.');
            $message = "Reservasi dibatalkan. Catatan: DP sebesar Rp {$dpAmount} perlu diproses refund secara manual.";
        }

        $reservasi->transitionTo('cancelled');

        // Release unit if it was being held
        if ($reservasi->unit && $reservasi->unit->status === 'occupied') {
            $reservasi->unit->update(['status' => 'available']);
        }

        return back()->with('success', $message);
    }
}
