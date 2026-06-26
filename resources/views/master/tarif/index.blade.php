@extends('layouts.app')

@section('title', 'Tarif & Harga')
@section('header', 'Tarif & Harga')

@section('content')
    <div class="flex items-center justify-between mb-5">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Pengaturan Tarif</h3>
            <p class="text-sm text-gray-400">Kelola harga dasar dan tarif unit glamping.</p>
        </div>
    </div>

    @php $units = \App\Models\UnitGlamping::all(); @endphp

    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <x-data-table :headers="['#', 'Unit', 'Tipe', 'Harga Dasar', 'Harga Weekend', 'Aksi']">
            @foreach($units as $i => $unit)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-3 text-gray-400 text-xs">{{ $i + 1 }}</td>
                    <td class="px-5 py-3 font-medium text-gray-800">{{ $unit->unit_name }}</td>
                    <td class="px-5 py-3 text-gray-600 capitalize">{{ $unit->unit_type }}</td>
                    <td class="px-5 py-3 font-medium text-gray-800">Rp {{ number_format($unit->base_price, 0, ',', '.') }}</td>
                    <td class="px-5 py-3 text-gray-600">Rp {{ number_format($unit->base_price * 1.2, 0, ',', '.') }}</td>
                    <td class="px-5 py-3">
                        <button class="p-1.5 rounded-lg hover:bg-blue-50 text-blue-600 transition-colors" title="Edit Tarif">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </button>
                    </td>
                </tr>
            @endforeach
        </x-data-table>
    </div>
@endsection
