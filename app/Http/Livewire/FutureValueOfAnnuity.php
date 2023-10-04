<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FutureValueOfAnnuity extends Component
{
    public $input;
    public $step = 0;
    public $prompt;
    public $fields = [
        'annuity' => [
            'prompt' => 'Please enter the monthly installment',
            'description' => 'Money i can save periodically',
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
    public $annuity, $nominalInterestRate, $numberOfPeriods;
    public $conversions = 1;
    public $numberOfAnnuityPayments = 12;
    public $futureValueOfAnnuity;

    protected $listeners = ['updated'];

    protected $rules = [
        'annuity' => 'required|numeric',
        'nominalInterestRate' => 'required|numeric',
        'numberOfPeriods' => 'required|numeric'
    ];

    public function mount()
    {
        $this->annuity = null;
        $this->nominalInterestRate = null;
        $this->numberOfPeriods = null;
        $this->futureValueOfAnnuity = null;

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
                $this->calculateFutureValueOfAnnuity();
            }
        }
    }

    public function updated()
    {
        // Define the required fields
        $requiredFields = ['annuity', 'nominalInterestRate', 'numberOfPeriods'];

        // Check if all required fields are filled
        foreach ($requiredFields as $field) {
            if (empty($this->$field)) {
                return;
            }
        }

        $this->calculateFutureValueOfAnnuity();
    }

    public function calculateFutureValueOfAnnuity()
    {
        $r = (1+($this->nominalInterestRate/$this->conversions)); //(1+i/m)
        $cr = $this->conversions*$this->numberOfPeriods; //conversion rate (m.n)
        $ppc = $this->conversions/$this->numberOfAnnuityPayments; //period per conversion (m/p)
        $effectiveInterestRate = ((1+($this->nominalInterestRate))**(1/$this->numberOfAnnuityPayments))-1; //effective interest rate (1+nominalinterestrate)^(1/numberofpayments)

        $this->futureValueOfAnnuity = $this->annuity * ((($r**$cr)-1)/(($r**$ppc)-1));

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
        //Hint: this value is calculated based on present values and cleared from time value between PV and FV
        for ($i = 0; $i <= $this->numberOfPeriods; ++$i) {
            //$totalInterestValues[$i] = ($presentValues[$i]*(((($r)**($this->conversions*($i)))-1))-($cummulativeAnnuityValues[$i]-$presentValues[$i]));
            $totalInterestValues[$i] = ($this->annuity*(((($r)**($this->conversions*($i)))-1))/(($r**$ppc)-1))-$cummulativeAnnuityValues[$i];
        }
        //38,03 = 1157,04*(1,07^2-1) - 1200 - 1157,04

        // Create an array to hold the simple interest value for each period
        $simpleInterestValues = [];

        // Calculate simple interest value for each period
        for ($i = 0; $i <= $this->numberOfPeriods; ++$i) {
            $calculatoryInterestRate = (((1+$effectiveInterestRate)**$this->numberOfAnnuityPayments)-1)*$i;
            $simpleInterestValues[$i] = ($this->annuity*($calculatoryInterestRate/$effectiveInterestRate))-$cummulativeAnnuityValues[$i];
            //$simpleInterestValues[$i] = (($this->annuity*(1/$effectiveInterestRate))*(((1+$effectiveInterestRate)^($i*$this->numberOfAnnuityPayments))-1));
            //$simpleInterestValues[$i] =  ($cummulativeAnnuityValues[$i]*($this->nominalInterestRate/$this->conversions));
            //($this->annuity*$this->numberOfAnnuityPayments)*($this->nominalInterestRate/$this->conversions)*($i);
        }

        // Create an array to hold the compound part of interest value for each period
        $compoundInterestValues = [];

        // Calculate compound part of interest value for each period
        for ($i = 0; $i <= $this->numberOfPeriods; ++$i) {
            $compoundInterestValues[$i] = $totalInterestValues[$i]-$simpleInterestValues[$i];
        }

        $data = [
            'numberOfPeriods' => $this->numberOfPeriods,
            'futureValueOfAnnuity' => $this->futureValueOfAnnuity,
            'presentValues' => $presentValues,
            'cummulativeAnnuityValues' => $cummulativeAnnuityValues,
            'simpleInterestValues' => $simpleInterestValues,
            'compoundInterestValues' => $compoundInterestValues,
            'totalInterestValues' => $totalInterestValues
        ];
        
        $this->emit('updateChart', $data);
    }

    public function render()
    {
        return view('livewire.future-value-of-annuity');
    }
}
