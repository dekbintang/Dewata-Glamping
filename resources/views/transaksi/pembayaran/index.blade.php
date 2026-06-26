@extends('layouts.app')

@section('title', 'Data Pembayaran')
@section('header', 'Pembayaran')

@section('content')
    <div class="flex items-center justify-between mb-5">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Daftar Tagihan & Invoice</h3>
            <p class="text-sm text-gray-400">Kelola riwayat pembayaran dan cetak ulang invoice.</p>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <x-data-table :headers="['#', 'No Invoice', 'Tamu', 'Tgl Terbit', 'Total', 'Status', 'Aksi']">
            @foreach($invoices as $i => $invoice)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-3 text-gray-400 text-xs">{{ $i + 1 }}</td>
                    <td class="px-5 py-3 font-mono text-xs font-semibold text-gray-700">{{ $invoice->invoice_number }}</td>
                    <td class="px-5 py-3 text-gray-800">{{ $invoice->reservation->customer->name }}</td>
                    <td class="px-5 py-3 text-gray-600">{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d M Y') }}</td>
                    <td class="px-5 py-3 font-medium text-gray-800">Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}</td>
                    <td class="px-5 py-3"><x-status-badge :status="$invoice->status" /></td>
                    <td class="px-5 py-3">
                        <div class="flex items-center gap-1">
                            <a href="{{ route('erp.transaksi.pembayaran.show', $invoice->invoice_id) }}" class="p-1.5 rounded-lg hover:bg-blue-50 text-blue-600 transition-colors" title="Detail">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                            <a href="{{ route('erp.laporan.invoice.download', $invoice->invoice_id) }}" class="p-1.5 rounded-lg hover:bg-green-50 text-green-600 transition-colors" title="Download PDF">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </x-data-table>
        @if($invoices->hasPages())
            <div class="px-5 py-3 border-t border-gray-100">
                {{ $invoices->links() }}
            </div>
        @endif
    </div>
@endsection
