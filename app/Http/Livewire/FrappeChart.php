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
            'name' => "Present Values of your payments",
            'values' => []
        ];
        
        $simpleInterestValuesDataset = [
            'name' => "Simple Interest Values",
            'values' => []
        ];
        
        $compoundInterestValuesDataset = [
            'name' => "Compound Interest Values",
            'values' => []
        ];
    
        for ($i = 0; $i <= $data['numberOfPeriods']; $i++) {
            array_push($presentValuesDataset['values'], $data['presentValues'][$i]);
            array_push($simpleInterestValuesDataset['values'], $data['simpleInterestValues'][$i]);
            array_push($compoundInterestValuesDataset['values'], $data['compoundInterestValues'][$i]);
        }
        
        $this->data = [
            'labels' => range(0, $data['numberOfPeriods']),
            'datasets' => [
                $presentValuesDataset,
                $simpleInterestValuesDataset,
                $compoundInterestValuesDataset
            ]
        ];
    
        $this->dispatchBrowserEvent('redraw-chart', $this->data);  // Emit a JavaScript event
    }

    public function render()
    {
        return view('livewire.frappe-chart');
    }
}
