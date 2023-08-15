<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Symfony\Component\Mailer\DelayedEnvelope;

class Chart extends Component
{
    public $chartData = [];

    protected $listeners = ['updateChart' => 'onUpdateChart'];

    public function onUpdateChart($data)
    {
        $this->chartData = $data;   
        $this->emitTo('chart', 'chartData', $data);
        $this->emit('showChart', true);
    }

    public function render()
    {
        return view('livewire.chart', ['chartData' => $this->chartData]);
    }
}
