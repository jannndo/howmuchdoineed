<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $showChart = false;
    public $chartData = [];

    protected $listeners = ['showChart' => 'displayChart'];

    public function displayChart()
    {
        $this->showChart = true;
        // $this->chartData = $data;
    }

    public function render()
    {
        return view('livewire.dashboard', ['chartData' => $this->chartData]);
    }
}
