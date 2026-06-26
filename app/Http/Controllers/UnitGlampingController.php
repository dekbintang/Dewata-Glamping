<?php

namespace App\Http\Controllers;

use App\Models\UnitGlamping;
use Illuminate\Http\Request;

class UnitGlampingController extends Controller
{
    public function index()
    {
        $units = UnitGlamping::all();
        return view('master.units.index', compact('units'));
    }
}
