<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    @livewireStyles
  </head>
  <body class="bg-white">
    <!-- Sticky Navbar -->
    <nav class="sticky top-0 z-50 bg-white border-b border-gray-200">
      <div class="container mx-auto flex items-center justify-between py-4 px-4 md:px-6">
        <div class="flex items-center gap-2">

        <a href="/">
          <img src="{{ asset('images/logos/smedan-logo.png') }}" alt="Logo" class="h-16 md:h-20">
        </a>
        </div>
        <!-- Hamburger for mobile -->
        <div class="md:hidden">
          <button id="mobile-menu-toggle" class="text-green-900 focus:outline-none" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
          </button>
        </div>
        <!-- Desktop Nav -->
        <div class="hidden md:flex items-center gap-8">
          <!-- <a href="#" class="text-green-900 font-medium hover:text-green-700">What is DMA</a>
          <a href="#" class="text-green-900 font-medium hover:text-green-700">Components</a> -->
          <a href="{{ route('login') }}" class="text-green-900 font-medium hover:text-green-700">Administrator</a>
          <a href="#" class="ml-4 bg-green-500 hover:bg-green-600 text-white font-semibold px-5 py-2 rounded-lg transition">Get Started</a>
        </div>
      </div>
      <!-- Mobile Nav -->
      <div id="mobile-menu" class="md:hidden hidden bg-white border-t border-gray-200 px-4 pb-4">
        <!-- <a href="#" class="block py-2 text-green-900 font-medium hover:text-green-700">What is DMA</a>
        <a href="#" class="block py-2 text-green-900 font-medium hover:text-green-700">Components</a> -->
        <a href="{{ route('login') }}" class="block py-2 text-green-900 font-medium hover:text-green-700">Administrator</a>
        <a href="#" class="block py-2 mt-2 bg-green-500 hover:bg-green-600 text-white font-semibold px-5 py-2 rounded-lg transition w-full text-center">Get Started</a>
      </div>
    </nav>

    @yield('content')
   

    @stack('scripts')

    @livewireScripts
  </body>
</html>
