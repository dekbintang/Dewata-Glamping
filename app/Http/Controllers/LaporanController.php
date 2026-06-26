<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function reservasi()
    {
        return view('laporan.reservasi');
    }

    public function pendapatan()
    {
        return view('laporan.pendapatan');
    }

    public function okupansi()
    {
        return view('laporan.okupansi');
    }

    public function fnb()
    {
        return view('laporan.fnb');
    }
}
