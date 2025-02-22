<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    @livewireStyles
  </head>
  <body>

    <nav class="bg-red-500 text-white p-4">
        <div class="container mx-auto gap-4 flex items-center">
            <a href="/">
                <img src="{{ asset('logo.webp') }}" alt="">
            </a>
            <h1 class="font-bold text-2xl">Digital Maturity Assessment - DTC Nigeria</h1>
        </div>

    </nav>

    <div class="">
        @livewire('digital-maturity-assessment')
    </div>

    @livewireScripts

  </body>
</html>
