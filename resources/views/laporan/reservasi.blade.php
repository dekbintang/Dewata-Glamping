@extends('layouts.app')

@section('title', 'Laporan Reservasi')
@section('header', 'Laporan Reservasi')

@section('content')
    <div class="mb-5">
        <h3 class="text-lg font-semibold text-gray-800">Laporan Reservasi</h3>
        <p class="text-sm text-gray-400">Ringkasan data reservasi tamu per periode.</p>
    </div>

    @php
        $reservations = \App\Models\Reservation::with(['customer', 'unit'])->latest()->paginate(15);
    @endphp

    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <x-data-table :headers="['#', 'Kode Booking', 'Tamu', 'Unit', 'Check In', 'Check Out', 'Status']">
            @foreach($reservations as $i => $res)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-3 text-gray-400 text-xs">{{ $i + 1 }}</td>
                    <td class="px-5 py-3 font-mono text-xs font-semibold text-gray-700">{{ $res->booking_code }}</td>
                    <td class="px-5 py-3 text-gray-800">{{ $res->customer->name }}</td>
                    <td class="px-5 py-3 text-gray-600">{{ $res->unit->unit_name }}</td>
                    <td class="px-5 py-3 text-gray-600">{{ $res->check_in_date->format('d M Y') }}</td>
                    <td class="px-5 py-3 text-gray-600">{{ $res->check_out_date->format('d M Y') }}</td>
                    <td class="px-5 py-3"><x-status-badge :status="$res->status" /></td>
                </tr>
            @endforeach
        </x-data-table>
        @if($reservations->hasPages())
            <div class="px-5 py-3 border-t border-gray-100">{{ $reservations->links() }}</div>
        @endif
    </div>
@endsection
