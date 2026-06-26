@props(['status'])

@php
    $classes = match($status) {
        'pending' => 'bg-yellow-50 text-yellow-700 border border-yellow-200',
        'confirmed', 'ready' => 'bg-blue-50 text-blue-700 border border-blue-200',
        'checked_in', 'available', 'paid' => 'bg-green-50 text-green-700 border border-green-200',
        'checked_out', 'served' => 'bg-gray-50 text-gray-600 border border-gray-200',
        'cancelled', 'occupied', 'dirty' => 'bg-red-50 text-red-600 border border-red-200',
        'maintenance', 'cleaning', 'in_progress', 'processing', 'unpaid' => 'bg-orange-50 text-orange-600 border border-orange-200',
        default => 'bg-gray-50 text-gray-600 border border-gray-200'
    };
@endphp

<span class="px-2 py-0.5 inline-flex text-[11px] leading-5 font-medium rounded-md {{ $classes }} capitalize">
    {{ str_replace('_', ' ', $status) }}
</span>
