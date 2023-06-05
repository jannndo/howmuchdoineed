<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>how much do i need</title>

        <!-- Stylesheet & Javascript-->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body>
        <livewire:chart />

        @livewireScripts
        @stack('scripts')
    </body>
</html>