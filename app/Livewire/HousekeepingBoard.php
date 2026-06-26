<?php

namespace App\Livewire;

use App\Models\Housekeeping;
use Livewire\Component;

class HousekeepingBoard extends Component
{
    public function markAsReady($housekeepingId)
    {
        $task = Housekeeping::find($housekeepingId);
        if ($task) {
            $task->update(['status' => 'ready']);
            // Update the unit status to available
            $task->unit->update(['status' => 'available']);
        }
    }

    public function render()
    {
        $tasks = Housekeeping::with('unit')
            ->where('status', 'dirty')
            ->orWhere('status', 'in_progress')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('livewire.housekeeping-board', [
            'tasks' => $tasks
        ]);
    }
}
