<?php

namespace App\Livewire;

use App\Models\UnitGlamping;
use App\Services\DynamicPricingService;
use Carbon\Carbon;
use Livewire\Component;

class DssPricingPanel extends Component
{
    public $recommendations = [];
    public $targetDate;
    public $isCalculated = false;

    public function mount()
    {
        $this->targetDate = Carbon::today()->toDateString();
    }

    public function calculatePricing(DynamicPricingService $dss)
    {
        $this->validate([
            'targetDate' => 'required|date'
        ]);

        $units = UnitGlamping::all();
        $results = [];

        foreach ($units as $unit) {
            $recommendation = $dss->calculateRecommendation($unit->unit_id, $this->targetDate);
            $results[] = [
                'unit' => $unit,
                'recommendation' => $recommendation
            ];
        }

        // Sort by highest score (most urgent for price increase/decrease depending on logic, 
        // actually SAW score 0-1, higher means higher occupancy/demand)
        usort($results, function($a, $b) {
            return $b['recommendation']['score'] <=> $a['recommendation']['score'];
        });

        $this->recommendations = $results;
        $this->isCalculated = true;
    }

    public function applyRecommendation($unitId, $newPrice)
    {
        $unit = UnitGlamping::find($unitId);
        if ($unit) {
            $unit->update(['base_price' => $newPrice]);
            session()->flash('success', "Harga {$unit->unit_name} berhasil diupdate menjadi Rp " . number_format($newPrice, 0, ',', '.'));
            $this->calculatePricing(app(DynamicPricingService::class));
        }
    }

    public function render()
    {
        return view('livewire.dss-pricing-panel');
    }
}
