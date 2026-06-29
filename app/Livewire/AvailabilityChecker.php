<?php

namespace App\Livewire;

use App\Models\Customer;
use App\Models\Reservation;
use App\Services\AvailabilityService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AvailabilityChecker extends Component
{
    public $checkIn;
    public $checkOut;
    public $unitType = '';
    
    // Hasil pencarian
    public $availableUnits = null;
    public $isSearched = false;

    // Data Form Booking
    public $selectedUnitId = null;
    public $customerName = '';
    public $customerEmail = '';
    public $customerPhone = '';
    public $specialRequest = '';

    public function mount()
    {
        $this->checkIn = Carbon::today()->addDay()->toDateString();
        $this->checkOut = Carbon::today()->addDays(2)->toDateString();
    }

    public function checkAvailability(AvailabilityService $availabilityService)
    {
        $this->validate([
            'checkIn'  => 'required|date|after_or_equal:today',
            'checkOut' => 'required|date|after:checkIn',
        ]);

        // Validasi: maksimal 30 malam
        $nights = Carbon::parse($this->checkIn)->diffInDays(Carbon::parse($this->checkOut));
        if ($nights > 30) {
            $this->addError('checkOut', 'Maksimal durasi menginap adalah 30 malam.');
            return;
        }

        $this->availableUnits = $availabilityService->getAvailableUnits($this->checkIn, $this->checkOut, $this->unitType);
        $this->isSearched = true;
        $this->selectedUnitId = null;
    }

    public function selectUnit($id)
    {
        $this->selectedUnitId = $id;
    }

    public function bookNow(AvailabilityService $availabilityService)
    {
        $this->validate([
            'selectedUnitId' => 'required|exists:unit_glamping,unit_id',
            'customerName'   => 'required|string|max:255',
            'customerEmail'  => 'required|email|max:255',
            'customerPhone'  => 'required|string|max:20',
            'checkIn'        => 'required|date|after_or_equal:today',
            'checkOut'       => 'required|date|after:checkIn',
        ]);

        try {
            $reservation = DB::transaction(function () use ($availabilityService) {
                // Re-check availability INSIDE transaction with pessimistic lock
                if (!$availabilityService->isUnitAvailable($this->selectedUnitId, $this->checkIn, $this->checkOut)) {
                    throw new \Exception('Unit sudah tidak tersedia. Silakan pilih unit lain.');
                }

                // Create or find customer
                $customer = Customer::firstOrCreate(
                    ['email' => $this->customerEmail],
                    [
                        'name'  => $this->customerName,
                        'phone' => $this->customerPhone,
                    ]
                );

                // Generate Booking
                return Reservation::create([
                    'customer_id'    => $customer->customer_id,
                    'unit_id'        => $this->selectedUnitId,
                    'check_in_date'  => $this->checkIn,
                    'check_out_date' => $this->checkOut,
                    'booking_code'   => Reservation::generateBookingCode(),
                    'status'         => 'pending',
                    'special_request' => $this->specialRequest,
                ]);
            });

            // Set session so they can view confirmation page immediately
            session(["verified_booking_{$reservation->booking_code}" => true]);

            return redirect()->route('booking.confirmation', ['code' => $reservation->booking_code]);
        } catch (\Exception $e) {
            // Double booking caught — show error and refresh available units
            $this->addError('selectedUnitId', $e->getMessage());
            $this->selectedUnitId = null;
            $this->availableUnits = $availabilityService->getAvailableUnits($this->checkIn, $this->checkOut, $this->unitType);
        }
    }

    public function render()
    {
        return view('livewire.availability-checker');
    }
}
