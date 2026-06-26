@extends('layouts.app')

@section('title', 'Pengaturan Roles')
@section('header', 'Pengaturan')

@section('content')
    <div class="mb-5">
        <h3 class="text-lg font-semibold text-gray-800">Manajemen Role & Permission</h3>
        <p class="text-sm text-gray-400">Kelola hak akses pengguna sistem.</p>
    </div>

    @php $roles = \Spatie\Permission\Models\Role::all(); @endphp

    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <x-data-table :headers="['#', 'Nama Role', 'Jumlah User', 'Guard']">
            @foreach($roles as $i => $role)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-3 text-gray-400 text-xs">{{ $i + 1 }}</td>
                    <td class="px-5 py-3 font-medium text-gray-800 capitalize">{{ $role->name }}</td>
                    <td class="px-5 py-3 text-gray-600">{{ $role->users->count() }} user</td>
                    <td class="px-5 py-3 text-gray-400 text-xs">{{ $role->guard_name }}</td>
                </tr>
            @endforeach
        </x-data-table>
    </div>
@endsection
