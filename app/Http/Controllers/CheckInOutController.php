<?php

namespace App\Http\Controllers;

use App\Models\CheckInOut;
use App\Models\Reservation;
use App\Models\UnitGlamping;
use App\Models\Housekeeping;
use App\Services\BillingService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckInOutController extends Controller
{
    public function checkInForm()
    {
        return view('transaksi.checkin.form');
    }

    /**
     * Step 1: Look up booking code and show preview before confirming check-in
     */
    public function previewCheckIn(Request $request)
    {
        $request->validate([
            'booking_code' => 'required|string',
        ]);

        $reservation = Reservation::with(['customer', 'unit'])
            ->where('booking_code', strtoupper(trim($request->booking_code)))
            ->first();

        if (!$reservation) {
            return back()->with('error', 'Kode booking tidak ditemukan.')->withInput();
        }

        if (!$reservation->canTransitionTo('checked_in')) {
            return back()->with('error', "Reservasi dengan status '{$reservation->status}' tidak bisa di-check-in.")->withInput();
        }

        return view('transaksi.checkin.preview', compact('reservation'));
    }

    /**
     * Step 2: Actually process check-in after staff confirms
     */
    public function processCheckIn(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,reservation_id',
        ]);

        $reservation = Reservation::with('unit')->findOrFail($request->reservation_id);

        // Guard: only confirmed reservations can be checked in
        if (!$reservation->canTransitionTo('checked_in')) {
            return redirect()->route('erp.transaksi.checkin.form')
                ->with('error', "Reservasi tidak bisa di-check-in dari status '{$reservation->status}'.");
        }

        DB::transaction(function () use ($reservation) {
            $reservation->transitionTo('checked_in');
            $reservation->unit->update(['status' => 'occupied']);

            CheckInOut::create([
                'reservation_id' => $reservation->reservation_id,
                'user_id' => auth()->id(),
                'check_in_time' => Carbon::now(),
            ]);
        });

        return redirect()->route('erp.transaksi.checkin.form')
            ->with('success', "Check-in berhasil untuk tamu {$reservation->customer->name} di {$reservation->unit->unit_name}.");
    }

    public function checkOutForm($id, BillingService $billingService)
    {
        $reservation = Reservation::with(['customer', 'unit', 'fnbOrders.details'])->findOrFail($id);

        // Guard: only checked_in can view checkout form
        if ($reservation->status !== 'checked_in') {
            return redirect()->route('erp.transaksi.checkin.form')
                ->with('error', "Reservasi dengan status '{$reservation->status}' tidak bisa di-checkout.");
        }

        $billing = $billingService->calculateInvoice($reservation);

        return view('transaksi.checkout.form', compact('reservation', 'billing'));
    }

    public function processCheckOut($id, Request $request, BillingService $billingService)
    {
        $reservation = Reservation::with(['unit', 'customer', 'checkInOut'])->findOrFail($id);

        // Guard: only checked_in can be checked out
        if (!$reservation->canTransitionTo('checked_out')) {
            return redirect()->route('erp.transaksi.checkin.form')
                ->with('error', "Reservasi tidak bisa di-checkout dari status '{$reservation->status}'.");
        }

        DB::transaction(function () use ($reservation, $billingService) {
            // Generate Invoice
            $invoice = $billingService->generateInvoice($reservation);

            // Update statuses
            $reservation->transitionTo('checked_out');
            $reservation->unit->update(['status' => 'cleaning']);

            // Update CheckInOut
            $checkInOut = $reservation->checkInOut;
            if ($checkInOut) {
                $checkInOut->update([
                    'check_out_time' => Carbon::now(),
                ]);
            }

            // Trigger Housekeeping
            Housekeeping::create([
                'unit_id' => $reservation->unit_id,
                'status' => 'dirty',
            ]);

            // Update CRM Segment
            $customer = $reservation->customer;
            $customer->increment('total_visits');
            $customer->updateSegment();
        });

        return redirect()->route('erp.transaksi.checkin.form')
            ->with('success', 'Check-out berhasil diproses. Invoice telah dibuat.');
    }
}
