@extends('layouts.app')

@section('title', 'CRM Pelanggan')
@section('header', 'CRM Pelanggan')

@section('content')
    <div class="flex items-center justify-between mb-5">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Customer Relationship Management</h3>
            <p class="text-sm text-gray-400">Analisis profil, segmentasi, dan riwayat tamu.</p>
        </div>
    </div>

    @php $customers = \App\Models\Customer::paginate(20); @endphp

    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <x-data-table :headers="['#', 'Nama Tamu', 'Kontak', 'Segmentasi', 'Total Kunjungan', 'Aksi']">
            @foreach($customers as $i => $customer)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-3 text-gray-400 text-xs">{{ $i + 1 }}</td>
                    <td class="px-5 py-3 font-medium text-gray-800">{{ $customer->name }}</td>
                    <td class="px-5 py-3 text-gray-600 text-sm">
                        {{ $customer->email }}<br>
                        <span class="text-xs text-gray-400">{{ $customer->phone }}</span>
                    </td>
                    <td class="px-5 py-3">
                        @php
                            $segStyle = match($customer->segment) {
                                'VIP' => 'bg-purple-50 text-purple-700 border-purple-200',
                                'Loyal' => 'bg-blue-50 text-blue-700 border-blue-200',
                                default => 'bg-gray-50 text-gray-600 border-gray-200'
                            };
                        @endphp
                        <span class="px-2 py-0.5 text-[11px] font-medium rounded-md border {{ $segStyle }}">{{ $customer->segment }}</span>
                    </td>
                    <td class="px-5 py-3 text-gray-600">{{ $customer->total_visits }} kali</td>
                    <td class="px-5 py-3">
                        <a href="{{ route('erp.crm.show', $customer->customer_id) }}" class="text-xs text-blue-600 hover:text-blue-800 font-medium">Lihat Profil →</a>
                    </td>
                </tr>
            @endforeach
        </x-data-table>
        @if($customers->hasPages())
            <div class="px-5 py-3 border-t border-gray-100">{{ $customers->links() }}</div>
        @endif
    </div>
@endsection
