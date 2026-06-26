@extends('layouts.app')

@section('title', 'Profil Tamu')
@section('header', 'CRM Pelanggan')

@section('content')
    <div class="mb-4">
        <a href="{{ route('erp.crm.index') }}" class="text-sm text-gray-400 hover:text-gray-600">← Kembali ke daftar</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        <!-- Profil -->
        <div class="space-y-4">
            <div class="bg-white rounded-xl border border-gray-200 p-5 text-center">
                <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-3">
                    {{ substr($customer->name, 0, 1) }}
                </div>
                <h2 class="text-lg font-bold text-gray-800">{{ $customer->name }}</h2>
                <p class="text-sm text-gray-400">{{ $customer->email }}</p>
                <p class="text-sm text-gray-400">{{ $customer->phone }}</p>
                
                @php
                    $segStyle = match($customer->segment) {
                        'VIP' => 'bg-purple-50 text-purple-700 border-purple-200',
                        'Loyal' => 'bg-blue-50 text-blue-700 border-blue-200',
                        default => 'bg-gray-50 text-gray-600 border-gray-200'
                    };
                @endphp
                <div class="mt-3 inline-block px-3 py-1 rounded-md border text-xs font-semibold {{ $segStyle }}">{{ $customer->segment }}</div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-5">
                <h3 class="text-sm font-semibold text-gray-700 mb-3">Ringkasan</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between py-1.5 border-b border-gray-50">
                        <span class="text-gray-500">Total Kunjungan</span>
                        <span class="font-semibold text-gray-800">{{ $summary['total_visits'] }} kali</span>
                    </div>
                    <div class="flex justify-between py-1.5 border-b border-gray-50">
                        <span class="text-gray-500">Total Transaksi</span>
                        <span class="font-semibold text-gray-800">Rp {{ number_format($summary['total_spent'], 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between py-1.5">
                        <span class="text-gray-500">Kunjungan Terakhir</span>
                        <span class="font-semibold text-gray-800">{{ $summary['last_visit'] ? \Carbon\Carbon::parse($summary['last_visit'])->format('d M Y') : '-' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Catatan & Riwayat -->
        <div class="lg:col-span-2 space-y-4">
            <!-- Form Catatan -->
            <div class="bg-white rounded-xl border border-gray-200 p-5">
                <h3 class="text-sm font-semibold text-gray-700 mb-3">Tambahkan Catatan</h3>
                <form action="{{ route('erp.crm.note', $customer->customer_id) }}" method="POST">
                    @csrf
                    <textarea name="note" rows="2" class="w-full rounded-lg border-gray-200 text-sm focus:border-blue-500 focus:ring-blue-500 mb-3" placeholder="Catatan preferensi, alergi, atau info penting..."></textarea>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition-colors">Simpan</button>
                </form>
            </div>

            <!-- Catatan List -->
            @if($customer->notes->count() > 0)
                <div class="bg-white rounded-xl border border-gray-200 p-5">
                    <h3 class="text-sm font-semibold text-gray-700 mb-3">Catatan Tersimpan</h3>
                    <div class="space-y-2">
                        @foreach($customer->notes as $note)
                            <div class="bg-yellow-50 p-3 rounded-lg border border-yellow-100">
                                <p class="text-sm text-gray-800">{{ $note->note }}</p>
                                <div class="flex justify-between mt-2 text-xs text-gray-400">
                                    <span>{{ $note->user->name ?? 'System' }}</span>
                                    <span>{{ $note->created_at->format('d M Y, H:i') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Riwayat Reservasi -->
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                <div class="px-5 py-3 border-b border-gray-100">
                    <h3 class="text-sm font-semibold text-gray-700">Riwayat Reservasi</h3>
                </div>
                <x-data-table :headers="['Kode', 'Unit', 'Check In', 'Status']">
                    @foreach($customer->reservations as $res)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-5 py-3 font-mono text-xs text-gray-600">{{ $res->booking_code }}</td>
                            <td class="px-5 py-3 text-gray-800">{{ $res->unit->unit_name }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ $res->check_in_date->format('d M Y') }}</td>
                            <td class="px-5 py-3"><x-status-badge :status="$res->status" /></td>
                        </tr>
                    @endforeach
                </x-data-table>
            </div>
        </div>
    </div>
@endsection
