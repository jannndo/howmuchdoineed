<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Annuity extends Component
{
    public $input;
    public $step = 0;
    public $prompt;
    public $fields = [
        'futureValue' => 'Please enter the future value',
        'nominalInterestRate' => 'Please enter the nominal interest rate',
        'numberOfPeriods' => 'Please enter the number of periods'
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
        $this->annuity = $this->futureValue *( 
                        (((1+($this->nominalInterestRate/$this->conversions))**($this->conversions/$this->numberOfAnnuityPayments))-1)/
                        (((1+($this->nominalInterestRate/$this->conversions))**($this->conversions*$this->numberOfPeriods))-1)
                    );
    }

    public function render()
    {
        return view('livewire.annuity');
    }
}
