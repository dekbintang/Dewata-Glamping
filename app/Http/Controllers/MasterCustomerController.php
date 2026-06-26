<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class MasterCustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(20);
        return view('master.customers.index', compact('customers'));
    }
}
