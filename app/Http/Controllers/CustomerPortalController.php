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

    public function confirmation($code)
    {
        return view('portal.confirmation', compact('code'));
    }
}
