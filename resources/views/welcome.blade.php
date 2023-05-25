<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>how much do i need</title>

        <!-- Stylesheet -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles

    </head>
    <body class="bg-gray-100 min-h-screen flex flex-col">
        <div class="container mx-auto px-4 py-8 flex-grow">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-blue-500 font-serif">How much do I need?</h1>
                <button class="p-2 transition-all duration-300 ease-in-out transform hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-6 w-6 text-blue-500">
                        <path fill-rule="evenodd" d="M0 3a1 1 0 011-1h18a1 1 0 110 2H1a1 1 0 01-1-1zm0 7a1 1 0 011-1h18a1 1 0 110 2H1a1 1 0 01-1-1zm1 5a1 1 0 100 2h18a1 1 0 100-2H1z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>

        <livewire:annuity />

        </div>

        @livewireScripts

    </body>
</html>
 