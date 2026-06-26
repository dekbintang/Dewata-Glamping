<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Services\CrmService;
use Illuminate\Http\Request;

class CrmController extends Controller
{
    public function index()
    {
        return view('crm.index');
    }

    public function show($id, CrmService $crmService)
    {
        $customer = Customer::with(['reservations.unit', 'notes.user'])->findOrFail($id);
        $summary = $crmService->getCustomerSummary($customer);
        
        return view('crm.show', compact('customer', 'summary'));
    }

    public function addNote(Request $request, $id)
    {
        $request->validate(['note' => 'required|string']);
        
        $customer = Customer::findOrFail($id);
        $customer->notes()->create([
            'user_id' => auth()->id(),
            'note' => $request->note
        ]);
        
        return back()->with('success', 'Catatan ditambahkan.');
    }
}
