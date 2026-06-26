<?php

namespace App\Livewire;

use App\Models\Customer;
use App\Models\Reservation;
use App\Services\AvailabilityService;
use Carbon\Carbon;
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
            'checkIn' => 'required|date|after_or_equal:today',
            'checkOut' => 'required|date|after:checkIn',
        ]);

        $this->availableUnits = $availabilityService->getAvailableUnits($this->checkIn, $this->checkOut, $this->unitType);
        $this->isSearched = true;
        $this->selectedUnitId = null; // Reset selection if searching again
    }

    public function selectUnit($id)
    {
        $this->selectedUnitId = $id;
    }

    public function bookNow()
    {
        $this->validate([
            'selectedUnitId' => 'required|exists:unit_glamping,unit_id',
            'customerName' => 'required|string|max:255',
            'customerEmail' => 'required|email|max:255',
            'customerPhone' => 'required|string|max:20',
        ]);

        // Create or find customer
        $customer = Customer::firstOrCreate(
            ['email' => $this->customerEmail],
            [
                'name' => $this->customerName,
                'phone' => $this->customerPhone,
            ]
        );

        // Generate Booking
        $reservation = Reservation::create([
            'customer_id' => $customer->customer_id,
            'unit_id' => $this->selectedUnitId,
            'check_in_date' => $this->checkIn,
            'check_out_date' => $this->checkOut,
            'booking_code' => Reservation::generateBookingCode(),
            'status' => 'pending',
            'special_request' => $this->specialRequest,
        ]);

        return redirect()->route('booking.confirmation', ['code' => $reservation->booking_code]);
    }

    public function render()
    {
        return view('livewire.availability-checker');
    }
}
