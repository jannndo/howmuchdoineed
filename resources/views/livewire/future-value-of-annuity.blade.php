<div x-data="{ formatNumber: (number) => parseFloat(number).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') }">
    @if(!$futureValueOfAnnuity)
        <div class="mt-4 m">
            <input 
                class="
                        mt-32
                        text-8xl md:text-5xl sm:text-2xl
                        text-grey-400
                        focus:ring-gray-100
                        focus:border-none
                        block 
                        w-full 
                        border-none
                        shadow-none 
                        rounded-md 
                        bg-transparent
                        h-32
                        "
                wire:model.defer="input" 
                wire:keydown.enter="submit" 
                type="number" id="input" 
                placeholder="{{ $fields[array_keys($fields)[$step]]['prompt'] }}"
                autofocus>
        </div>
    @endif

    <div class="mt-4 grid grid-cols-3 gap-4 bg-transparent">
    @foreach ($fields as $field => $data)
        @if ($$field)
            <div class="bg-white rounded-lg p-4 bg-transparent">
                <h4 class="font-semibold text-lg">{{ $data['description'] }}</h4>
                <input 
                    wire:model.lazy="{{ $field }}" 
                    id="{{ $field }}" 
                    name="{{ $field }}" 
                    type="text" 
                    class="
                        text-3xl md:text-2xl sm:text-xl 
                        focus:ring-gray-100
                        focus:border-none
                        block 
                        w-full
                        border-none
                        shadow-none 
                        rounded-md 
                        bg-transparent
                        "
                    x-text="formatNumber({{ $$field }})">
            </div>
        @endif
    @endforeach
    </div>

    @if($futureValueOfAnnuity)
        <div class="mt-4 bg-white shadow rounded-lg p-4 text-center">
            <h5 class="font-extralight text-lg">Calculated Future Value of the Annuity</h5>
            <p class="mb-2 font-bold">You will save </p>
            <p><span x-text="formatNumber({{ $futureValueOfAnnuity }})"></span> of monetary units in <span x-text="formatNumber({{ $numberOfPeriods }})"></span> years at the nominal interest rate of <span x-text="formatNumber({{ $nominalInterestRate }})"></span> %.</p>
        </div>
    @endif
</div>