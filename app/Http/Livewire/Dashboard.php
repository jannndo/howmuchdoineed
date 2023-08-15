<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $showChart = false;
    public $chartData = [];

    protected $listeners = ['updateChart' => 'displayChart'];

    public function displayChart($data)
    {
        $this->showChart = true;
        $this->chartData = $data;
    }

    public function render()
    {
        return view('livewire.dashboard', ['chartData' => $this->chartData]);
    }
}
