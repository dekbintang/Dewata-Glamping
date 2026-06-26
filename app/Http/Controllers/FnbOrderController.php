<?php

namespace App\Http\Controllers;

use App\Models\FnbOrder;
use Illuminate\Http\Request;

class FnbOrderController extends Controller
{
    public function index()
    {
        return view('transaksi.fnb.index');
    }

    public function create()
    {
        return view('transaksi.fnb.create');
    }
}
