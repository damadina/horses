<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">

        <x-banner />

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @livewire('navigation-menu')

            <!-- Page Content -->
            <div class ="container py-8 grid grid-cols-5">
                <aside>
                    <h1 class="font-bold text-lg-mb-4">Gestor RRHH</h1>
                    <ul class="text-sm text-gray-600">
                        {{-- <li class="leading-7 mb-1 borderl-4 @routeIs('catalogo.trabajosPPPPPP') border-indigo-400 @endif pl-2">
                            <a href="#">Creación de maters</a>
                        </li> --}}
                        <li class="leading-7 mb-1 border-l-4 @routeIs('catalogo.trabajos') border-indigo-400 @endif pl-2">
                            <a href="{{route('catalogo.trabajos')}}">Catálogo de trabajos</a>
                        </li>

                    </ul>
                </aside>
                <div class="col-span-4 card">
                    <main>
                        {{ $slot }}
                    </main>
                </div>
            </div>
        </div>

        @stack('modals')


        @livewireScripts

        @stack('scripts')
        <script src="https://kit.fontawesome.com/839c82ee0b.js" crossorigin="anonymous"></script>
    </body>
</html>
