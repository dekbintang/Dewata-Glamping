<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $primaryKey = 'invoice_id';

    protected $fillable = [
        'reservation_id', 'invoice_date',
        'room_charge', 'fnb_charge',
        'total_amount', 'status',
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'room_charge' => 'decimal:2',
        'fnb_charge' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }

    /**
     * Auto-generate invoice number from ID
     */
    public function getInvoiceNumberAttribute(): string
    {
        return 'INV-' . str_pad($this->invoice_id, 6, '0', STR_PAD_LEFT);
    }
}
