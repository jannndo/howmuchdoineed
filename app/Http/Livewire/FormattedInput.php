<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FormattedInput extends Component
{
    public $input = '';
    public $warningVisible = false;

    public function updatedInput($value)
    {
        $cleanValue = $this->unformatNumber($value);

        if($cleanValue !== '') {
            if (preg_match('/^\d+$/', $cleanValue)) {
                $this->input = strlen($cleanValue) > 2 ? $this->formatNumber($cleanValue) : $cleanValue;
                $this->warningVisible = false;
            } else {
                $this->warningVisible = true;
            }
        } else {
            $this->warningVisible = false;
        }

        $this->emit('inputUpdated', $this->input);
    }

    private function formatNumber($val)
    {
        $intPart = substr($val, 0, -2) ?: '0';
        $decimalPart = substr($val, -2);
    
        $intPart = preg_replace('/\B(?=(\d{3})+(?!\d))/', ".", $intPart);
    
        return ($intPart !== '0' ? $intPart . ',' : '') . $decimalPart;
    }

    private function unformatNumber($val)
    {
        return preg_replace('/[\.,]/', '', $val);
    }

    public function render()
    {
        return view('livewire.formatted-input', ['warningVisible' => $this->warningVisible]);
    }
}
