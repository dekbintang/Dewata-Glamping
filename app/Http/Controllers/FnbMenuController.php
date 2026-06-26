<?php

namespace App\Http\Controllers;

use App\Models\FnbMenu;
use Illuminate\Http\Request;

class FnbMenuController extends Controller
{
    public function index()
    {
        $menus = FnbMenu::all();
        return view('master.menu.index', compact('menus'));
    }
}
