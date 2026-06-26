<div>
    <div class="flex flex-col sm:flex-row gap-3 mb-4">
        <div class="relative flex-1 max-w-sm">
            <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari nama, email, atau kode booking..." class="pl-9 w-full rounded-lg border-gray-200 text-sm focus:border-blue-500 focus:ring-blue-500">
        </div>
        
        <select wire:model.live="status" class="rounded-lg border-gray-200 text-sm focus:border-blue-500 focus:ring-blue-500 w-40">
            <option value="">Semua Status</option>
            <option value="pending">Pending</option>
            <option value="confirmed">Confirmed</option>
            <option value="checked_in">Checked In</option>
            <option value="checked_out">Checked Out</option>
            <option value="cancelled">Cancelled</option>
        </select>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <x-data-table :headers="['Booking Code', 'Tamu', 'Unit', 'Check In', 'Check Out', 'Status', 'Aksi']">
            @forelse($reservations as $reservasi)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-3 font-mono text-xs font-semibold text-gray-700">{{ $reservasi->booking_code }}</td>
                    <td class="px-5 py-3">
                        <p class="font-medium text-gray-800">{{ $reservasi->customer->name }}</p>
                        <p class="text-xs text-gray-400">{{ $reservasi->customer->phone }}</p>
                    </td>
                    <td class="px-5 py-3 text-gray-600">{{ $reservasi->unit->unit_name }} <span class="text-xs text-gray-400">({{ $reservasi->unit->unit_type }})</span></td>
                    <td class="px-5 py-3 text-gray-600">{{ $reservasi->check_in_date->format('d M Y') }}</td>
                    <td class="px-5 py-3 text-gray-600">{{ $reservasi->check_out_date->format('d M Y') }}</td>
                    <td class="px-5 py-3">
                        <x-status-badge :status="$reservasi->status" />
                    </td>
                    <td class="px-5 py-3">
                        <div class="flex items-center gap-2">
                            @if($reservasi->status === 'pending')
                                <form action="{{ route('erp.transaksi.reservasi.confirm', $reservasi->reservation_id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="p-1.5 rounded-lg hover:bg-green-50 text-green-600 transition-colors" title="Konfirmasi">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </button>
                                </form>
                                <form action="{{ route('erp.transaksi.reservasi.cancel', $reservasi->reservation_id) }}" method="POST" onsubmit="return confirm('Batalkan reservasi?');">
                                    @csrf
                                    <button type="submit" class="p-1.5 rounded-lg hover:bg-red-50 text-red-500 transition-colors" title="Batalkan">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </form>
                            @elseif($reservasi->status === 'confirmed')
                                <a href="{{ route('erp.transaksi.checkin.form') }}" class="p-1.5 rounded-lg hover:bg-blue-50 text-blue-600 transition-colors" title="Check-in">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14"></path></svg>
                                </a>
                            @elseif($reservasi->status === 'checked_in')
                                <a href="{{ route('erp.transaksi.checkout.form', $reservasi->reservation_id) }}" class="p-1.5 rounded-lg hover:bg-orange-50 text-orange-600 transition-colors" title="Check-out">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7"></path></svg>
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-5 py-8 text-center text-gray-400 text-sm">Tidak ada data reservasi ditemukan.</td>
                </tr>
            @endforelse
        </x-data-table>

        @if($reservations->hasPages())
            <div class="px-5 py-3 border-t border-gray-100">
                {{ $reservations->links() }}
            </div>
        @endif
    </div>
</div>