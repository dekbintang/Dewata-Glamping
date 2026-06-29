<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerPortalController extends Controller
{
    public function index()
    {
        return view('portal.index');
    }

    public function booking()
    {
        return view('portal.booking');
    }

    public function store(Request $request)
    {
        // Handled in Livewire
    }

    public function checkForm()
    {
        return view('portal.check');
    }

    public function verifyCheck(Request $request)
    {
        $request->validate([
            'booking_code' => 'required|string',
            'email' => 'required|email'
        ]);

        $reservation = \App\Models\Reservation::where('booking_code', strtoupper(trim($request->booking_code)))
            ->whereHas('customer', function($q) use ($request) {
                $q->where('email', $request->email);
            })->first();

        if (!$reservation) {
            return back()->with('error', 'Kode booking atau email tidak cocok/tidak ditemukan.');
        }

        // Set session verified
        session(["verified_booking_{$reservation->booking_code}" => true]);

        return redirect()->route('booking.confirmation', $reservation->booking_code);
    }

    public function confirmation($code)
    {
        // Require verification to view this page
        if (!session("verified_booking_{$code}")) {
            return redirect()->route('booking.check')->with('error', 'Silakan verifikasi email Anda untuk melihat reservasi ini.');
        }

        return view('portal.confirmation', compact('code'));
    }
}
