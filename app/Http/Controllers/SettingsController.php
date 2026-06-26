<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function roles()
    {
        return view('settings.roles');
    }

    public function profil()
    {
        return view('settings.profil');
    }
}
