<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\UnitGlamping;
use App\Services\DynamicPricingService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(DynamicPricingService $dss)
    {
        $today = Carbon::today();
        
        $totalReservasi = Reservation::whereDate('created_at', $today)->count();
        $okupansiHariIni = Reservation::where('status', 'checked_in')->count();
        $pendapatanBulanIni = \App\Models\Invoice::whereMonth('invoice_date', $today->month)
                                                 ->whereYear('invoice_date', $today->year)
                                                 ->where('status', 'paid')
                                                 ->sum('total_amount');
        $unitTersedia = UnitGlamping::where('status', 'available')->count();
        
        $units = UnitGlamping::all();

        return view('dashboard.index', compact(
            'totalReservasi', 
            'okupansiHariIni', 
            'pendapatanBulanIni', 
            'unitTersedia',
            'units'
        ));
    }
}
