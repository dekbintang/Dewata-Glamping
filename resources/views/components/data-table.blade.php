@props(['headers'])

<div class="overflow-x-auto">
    <table class="w-full text-sm text-left">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-200">
                @foreach($headers as $header)
                    <th class="px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            {{ $slot }}
        </tbody>
    </table>
</div>
