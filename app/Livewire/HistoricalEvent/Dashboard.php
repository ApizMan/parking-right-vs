<?php

namespace App\Livewire\HistoricalEvent;

use App\Models\HistoricalEvent;
use Livewire\Component;

class Dashboard extends Component
{
    public $datas = [];

    public function mount()
    {
        $this->datas = HistoricalEvent::all();
    }

    public function render()
    {
        return view('livewire.historical-event.dashboard');
    }
}
