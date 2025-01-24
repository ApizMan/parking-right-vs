<?php

namespace App\Livewire\HistoricalEvent;

use App\Models\HistoricalEvent;
use Livewire\Component;

class Dashboard extends Component
{
    public $datas = [];
    public $department_involved;
    public $date;
    public $title;
    public $description;
    public $staff_involved;

    protected $listeners = ['deleteEvent']; // Ensure this is declared at the top

    public function mount()
    {
        $this->datas = HistoricalEvent::all();
    }

    public function save()
    {
        // Validate the input data

        // dd([$this->department_involve, $this->date, $this->title, $this->description, $this->staff_involve]);
        // dd();
        $validateData = $this->validate([
            'department_involved' => 'required|string|max:255',
            'date' => 'required|date',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'staff_involved' => 'required|string|max:255',
        ]);

        // If validation passes, create the user
        if ($validateData) {
            // Create a new user
            HistoricalEvent::create([
                'department_involved' => $validateData['department_involved'],
                'event_date' => $validateData['date'],
                'title' => $validateData['title'],
                'description' => $validateData['description'],
                'staff_involved' => $validateData['staff_involved'],
            ]);

            // Flash success message
            session()->flash('status', 'Event created successfully!');

            // Reset input fields
            $this->reset(['department_involved', 'date', 'title', 'description', 'staff_involved']);

            return redirect()->route('auth.historical_event.event_list');
        }
    }

    public function deleteEvent($id)
    {
        // dd($id);
        $this->delete($id);
    }

    public function delete($eventId)
    {
        $event = HistoricalEvent::find($eventId);

        $event->delete();

        // Flash success message
        session()->flash('status', 'Event delete successfully!');

        return redirect()->route('auth.historical_event.event_list');
    }

    public function render()
    {
        return view('livewire.historical-event.dashboard');
    }
}
