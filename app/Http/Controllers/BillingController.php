<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with(['reservation.customer'])->orderBy('created_at', 'desc')->paginate(20);
        return view('transaksi.pembayaran.index', compact('invoices'));
    }

    public function show($id)
    {
        $invoice = Invoice::with(['reservation.customer', 'reservation.unit', 'reservation.fnbOrders.details'])->findOrFail($id);
        return view('transaksi.pembayaran.show', compact('invoice'));
    }

    public function processPayment(Request $request, $id)
    {
        // Handled in payment controller or livewire
    }

    public function downloadInvoice($id)
    {
        $invoice = Invoice::with(['reservation.customer', 'reservation.unit', 'reservation.fnbOrders.details'])->findOrFail($id);
        
        $pdf = Pdf::loadView('pdf.invoice', compact('invoice'));
        
        return $pdf->download('Invoice-' . $invoice->reservation->booking_code . '.pdf');
    }
}
