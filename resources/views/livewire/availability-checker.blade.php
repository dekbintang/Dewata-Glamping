<div>
    @if(!$selectedUnitId)
        <div class="space-y-5">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 items-end">
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1.5">Check-In</label>
                    <input wire:model="checkIn" type="date" class="w-full rounded-lg border-gray-200 text-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('checkIn') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1.5">Check-Out</label>
                    <input wire:model="checkOut" type="date" class="w-full rounded-lg border-gray-200 text-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('checkOut') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                <button wire:click="checkAvailability" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors text-sm">
                    Cek Ketersediaan
                </button>
            </div>

            @if($isSearched)
                <div class="border-t border-gray-100 pt-5">
                    <h4 class="text-sm font-semibold text-gray-700 mb-3">Unit Tersedia</h4>
                    
                    @if($availableUnits->isEmpty())
                        <div class="bg-yellow-50 text-yellow-700 p-3 rounded-lg border border-yellow-200 text-sm">
                            Tidak ada unit tersedia untuk tanggal tersebut.
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($availableUnits as $unit)
                                <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-400 transition-colors bg-white">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <h4 class="font-semibold text-gray-800">{{ $unit->unit_name }}</h4>
                                            <p class="text-xs text-gray-400 capitalize">{{ $unit->unit_type }} · {{ $unit->capacity }} orang</p>
                                        </div>
                                    </div>
                                    <p class="text-lg font-bold text-blue-600 mb-3">Rp {{ number_format($unit->base_price, 0, ',', '.') }}<span class="text-xs font-normal text-gray-400">/malam</span></p>
                                    <button wire:click="selectUnit({{ $unit->unit_id }})" class="w-full bg-gray-50 hover:bg-blue-50 text-gray-700 hover:text-blue-700 font-medium py-2 rounded-lg transition-colors text-sm border border-gray-200 hover:border-blue-200">
                                        Pilih Unit
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif
        </div>

    @else
        <div>
            <div class="flex items-center justify-between mb-4">
                <h4 class="text-sm font-semibold text-gray-700">Lengkapi Data Pemesan</h4>
                <button wire:click="$set('selectedUnitId', null)" class="text-xs text-gray-400 hover:text-blue-600">← Kembali</button>
            </div>
            
            <div class="bg-blue-50 p-3 rounded-lg border border-blue-100 mb-5 text-sm">
                <p class="text-blue-700 font-medium">{{ \Carbon\Carbon::parse($checkIn)->format('d M Y') }} — {{ \Carbon\Carbon::parse($checkOut)->format('d M Y') }}</p>
            </div>

            <div class="space-y-3">
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1.5">Nama Lengkap</label>
                    <input wire:model="customerName" type="text" class="w-full rounded-lg border-gray-200 text-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('customerName') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1.5">Email</label>
                        <input wire:model="customerEmail" type="email" class="w-full rounded-lg border-gray-200 text-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('customerEmail') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1.5">Telepon / WhatsApp</label>
                        <input wire:model="customerPhone" type="text" class="w-full rounded-lg border-gray-200 text-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('customerPhone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1.5">Permintaan Khusus (Opsional)</label>
                    <textarea wire:model="specialRequest" rows="2" class="w-full rounded-lg border-gray-200 text-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                </div>
                <button wire:click="bookNow" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg transition-colors text-sm mt-2">
                    Selesaikan Pemesanan
                </button>
            </div>
        </div>
    @endif
</div>