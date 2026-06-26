<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\FnbOrder;
use App\Models\Invoice;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Reservation;
use App\Models\UnitGlamping;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        $customers = Customer::all();
        $units = UnitGlamping::all();
        $statuses = ['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled'];

        $reservations = [];
        $now = Carbon::now();

        // 30 reservasi spread across past, present, and future
        for ($i = 0; $i < 30; $i++) {
            $customer = $customers->random();
            $unit = $units->random();
            $status = $statuses[array_rand($statuses)];

            // Spread dates
            if ($i < 10) {
                // Past reservations (checked_out mostly)
                $checkIn = $now->copy()->subDays(rand(15, 60));
                $status = collect(['checked_out', 'cancelled'])->random();
            } elseif ($i < 20) {
                // Current/near reservations
                $checkIn = $now->copy()->subDays(rand(0, 5));
                $status = collect(['checked_in', 'confirmed', 'pending'])->random();
            } else {
                // Future reservations
                $checkIn = $now->copy()->addDays(rand(1, 30));
                $status = collect(['pending', 'confirmed'])->random();
            }

            $nights = rand(1, 4);
            $checkOut = $checkIn->copy()->addDays($nights);

            $reservation = Reservation::create([
                'customer_id'    => $customer->customer_id,
                'unit_id'        => $unit->unit_id,
                'check_in_date'  => $checkIn->toDateString(),
                'check_out_date' => $checkOut->toDateString(),
                'booking_code'   => Reservation::generateBookingCode(),
                'status'         => $status,
                'dp_amount'      => $status !== 'cancelled' ? round($unit->price_per_night * $nights * 0.3, -3) : null,
                'special_request'=> collect([null, 'Extra pillow', 'Late check-out', 'Quiet area', 'Birthday setup'])->random(),
            ]);

            // Add F&B orders for checked_in and checked_out
            if (in_array($status, ['checked_in', 'checked_out'])) {
                $orderCount = rand(1, 3);
                for ($j = 0; $j < $orderCount; $j++) {
                    $order = FnbOrder::create([
                        'reservation_id' => $reservation->reservation_id,
                        'order_date'     => $checkIn->copy()->addDays(rand(0, $nights - 1))->toDateString(),
                        'total_amount'   => 0,
                        'status'         => $status === 'checked_out' ? 'served' : collect(['pending', 'processing', 'served'])->random(),
                    ]);

                    $menuItems = \App\Models\FnbMenu::inRandomOrder()->take(rand(1, 4))->get();
                    $orderTotal = 0;

                    foreach ($menuItems as $menu) {
                        $qty = rand(1, 3);
                        $subtotal = $menu->price * $qty;
                        OrderDetail::create([
                            'order_id'  => $order->order_id,
                            'item_name' => $menu->menu_name,
                            'price'     => $menu->price,
                            'quantity'  => $qty,
                            'subtotal'  => $subtotal,
                        ]);
                        $orderTotal += $subtotal;
                    }

                    $order->update(['total_amount' => $orderTotal]);
                }
            }

            // Add invoices and payments for checked_out
            if ($status === 'checked_out') {
                $roomCharge = $unit->price_per_night * $nights;
                $fnbCharge = $reservation->fnbOrders()->sum('total_amount');
                $totalAmount = $roomCharge + $fnbCharge;

                Invoice::create([
                    'reservation_id' => $reservation->reservation_id,
                    'invoice_date'   => $checkOut->toDateString(),
                    'room_charge'    => $roomCharge,
                    'fnb_charge'     => $fnbCharge,
                    'total_amount'   => $totalAmount,
                    'status'         => 'paid',
                ]);

                Payment::create([
                    'reservation_id'   => $reservation->reservation_id,
                    'payment_date'     => $checkOut->toDateString(),
                    'amount'           => $totalAmount,
                    'payment_method'   => collect(['cash', 'card', 'transfer'])->random(),
                    'status'           => 'paid',
                    'reference_number' => 'PAY-' . strtoupper(uniqid()),
                ]);
            }
        }
    }
}
