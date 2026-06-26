<?php

namespace App\Livewire;

use App\Models\UnitGlamping;
use Livewire\Component;

class UnitStatusGrid extends Component
{
    // Auto-refresh every 30 seconds
    public function render()
    {
        $units = UnitGlamping::all();
        
        return view('livewire.unit-status-grid', [
            'units' => $units
        ]);
    }
}
