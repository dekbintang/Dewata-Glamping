<div wire:poll.30s>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
        @foreach($units as $unit)
            @php
                $styles = match($unit->status) {
                    'available' => 'border-green-200 bg-green-50',
                    'occupied' => 'border-red-200 bg-red-50',
                    'cleaning' => 'border-yellow-200 bg-yellow-50',
                    'maintenance' => 'border-gray-200 bg-gray-100',
                    default => 'border-gray-200 bg-gray-50'
                };
                $dotColor = match($unit->status) {
                    'available' => 'bg-green-500',
                    'occupied' => 'bg-red-500',
                    'cleaning' => 'bg-yellow-500',
                    'maintenance' => 'bg-gray-400',
                    default => 'bg-gray-400'
                };
            @endphp
            <div class="border rounded-lg p-3 {{ $styles }} transition-all hover:shadow-sm cursor-default">
                <div class="flex items-center justify-between mb-1">
                    <span class="text-sm font-bold text-gray-800">{{ $unit->unit_name }}</span>
                    <span class="w-2 h-2 rounded-full {{ $dotColor }}"></span>
                </div>
                <p class="text-[11px] text-gray-500 capitalize">{{ $unit->unit_type }}</p>
                <p class="text-[11px] text-gray-400 capitalize mt-0.5">{{ str_replace('_', ' ', $unit->status) }}</p>
            </div>
        @endforeach
    </div>
</div>