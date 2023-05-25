<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>how much do i need</title>

        <!-- Stylesheet -->
        @vite('resources/css/app.css')

    </head>
    <body class="bg-gray-100 flex flex-col min-h-screen">
    <header class="bg-purple-500 shadow">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="text-xl font-bold text-white">
                    Marketing Company
                </div>
                <nav>
                    <ul class="flex items-center space-x-4">
                        <li><a href="#" class="text-white hover:text-purple-300">Home</a></li>
                        <li><a href="#" class="text-white hover:text-purple-300">Services</a></li>
                        <li><a href="#" class="text-white hover:text-purple-300">About</a></li>
                        <li><a href="#" class="text-white hover:text-purple-300">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main class="py-8 flex-grow">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold text-center text-purple-500 mb-8">Welcome to Our Marketing Company</h1>
            <p class="text-center text-gray-600 mb-8">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras elementum consectetur ligula, a commodo nibh sollicitudin nec. Pellentesque auctor ac ante nec fringilla. In at lorem a velit consequat ultricies.</p>
            <p class="text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla semper purus eu nulla tempus, ut consectetur augue ultrices. Sed auctor, justo ut sollicitudin laoreet, turpis turpis fermentum justo, ac egestas sapien lectus vel urna.</p>
            <p class="text-gray-600 mb-4">Curabitur quis risus elementum, pellentesque libero at, vulputate risus. Quisque euismod, sapien sit amet malesuada lacinia, tortor enim eleifend ligula, id sollicitudin mi sapien ac enim. Vivamus tempor, velit vel condimentum porttitor, sem elit sagittis sapien, at dapibus tellus odio non lacus.</p>
        </div>
    </main>

    <footer class="bg-purple-500 text-white py-4">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <h3 class="text-lg font-bold mb-4">Company</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:underline">About Us</a></li>
                        <li><a href="#" class="hover:underline">Our Team</a></li>
                        <li><a href="#" class="hover:underline">Careers</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Services</h3>
<ul class="space-y-2">
<li><a href="#" class="hover:underline">Digital Marketing</a></li>
<li><a href="#" class="hover:underline">Social Media Management</a></li>
<li><a href="#" class="hover:underline">Content Creation</a></li>
</ul>
</div>
<div>
<h3 class="text-lg font-bold mb-4">Contact</h3>
<ul class="space-y-2">
<li><a href="#" class="hover:underline">Contact Us</a></li>
<li><a href="#" class="hover:underline">Support</a></li>
</ul>
</div>
</div>
<div class="mt-8 text-center">
<p>© {{ date('Y') }} Marketing Company. All rights reserved.</p>
</div>
</div>
</footer>
<script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>