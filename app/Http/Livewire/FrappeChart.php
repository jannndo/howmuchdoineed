<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FrappeChart extends Component
{
    public $data;

    protected $listeners = ['updateChart' => 'updateChart'];

    public function mount()
    {
        $this->data = [
            'labels' => [],
            'datasets' => [
                [
                    'name' => "Sales",
                    'values' => []
                ]
            ]
        ];
    }

    public function updateChart($data)
    {
        $presentValuesDataset = [
            'name' => "Present Value",
            'values' => []
        ];
    
        for ($i = 0; $i <= $data['numberOfPeriods']; $i++) {
            array_push($presentValuesDataset['values'], $data['presentValues'][$i]);
        }
        
        $this->data = [
            'labels' => range(0, $data['numberOfPeriods']),
            'datasets' => [
                $presentValuesDataset
            ]
        ];
    
        $this->dispatchBrowserEvent('redraw-chart', $this->data);  // Emit a JavaScript event
    }

    public function render()
    {
        return view('livewire.frappe-chart');
    }
}
