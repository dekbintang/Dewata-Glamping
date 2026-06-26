@extends('layouts.app')

@section('title', 'Data Pelanggan')
@section('header', 'Data Pelanggan')

@section('content')
    <div class="flex items-center justify-between mb-5">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Daftar Pelanggan</h3>
            <p class="text-sm text-gray-400">Kelola profil dan segmentasi tamu Anda.</p>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <x-data-table :headers="['#', 'Nama Tamu', 'Kontak', 'Segmentasi', 'Total Kunjungan', 'Aksi']">
            @foreach($customers as $i => $customer)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-3 text-gray-400 text-xs">{{ $i + 1 }}</td>
                    <td class="px-5 py-3 font-medium text-gray-800">{{ $customer->name }}</td>
                    <td class="px-5 py-3 text-gray-600">
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
                        <a href="{{ route('erp.crm.show', $customer->customer_id) }}" class="p-1.5 rounded-lg hover:bg-blue-50 text-blue-600 transition-colors inline-block" title="Lihat Profil">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </a>
                    </td>
                </tr>
            @endforeach
        </x-data-table>
        @if($customers->hasPages())
            <div class="px-5 py-3 border-t border-gray-100">
                {{ $customers->links() }}
            </div>
        @endif
    </div>
@endsection
