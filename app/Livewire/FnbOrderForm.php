<?php

namespace App\Livewire;

use App\Models\FnbMenu;
use App\Models\FnbOrder;
use App\Models\OrderDetail;
use App\Models\Reservation;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class FnbOrderForm extends Component
{
    public $reservations;
    public $menus;
    
    // Form State
    public $selectedReservation = '';
    public $cart = []; // ['menu_id' => [qty, price, name]]
    public $totalAmount = 0;

    public function mount()
    {
        // Ambil tamu yang sedang check-in
        $this->reservations = Reservation::with('customer', 'unit')
            ->where('status', 'checked_in')
            ->get();
            
        $this->menus = FnbMenu::where('is_available', true)->get();
    }

    public function addToCart($menuId, $name, $price)
    {
        if (isset($this->cart[$menuId])) {
            $this->cart[$menuId]['qty']++;
        } else {
            $this->cart[$menuId] = [
                'name' => $name,
                'price' => $price,
                'qty' => 1
            ];
        }
        $this->calculateTotal();
    }

    public function updateQty($menuId, $action)
    {
        if ($action === 'inc') {
            $this->cart[$menuId]['qty']++;
        } elseif ($action === 'dec') {
            $this->cart[$menuId]['qty']--;
            if ($this->cart[$menuId]['qty'] <= 0) {
                unset($this->cart[$menuId]);
            }
        }
        $this->calculateTotal();
    }

    public function removeItem($menuId)
    {
        unset($this->cart[$menuId]);
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->totalAmount = collect($this->cart)->sum(function ($item) {
            return $item['price'] * $item['qty'];
        });
    }

    public function processOrder()
    {
        $this->validate([
            'selectedReservation' => 'required',
            'cart' => 'required|array|min:1'
        ]);

        DB::transaction(function () {
            $order = FnbOrder::create([
                'reservation_id' => $this->selectedReservation,
                'user_id' => auth()->id(),
                'total_amount' => $this->totalAmount,
                'status' => 'served',
            ]);

            foreach ($this->cart as $menuId => $item) {
                OrderDetail::create([
                    'order_id'  => $order->order_id,
                    'item_name' => $item['name'],
                    'price'     => $item['price'],
                    'quantity'  => $item['qty'],
                    'subtotal'  => $item['price'] * $item['qty'],
                ]);
            }
        });

        session()->flash('success', 'Pesanan F&B berhasil dibuat!');
        
        // Reset form
        $this->cart = [];
        $this->selectedReservation = '';
        $this->totalAmount = 0;
    }

    public function render()
    {
        return view('livewire.fnb-order-form');
    }
}
