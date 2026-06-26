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

    public function processCheckIn(Request $request)
    {
        $request->validate([
            'booking_code' => 'required|exists:reservations,booking_code',
        ]);

        $reservation = Reservation::where('booking_code', $request->booking_code)
            ->where('status', 'confirmed')
            ->firstOrFail();

        DB::transaction(function () use ($reservation) {
            $reservation->update(['status' => 'checked_in']);
            $reservation->unit->update(['status' => 'occupied']);

            CheckInOut::create([
                'reservation_id' => $reservation->reservation_id,
                'user_id' => auth()->id(),
                'check_in_time' => Carbon::now(),
            ]);
        });

        return redirect()->route('erp.dashboard')->with('success', 'Check-in berhasil.');
    }

    public function checkOutForm($id, BillingService $billingService)
    {
        $reservation = Reservation::with(['customer', 'unit', 'fnbOrders'])->findOrFail($id);
        $billing = $billingService->calculateInvoice($reservation);
        
        return view('transaksi.checkout.form', compact('reservation', 'billing'));
    }

    public function processCheckOut($id, Request $request, BillingService $billingService)
    {
        $reservation = Reservation::findOrFail($id);

        DB::transaction(function () use ($reservation, $request, $billingService) {
            // Generate Invoice
            $invoice = $billingService->generateInvoice($reservation);

            // Update statuses
            $reservation->update(['status' => 'checked_out']);
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

        return redirect()->route('erp.dashboard')->with('success', 'Check-out berhasil diproses.');
    }
}
