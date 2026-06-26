<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DssController extends Controller
{
    public function index()
    {
        return view('dss.index');
    }
    
    // Logic handled in livewire DssPricingPanel
}
