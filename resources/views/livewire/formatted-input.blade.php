<div>
    <input 
        wire:model="input"
        class="block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
        type="text" 
        placeholder="0.00"
        autofocus
    >
    @if($warningVisible)
        <div class="mt-2 text-red-600">Only digits are allowed!</div>
    @endif
</div>
