<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
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
        // Handled via Livewire form typically, or standard store if non-livewire
    }

    public function show(Reservation $reservasi)
    {
        $reservasi->load(['customer', 'unit', 'fnbOrders', 'payment', 'invoice']);
        return view('transaksi.reservasi.show', compact('reservasi'));
    }

    public function confirm(Reservation $reservasi)
    {
        $reservasi->update(['status' => 'confirmed']);
        return back()->with('success', 'Reservasi berhasil dikonfirmasi.');
    }
    
    public function cancel(Reservation $reservasi)
    {
        $reservasi->update(['status' => 'cancelled']);
        return back()->with('success', 'Reservasi dibatalkan.');
    }
}
