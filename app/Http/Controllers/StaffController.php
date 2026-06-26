<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = User::with('roles')->get();
        return view('master.staff.index', compact('staffs'));
    }
}
