<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
    <!-- Menu Grid -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Pilih Menu</h3>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                @foreach($menus as $menu)
                    <button wire:click="addToCart({{ $menu->menu_id }}, '{{ $menu->name }}', {{ $menu->price }})" 
                         class="border border-gray-200 hover:border-blue-400 rounded-lg p-3 transition-all hover:shadow-sm text-left bg-white group">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-8 h-8 bg-gray-100 rounded-md flex items-center justify-center text-gray-400 group-hover:bg-blue-50 group-hover:text-blue-500 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            </div>
                            <span class="px-1.5 py-0.5 text-[10px] font-medium text-gray-400 bg-gray-50 rounded capitalize">{{ $menu->category }}</span>
                        </div>
                        <h4 class="text-sm font-medium text-gray-800">{{ $menu->name }}</h4>
                        <p class="text-xs font-semibold text-blue-600 mt-1">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Cart -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl border border-gray-200 p-5 sticky top-6">
            <h3 class="text-sm font-semibold text-gray-700 mb-3">Detail Pesanan</h3>
            
            <div class="mb-4">
                <label class="block text-xs font-medium text-gray-500 mb-1.5">Tamu (Sedang Menginap)</label>
                <select wire:model="selectedReservation" class="w-full rounded-lg border-gray-200 text-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">-- Pilih Tamu --</option>
                    @foreach($reservations as $res)
                        <option value="{{ $res->reservation_id }}">{{ $res->unit->unit_name }} - {{ $res->customer->name }}</option>
                    @endforeach
                </select>
                @error('selectedReservation') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="max-h-56 overflow-y-auto mb-4 space-y-2">
                @if(count($cart) === 0)
                    <div class="text-center py-6 text-gray-300">
                        <svg class="w-10 h-10 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        <p class="text-xs text-gray-400">Belum ada item</p>
                    </div>
                @else
                    @foreach($cart as $id => $item)
                        <div class="flex justify-between items-center bg-gray-50 p-2.5 rounded-lg border border-gray-100">
                            <div class="flex-1 min-w-0">
                                <h5 class="text-sm font-medium text-gray-800 truncate">{{ $item['name'] }}</h5>
                                <p class="text-xs text-gray-400">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                            </div>
                            <div class="flex items-center gap-1.5 ml-2">
                                <button wire:click="updateQty({{ $id }}, 'dec')" class="w-6 h-6 rounded-md bg-white border border-gray-200 text-gray-500 flex items-center justify-center text-xs hover:bg-gray-50">−</button>
                                <span class="text-sm font-medium w-5 text-center">{{ $item['qty'] }}</span>
                                <button wire:click="updateQty({{ $id }}, 'inc')" class="w-6 h-6 rounded-md bg-blue-50 border border-blue-200 text-blue-600 flex items-center justify-center text-xs hover:bg-blue-100">+</button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="border-t border-gray-100 pt-3">
                <div class="flex justify-between items-center mb-3">
                    <span class="text-sm font-medium text-gray-500">Total</span>
                    <span class="text-xl font-bold text-gray-800">Rp {{ number_format($totalAmount, 0, ',', '.') }}</span>
                </div>
                
                @if(session('success'))
                    <div class="mb-3 p-2.5 bg-green-50 text-green-700 text-xs rounded-lg border border-green-200 text-center font-medium">{{ session('success') }}</div>
                @endif

                <button wire:click="processOrder" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg transition-colors text-sm disabled:opacity-40 disabled:cursor-not-allowed"
                    @if(count($cart) === 0 || !$selectedReservation) disabled @endif>
                    Proses Pesanan
                </button>
            </div>
        </div>
    </div>
</div>