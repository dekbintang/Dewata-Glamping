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

    /**
     * Valid status transitions map.
     * Key = current status, Value = array of allowed next statuses.
     */
    public const STATUS_TRANSITIONS = [
        'pending'     => ['confirmed', 'cancelled'],
        'confirmed'   => ['checked_in', 'cancelled'],
        'checked_in'  => ['checked_out'],
        'checked_out' => [],     // terminal state
        'cancelled'   => [],     // terminal state
    ];

    // ─── Relationships ─────────────────────────────────────────

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

    // ─── Accessors ─────────────────────────────────────────────

    /**
     * Hitung total malam
     */
    public function getTotalNightsAttribute(): int
    {
        return Carbon::parse($this->check_in_date)->diffInDays($this->check_out_date);
    }

    /**
     * Check if reservation has a DP paid
     */
    public function getHasDpAttribute(): bool
    {
        return ($this->dp_amount ?? 0) > 0;
    }

    // ─── Status Transition Logic ───────────────────────────────

    /**
     * Check if a status transition is valid
     */
    public function canTransitionTo(string $newStatus): bool
    {
        $allowed = self::STATUS_TRANSITIONS[$this->status] ?? [];
        return in_array($newStatus, $allowed);
    }

    /**
     * Transition to a new status with validation.
     * Throws exception if transition is not allowed.
     */
    public function transitionTo(string $newStatus): void
    {
        if (!$this->canTransitionTo($newStatus)) {
            throw new \LogicException(
                "Tidak dapat mengubah status dari '{$this->status}' ke '{$newStatus}'."
            );
        }

        $this->update(['status' => $newStatus]);
    }

    // ─── Static Helpers ────────────────────────────────────────

    /**
     * Generate booking code unik
     */
    public static function generateBookingCode(): string
    {
        do {
            $code = 'GLP-' . strtoupper(substr(uniqid(), -6));
        } while (self::where('booking_code', $code)->exists());

        return $code;
    }

    // ─── Scopes ────────────────────────────────────────────────

    /**
     * Active reservations (not cancelled/checked_out)
     */
    public function scopeActive($query)
    {
        return $query->whereNotIn('status', ['cancelled', 'checked_out']);
    }

    /**
     * No-show: confirmed but check-in date has passed
     */
    public function scopeNoShow($query)
    {
        return $query->where('status', 'confirmed')
            ->where('check_in_date', '<', Carbon::today());
    }
}
