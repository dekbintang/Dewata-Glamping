@extends('layouts.app')

@section('title', 'Laporan F&B')
@section('header', 'Laporan F&B')

@section('content')
    <div class="mb-5">
        <h3 class="text-lg font-semibold text-gray-800">Laporan Penjualan F&B</h3>
        <p class="text-sm text-gray-400">Ringkasan penjualan makanan dan minuman.</p>
    </div>

    @php
        $orders = \App\Models\FnbOrder::with(['reservation.customer', 'details'])->latest()->paginate(15);
        $totalFnb = \App\Models\FnbOrder::sum('total_amount');
    @endphp

    <div class="bg-white rounded-xl border border-gray-200 p-5 mb-4">
        <p class="text-sm text-gray-500">Total Penjualan F&B</p>
        <p class="text-3xl font-bold text-gray-800">Rp {{ number_format($totalFnb, 0, ',', '.') }}</p>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <x-data-table :headers="['#', 'Order ID', 'Tamu', 'Item', 'Total', 'Status']">
            @foreach($orders as $i => $order)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-3 text-gray-400 text-xs">{{ $i + 1 }}</td>
                    <td class="px-5 py-3 font-mono text-xs font-semibold text-gray-700">#{{ $order->order_id }}</td>
                    <td class="px-5 py-3 text-gray-800">{{ $order->reservation->customer->name ?? '-' }}</td>
                    <td class="px-5 py-3 text-gray-600 text-xs">{{ $order->details->pluck('item_name')->implode(', ') }}</td>
                    <td class="px-5 py-3 font-medium text-gray-800">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    <td class="px-5 py-3"><x-status-badge :status="$order->status" /></td>
                </tr>
            @endforeach
        </x-data-table>
        @if($orders->hasPages())
            <div class="px-5 py-3 border-t border-gray-100">{{ $orders->links() }}</div>
        @endif
    </div>
@endsection
