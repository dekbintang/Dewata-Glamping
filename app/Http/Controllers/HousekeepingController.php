<?php

namespace App\Http\Controllers;

use App\Models\Housekeeping;
use Illuminate\Http\Request;

class HousekeepingController extends Controller
{
    public function index()
    {
        return view('transaksi.housekeeping.index');
    }
}
