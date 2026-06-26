<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $primaryKey = 'reservation_id';

    protected $fillable = [
        'customer_id', 'unit_id', 'check_in_date', 'check_out_date',
        'booking_code', 'status', 'dp_amount', 'special_request',
    ];

    protected $casts = [
        'check_in_date' => 'date',
        'check_out_date' => 'date',
        'dp_amount' => 'decimal:2',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function unit()
    {
        return $this->belongsTo(UnitGlamping::class, 'unit_id');
    }

    public function checkInOut()
    {
        return $this->hasOne(CheckInOut::class, 'reservation_id');
    }

    public function fnbOrders()
    {
        return $this->hasMany(FnbOrder::class, 'reservation_id');
    }

    public function payment()
    {
        return $this->hasMany(Payment::class, 'reservation_id');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'reservation_id');
    }

    /**
     * Hitung total malam
     */
    public function getTotalNightsAttribute(): int
    {
        return Carbon::parse($this->check_in_date)->diffInDays($this->check_out_date);
    }

    /**
     * Generate booking code unik
     */
    public static function generateBookingCode(): string
    {
        return 'GLP-' . strtoupper(uniqid());
    }
}
