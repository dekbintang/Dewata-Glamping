<?php

namespace App\Livewire;

use App\Models\Reservation;
use Livewire\Component;
use Livewire\WithPagination;

class ReservationTable extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';

    protected $queryString = ['search', 'status'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Reservation::with(['customer', 'unit'])->orderBy('created_at', 'desc');

        if ($this->search) {
            $query->whereHas('customer', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            })->orWhere('booking_code', 'like', '%' . $this->search . '%');
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        $reservations = $query->paginate(10);

        return view('livewire.reservation-table', [
            'reservations' => $reservations
        ]);
    }
}
