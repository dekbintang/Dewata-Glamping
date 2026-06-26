<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice - {{ $invoice->invoice_number }}</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; color: #333; line-height: 1.5; font-size: 14px; }
        .invoice-box { max-width: 800px; margin: auto; padding: 30px; border: 1px solid #eee; }
        .header { display: flex; justify-content: space-between; margin-bottom: 40px; border-bottom: 2px solid #1b4332; padding-bottom: 20px; }
        .company-name { font-size: 24px; font-weight: bold; color: #1b4332; }
        .invoice-title { font-size: 20px; color: #777; text-align: right; }
        table { w-full; width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background: #f8fafc; font-weight: bold; }
        .text-right { text-align: right; }
        .total-row { font-weight: bold; font-size: 18px; color: #1b4332; }
        .total-row td { border-top: 2px solid #333; }
        .info-grid { width: 100%; margin-bottom: 30px; }
        .info-grid td { border: none; vertical-align: top; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table class="info-grid">
            <tr>
                <td>
                    <div class="company-name">GlampERP</div>
                    <div>Sistem Informasi Glamping</div>
                </td>
                <td class="text-right">
                    <div class="invoice-title">INVOICE</div>
                    <div><b>{{ $invoice->invoice_number }}</b></div>
                    <div>Tanggal: {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d M Y') }}</div>
                    <div>Status: {{ strtoupper($invoice->status) }}</div>
                </td>
            </tr>
        </table>

        <table class="info-grid" style="margin-top: 20px;">
            <tr>
                <td>
                    <b>Ditagihkan Kepada:</b><br>
                    {{ $invoice->reservation->customer->name }}<br>
                    {{ $invoice->reservation->customer->phone }}<br>
                    {{ $invoice->reservation->customer->email }}
                </td>
                <td class="text-right">
                    <b>Rincian Reservasi:</b><br>
                    Unit: {{ $invoice->reservation->unit->unit_name }}<br>
                    Check-in: {{ $invoice->reservation->check_in_date->format('d M Y') }}<br>
                    Check-out: {{ $invoice->reservation->check_out_date->format('d M Y') }}
                </td>
            </tr>
        </table>

        <table style="margin-top: 30px;">
            <thead>
                <tr>
                    <th>Deskripsi</th>
                    <th class="text-right">Jumlah (Rp)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Biaya Akomodasi Unit ({{ $invoice->reservation->check_in_date->diffInDays($invoice->reservation->check_out_date) }} Malam)</td>
                    <td class="text-right">{{ number_format($invoice->reservation->unit->base_price * $invoice->reservation->check_in_date->diffInDays($invoice->reservation->check_out_date), 0, ',', '.') }}</td>
                </tr>
                @foreach($invoice->reservation->fnbOrders as $order)
                    <tr>
                        <td>Pesanan F&B (Order #{{ $order->order_id }})</td>
                        <td class="text-right">{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <td class="text-right">TOTAL TAGIHAN</td>
                    <td class="text-right">{{ number_format($invoice->total_amount, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div style="margin-top: 50px; text-align: center; color: #777; font-size: 12px; border-top: 1px solid #eee; padding-top: 20px;">
            Terima kasih telah memilih GlampERP. Kami berharap Anda menikmati pengalaman glamping bersama kami.
        </div>
    </div>
</body>
</html>
