<div>
    <div class="bg-white rounded-xl border border-gray-200 p-5 mb-5">
        <h3 class="text-sm font-semibold text-gray-700 mb-3">Parameter Analisis</h3>
        <p class="text-xs text-gray-400 mb-4">Sistem menganalisis okupansi historis, tren akhir pekan, dan musim liburan untuk merekomendasikan harga.</p>
        
        <div class="flex items-end gap-3">
            <div class="w-56">
                <label class="block text-xs font-medium text-gray-500 mb-1.5">Tanggal Analisis</label>
                <input wire:model="targetDate" type="date" class="w-full rounded-lg border-gray-200 text-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <button wire:click="calculatePricing" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-5 rounded-lg transition-colors flex items-center gap-2">
                <svg wire:loading wire:target="calculatePricing" class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                Jalankan Analisis
            </button>
        </div>
    </div>

    @if($isCalculated)
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="px-5 py-3 border-b border-gray-100">
                <h3 class="text-sm font-semibold text-gray-700">Hasil Rekomendasi DSS (SAW)</h3>
            </div>
            <x-data-table :headers="['Unit', 'Harga Saat Ini', 'Skor SAW', 'Rekomendasi', 'Selisih', 'Aksi']">
                @foreach($recommendations as $data)
                    @php 
                        $unit = $data['unit'];
                        $rec = $data['recommendation'];
                        $diff = $rec['suggested_price'] - $unit->base_price;
                    @endphp
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-5 py-3">
                            <p class="font-medium text-gray-800">{{ $unit->unit_name }}</p>
                            <p class="text-xs text-gray-400">{{ $unit->unit_type }}</p>
                            @if(isset($rec['insufficient_data']) && $rec['insufficient_data'])
                                <p class="text-[10px] text-yellow-600 bg-yellow-50 inline-block px-1.5 py-0.5 rounded mt-1">Data Kurang</p>
                            @endif
                        </td>
                        <td class="px-5 py-3 text-gray-600">Rp {{ number_format($unit->base_price, 0, ',', '.') }}</td>
                        <td class="px-5 py-3">
                            @if(isset($rec['insufficient_data']) && $rec['insufficient_data'])
                                <span class="font-mono text-xs bg-gray-50 border border-gray-200 text-gray-400 px-2 py-0.5 rounded" title="{{ $rec['message'] ?? 'Data historis belum memadai' }}">N/A</span>
                            @else
                                <span class="font-mono text-xs bg-gray-50 border border-gray-200 px-2 py-0.5 rounded">{{ number_format($rec['score'], 3) }}</span>
                            @endif
                        </td>
                        <td class="px-5 py-3 font-medium {{ $diff > 0 ? 'text-green-600' : ($diff < 0 ? 'text-red-600' : 'text-gray-800') }}">
                            Rp {{ number_format($rec['suggested_price'], 0, ',', '.') }}
                        </td>
                        <td class="px-5 py-3 text-xs font-medium {{ $diff > 0 ? 'text-green-600' : ($diff < 0 ? 'text-red-600' : 'text-gray-400') }}">
                            @if($diff > 0) +Rp {{ number_format($diff, 0, ',', '.') }} ↑
                            @elseif($diff < 0) -Rp {{ number_format(abs($diff), 0, ',', '.') }} ↓
                            @else Optimal
                            @endif
                        </td>
                        <td class="px-5 py-3">
                            @if($diff != 0)
                                <button wire:click="applyRecommendation({{ $unit->unit_id }}, {{ $rec['suggested_price'] }})" class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium py-1.5 px-3 rounded-lg transition-colors">
                                    Terapkan
                                </button>
                            @else
                                <span class="text-xs text-gray-400">—</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </x-data-table>
        </div>
    @endif
</div>