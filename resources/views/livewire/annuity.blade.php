<div x-data="{ formatNumber: (number) => parseFloat(number).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') }">
    @if(!$annuity)
        <div class="mt-4">
            <input 
                wire:model.defer="input" 
                wire:keydown.enter="submit" 
                type="number" id="input" 
                placeholder="{{ $fields[array_keys($fields)[$step]]['prompt'] }}"
                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md bg-transparent"
                autofocus>
        </div>
    @endif

    <div class="mt-4 grid grid-cols-3 gap-4">
    @foreach ($fields as $field => $data)
        @if ($$field)
            <div class="bg-white rounded-lg p-4 bg-transparent">
                <h4 class="font-semibold text-lg">{{ $data['description'] }}</h4>
                <input 
                    wire:model.lazy="{{ $field }}" 
                    id="{{ $field }}" 
                    name="{{ $field }}" 
                    type="text" 
                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300" 
                    x-text="formatNumber({{ $$field }})">
            </div>
        @endif
    @endforeach
    </div>

    @if($annuity)
        <div class="mt-4 bg-white shadow rounded-lg p-4 text-center">
            <h4 class="font-semibold text-lg">Calculated Annuity</h4>
            <p class="mb-2">You need to save </p>
            <p class="text-4xl font-bold mb-2" x-text="formatNumber({{ $annuity }})"></p>
            <p>each month to achieve your goal <span x-text="formatNumber({{ $futureValue }})"></span> of monetary units in <span x-text="formatNumber({{ $numberOfPeriods }})"></span> years at the nominal interest rate of <span x-text="formatNumber({{ $nominalInterestRate }})"></span> %.</p>
        </div>
    @endif
</div>
