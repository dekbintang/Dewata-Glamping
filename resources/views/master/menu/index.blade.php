@extends('layouts.app')

@section('title', 'Menu F&B')
@section('header', 'Menu F&B')

@section('content')
    <div class="flex items-center justify-between mb-5">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Katalog Food & Beverage</h3>
            <p class="text-sm text-gray-400">Kelola daftar menu restoran glamping.</p>
        </div>
        <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors flex items-center gap-1.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Menu
        </button>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <x-data-table :headers="['#', 'Nama Menu', 'Kategori', 'Harga', 'Status', 'Aksi']">
            @foreach($menus as $i => $menu)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-3 text-gray-400 text-xs">{{ $i + 1 }}</td>
                    <td class="px-5 py-3 font-medium text-gray-800">{{ $menu->menu_name }}</td>
                    <td class="px-5 py-3 text-gray-600 capitalize">{{ $menu->category }}</td>
                    <td class="px-5 py-3 font-medium text-gray-800">Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                    <td class="px-5 py-3">
                        @if($menu->is_available)
                            <span class="px-2 py-0.5 text-[11px] font-medium rounded-md bg-green-50 text-green-700 border border-green-200">Tersedia</span>
                        @else
                            <span class="px-2 py-0.5 text-[11px] font-medium rounded-md bg-red-50 text-red-600 border border-red-200">Habis</span>
                        @endif
                    </td>
                    <td class="px-5 py-3">
                        <div class="flex items-center gap-1">
                            <button class="p-1.5 rounded-lg hover:bg-blue-50 text-blue-600 transition-colors" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </button>
                            <button class="p-1.5 rounded-lg hover:bg-red-50 text-red-500 transition-colors" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </x-data-table>
    </div>
@endsection
