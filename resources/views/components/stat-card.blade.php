@props(['title', 'value', 'color' => 'glamp-600'])

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 transition-transform hover:scale-105">
    <p class="text-sm font-medium text-gray-500">{{ $title }}</p>
    <p class="text-3xl font-bold mt-2 text-{{ $color }}">{{ $value }}</p>
</div>
