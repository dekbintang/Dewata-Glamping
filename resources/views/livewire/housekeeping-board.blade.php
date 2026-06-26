<div>
    @if($tasks->count() === 0)
        <div class="bg-white rounded-xl border border-gray-200 p-10 text-center">
            <svg class="w-12 h-12 text-gray-200 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
            <p class="text-gray-400 text-sm">Semua unit bersih. Tidak ada tugas housekeeping saat ini.</p>
        </div>
    @else
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <x-data-table :headers="['Unit', 'Status', 'Waktu', 'Aksi']">
                @foreach($tasks as $task)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-5 py-3">
                            <p class="font-medium text-gray-800">{{ $task->unit->unit_name }}</p>
                            <p class="text-xs text-gray-400">{{ $task->unit->unit_type }}</p>
                        </td>
                        <td class="px-5 py-3"><x-status-badge :status="$task->status" /></td>
                        <td class="px-5 py-3 text-gray-500 text-xs">{{ $task->created_at->diffForHumans() }}</td>
                        <td class="px-5 py-3">
                            <button wire:click="markAsReady({{ $task->housekeeping_id }})" class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium py-1.5 px-3 rounded-lg transition-colors">
                                Tandai Bersih
                            </button>
                        </td>
                    </tr>
                @endforeach
            </x-data-table>
        </div>
    @endif
</div>