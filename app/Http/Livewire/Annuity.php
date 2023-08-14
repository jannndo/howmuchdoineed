<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Annuity extends Component
{
    public $input;
    public $step = 0;
    public $prompt;
    public $fields = [
        'futureValue' => [
            'prompt' => 'Please enter the desired amount of money',
            'description' => 'Money i want',
        ],
        'nominalInterestRate' => [
            'prompt' => 'Please enter the interest rate',
            'description' => 'Nominal interest rate',
        ],
        'numberOfPeriods' => [
            'prompt' => 'Please enter the number of years',
            'description' => 'Years',
        ]
    ];
    public $futureValue, $nominalInterestRate, $numberOfPeriods;
    public $conversions = 1;
    public $numberOfAnnuityPayments = 12;
    public $annuity;

    protected $listeners = ['updated'];

    protected $rules = [
        'futureValue' => 'required|numeric',
        'nominalInterestRate' => 'required|numeric',
        'numberOfPeriods' => 'required|numeric'
    ];

    public function mount()
    {
        $this->futureValue = null;
        $this->nominalInterestRate = null;
        $this->numberOfPeriods = null;
        $this->annuity = null;

        $fieldKeys = array_keys($this->fields);
        $this->prompt = $this->fields[$fieldKeys[$this->step]];
    }

    public function submit()
    {
        $this->input = floatval($this->input);
        $fieldKeys = array_keys($this->fields);

        if ($this->step < count($fieldKeys)) {
            $this->{$fieldKeys[$this->step]} = $this->input;
            $this->step++;

            if ($this->step < count($fieldKeys)) {
                $this->prompt = $this->fields[$fieldKeys[$this->step]];
            }

            $this->input = '';

            if ($this->step == count($fieldKeys)) {
                $this->calculateAnnuity();
            }
        }
    }

    public function updated()
    {
        // Define the required fields
        $requiredFields = ['futureValue', 'nominalInterestRate', 'numberOfPeriods'];

        // Check if all required fields are filled
        foreach ($requiredFields as $field) {
            if (empty($this->$field)) {
                return;
            }
        }

        $this->calculateAnnuity();
    }

    public function calculateAnnuity()
    {
        $r = (1+($this->nominalInterestRate/$this->conversions)); //(1+i/m)
        $cr = $this->conversions*$this->numberOfPeriods; //conversion rate (m.n)
        $ppc = $this->conversions/$this->numberOfAnnuityPayments; //period per conversion (m/p)

        $this->annuity = $this->futureValue * ((($r**$ppc)-1)/(($r**$cr)-1));

        // Create an array to hold the cumulative annuity value for each period
        $cummulativeAnnuityValues = [];

        // Calculate cummulative annuity value for each period
        for ($i = 0; $i <= $this->numberOfPeriods; ++$i) {
            $cummulativeAnnuityValues[$i] = $this->annuity * $i * $this->numberOfAnnuityPayments;
        }

        // Create an array to hold the present value for each period
        $presentValues = [];

        // Calculate present value for each period
        for ($i = 0; $i <= $this->numberOfPeriods; ++$i) {
            $presentValues[$i] = $this->annuity * (
                                (1-$r**(-$this->conversions*$i))/
                                (($r**$ppc)-1)
                            );
        }

        // Create an array to hold the total interest value for each period
        $totalInterestValues = [];

        // Calculate total interest value for each period
        for ($i = 0; $i <= $this->numberOfPeriods; ++$i) {
            $totalInterestValues[$i] = $presentValues[$i] *(((($r)**($this->conversions*($i)))-1));
        }

        // Create an array to hold the simple interest value for each period
        $simpleInterestValues = [];

        // Calculate simple interest value for each period
        for ($i = 0; $i <= $this->numberOfPeriods; ++$i) {
            $simpleInterestValues[$i] = $presentValues[$i]*($this->nominalInterestRate/$this->conversions)*($i);
        }

        // Create an array to hold the compound part of interest value for each period
        $compoundInterestValues = [];

        // Calculate compound part of interest value for each period
        for ($i = 0; $i <= $this->numberOfPeriods; ++$i) {
            $compoundInterestValues[$i] = $totalInterestValues[$i]-$simpleInterestValues[$i];
        }

        $data = [
            'numberOfPeriods' => $this->numberOfPeriods,
            'futureValue' => $this->futureValue,
            'presentValues' => $presentValues,
            'cummulativeAnnuityValues' => $cummulativeAnnuityValues,
            'simpleInterestValues' => $simpleInterestValues,
            'compoundInterestValues' => $compoundInterestValues
        ];
        
        $this->emit('updateChart', $data);
    }

    public function render()
    {
        return view('livewire.annuity');
    }
}
