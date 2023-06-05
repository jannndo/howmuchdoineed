<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Chart extends Component
{
    public $chartData = [];

    protected $listeners = ['updateChart' => 'onUpdateChart'];

    public function onUpdateChart($data)
    {
        $this->chartData = $data;
    }

    public function render()
    {
        return view('livewire.chart', ['chartData' => $this->chartData]);
    }
}
