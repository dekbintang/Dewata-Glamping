@extends('layouts.app')

@section('title', 'Laporan Pendapatan')
@section('header', 'Laporan Pendapatan')

@section('content')
    <div class="mb-5">
        <h3 class="text-lg font-semibold text-gray-800">Laporan Pendapatan</h3>
        <p class="text-sm text-gray-400">Ringkasan pendapatan berdasarkan invoice.</p>
    </div>

    @php
        $invoices = \App\Models\Invoice::with(['reservation.customer'])->where('status', 'paid')->latest()->paginate(15);
        $totalPendapatan = \App\Models\Invoice::where('status', 'paid')->sum('total_amount');
    @endphp

    <div class="bg-white rounded-xl border border-gray-200 p-5 mb-4">
        <p class="text-sm text-gray-500">Total Pendapatan (Seluruh Waktu)</p>
        <p class="text-3xl font-bold text-gray-800">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <x-data-table :headers="['#', 'Invoice', 'Tamu', 'Tanggal', 'Jumlah']">
            @foreach($invoices as $i => $inv)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-3 text-gray-400 text-xs">{{ $i + 1 }}</td>
                    <td class="px-5 py-3 font-mono text-xs font-semibold text-gray-700">{{ $inv->invoice_number }}</td>
                    <td class="px-5 py-3 text-gray-800">{{ $inv->reservation->customer->name }}</td>
                    <td class="px-5 py-3 text-gray-600">{{ \Carbon\Carbon::parse($inv->invoice_date)->format('d M Y') }}</td>
                    <td class="px-5 py-3 font-medium text-gray-800">Rp {{ number_format($inv->total_amount, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </x-data-table>
        @if($invoices->hasPages())
            <div class="px-5 py-3 border-t border-gray-100">{{ $invoices->links() }}</div>
        @endif
    </div>
@endsection
