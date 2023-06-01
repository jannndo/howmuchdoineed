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
        $cummulativeAnnuityValuesDataset = [
            'name' => "Cummulative Annuity Values",
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
            array_push($cummulativeAnnuityValuesDataset['values'], $data['cummulativeAnnuityValues'][$i]);
            array_push($simpleInterestValuesDataset['values'], $data['simpleInterestValues'][$i]);
            array_push($compoundInterestValuesDataset['values'], $data['compoundInterestValues'][$i]);
        }
        
        $this->data = [
            'labels' => range(0, $data['numberOfPeriods']),
            'datasets' => [
                $cummulativeAnnuityValuesDataset,
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
