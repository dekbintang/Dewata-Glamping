@extends('layouts.app')

@section('title', 'Invoice Detail')
@section('header', 'Pembayaran')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('erp.transaksi.pembayaran.index') }}" class="text-sm text-gray-400 hover:text-gray-600">← Kembali</a>
            <a href="{{ route('erp.laporan.invoice.download', $invoice->invoice_id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 flex items-center gap-1.5 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Download PDF
            </a>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-8">
            <!-- Header -->
            <div class="flex justify-between border-b border-gray-100 pb-5 mb-5">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <div class="w-7 h-7 bg-blue-600 rounded-md flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        </div>
                        <span class="text-lg font-bold text-gray-800">GlampERP</span>
                    </div>
                    <p class="text-xs text-gray-400">Sistem Informasi Glamping</p>
                </div>
                <div class="text-right">
                    <p class="text-xl text-gray-200 font-bold uppercase tracking-widest">INVOICE</p>
                    <p class="font-mono text-sm font-semibold text-gray-700 mt-1">{{ $invoice->invoice_number }}</p>
                    <p class="text-xs text-gray-400 mt-1">{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d M Y') }}</p>
                    <div class="mt-2"><x-status-badge :status="$invoice->status" /></div>
                </div>
            </div>

            <!-- Info -->
            <div class="grid grid-cols-2 gap-6 mb-6 text-sm">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase mb-1.5">Ditagihkan Kepada</p>
                    <p class="font-medium text-gray-800">{{ $invoice->reservation->customer->name }}</p>
                    <p class="text-gray-500">{{ $invoice->reservation->customer->phone }}</p>
                    <p class="text-gray-500">{{ $invoice->reservation->customer->email }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase mb-1.5">Rincian Reservasi</p>
                    <p class="text-gray-800">Unit: {{ $invoice->reservation->unit->unit_name }}</p>
                    <p class="text-gray-500">Kode: {{ $invoice->reservation->booking_code }}</p>
                    <p class="text-gray-500">{{ $invoice->reservation->check_in_date->format('d M Y') }} — {{ $invoice->reservation->check_out_date->format('d M Y') }}</p>
                </div>
            </div>

            <!-- Tabel Biaya -->
            <table class="w-full text-sm mb-6">
                <thead>
                    <tr class="border-y border-gray-200 bg-gray-50">
                        <th class="py-2.5 px-4 text-left text-xs font-semibold text-gray-500 uppercase">Deskripsi</th>
                        <th class="py-2.5 px-4 text-right text-xs font-semibold text-gray-500 uppercase">Jumlah</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr>
                        <td class="py-3 px-4 text-gray-800">Akomodasi ({{ $invoice->reservation->check_in_date->diffInDays($invoice->reservation->check_out_date) }} Malam)</td>
                        <td class="py-3 px-4 text-right font-medium text-gray-800">Rp {{ number_format($invoice->reservation->unit->base_price * $invoice->reservation->check_in_date->diffInDays($invoice->reservation->check_out_date), 0, ',', '.') }}</td>
                    </tr>
                    @foreach($invoice->reservation->fnbOrders as $order)
                        <tr>
                            <td class="py-3 px-4 text-gray-800">F&B Order #{{ $order->order_id }}</td>
                            <td class="py-3 px-4 text-right font-medium text-gray-800">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="border-t-2 border-gray-300">
                        <td class="py-3 px-4 text-right font-bold text-gray-800">TOTAL</td>
                        <td class="py-3 px-4 text-right text-xl font-bold text-blue-600">Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>

            <div class="text-center text-xs text-gray-400 border-t border-gray-100 pt-5">
                Terima kasih telah memilih GlampERP. Kami berharap Anda menikmati pengalaman glamping bersama kami.
            </div>
        </div>
    </div>
@endsection
