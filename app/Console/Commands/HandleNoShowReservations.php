<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HandleNoShowReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservations:handle-noshow';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Batalkan reservasi tamu yang tidak datang pada hari check-in';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mencari reservasi No-Show...');
        
        // Cari reservasi yang statusnya pending atau confirmed,
        // tapi tanggal check_in_date sudah lewat dari hari ini
        $reservations = Reservation::whereIn('status', ['pending', 'confirmed'])
            ->whereDate('check_in_date', '<', Carbon::today())
            ->get();
            
        if ($reservations->isEmpty()) {
            $this->info('Tidak ada reservasi No-Show hari ini.');
            return;
        }

        $count = 0;
        foreach ($reservations as $reservation) {
            try {
                DB::transaction(function () use ($reservation) {
                    $reservation->transitionTo('cancelled');
                    
                    // Release the unit back to available if it was held
                    if ($reservation->unit && $reservation->unit->status === 'occupied') {
                        $reservation->unit->update(['status' => 'available']);
                    }
                    
                    // Update notes for history
                    $note = 'Otomatis dibatalkan oleh sistem karena tamu tidak check-in (No-Show).';
                    if ($reservation->has_dp) {
                        $dpAmount = number_format($reservation->dp_amount, 0, ',', '.');
                        $note .= " Terdapat DP Rp {$dpAmount} yang perlu dicek.";
                    }
                    
                    // Kita bisa tambahkan note ke database (misal di CustomerNote atau kolom lain)
                    // Di sini kita catat ke logger system
                    Log::info("No-Show Cancellation: Booking {$reservation->booking_code}. {$note}");
                });
                
                $count++;
            } catch (\Exception $e) {
                Log::error("Gagal handle No-Show untuk reservasi {$reservation->reservation_id}: " . $e->getMessage());
                $this->error("Gagal membatalkan reservasi {$reservation->booking_code}");
            }
        }

        $this->info("Berhasil membatalkan {$count} reservasi No-Show.");
    }
}
