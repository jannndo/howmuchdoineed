<div>
    @if(!$annuity)
        <div class="mt-4">
            <input wire:model.defer="input" wire:keydown.enter="submit" type="number" id="input" placeholder="{{ $prompt }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md bg-transparent">
        </div>
     @endif

     <div class="mt-4 grid grid-cols-3 gap-4">
        @foreach ($fields as $field => $prompt)
            @if ($$field)
                <div class="bg-white rounded-lg p-4 bg-transparent">
                    <h4 class="font-semibold text-lg">{{ ucwords(str_replace('_', ' ', $field)) }}</h4>
                    <input wire:model.lazy="{{ $field }}" type="text" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300">
                </div>
            @endif
        @endforeach
    </div>

    @if($annuity)
        <div class="mt-4 bg-white shadow rounded-lg p-4 text-center">
            <h4 class="font-semibold text-lg">Calculated Annuity</h4>
            <p class="mb-2">You need to save </p>
            <p class="text-4xl font-bold mb-2">{{ $annuity }}</p>
            <p>each month to achieve your goal {{$futureValue}} of monetary units in {{$numberOfPeriods}} years at the nominal interest rate of {{$nominalInterestRate}} %.</p>
        </div>
    @endif
</div>
