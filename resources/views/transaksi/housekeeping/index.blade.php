@extends('layouts.app')

@section('title', 'Housekeeping')
@section('header', 'Housekeeping')

@section('content')
    <div class="flex items-center justify-between mb-5">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Manajemen Housekeeping</h3>
            <p class="text-sm text-gray-400">Pantau dan update status kebersihan unit.</p>
        </div>
    </div>
    @livewire('housekeeping-board')
@endsection
