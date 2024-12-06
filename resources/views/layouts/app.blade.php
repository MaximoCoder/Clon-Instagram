<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DevStagram - @yield('titulo')</title>

        <!-- Styles Tailwind -->
        @vite('resources/css/app.css')
    </head>

    <body>
       <header class="p-5 border-b bg-white shadow">
           <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-3xl font-black">DevStagram</h1>

                <nav class="flex gap-2 items-center">
                    <a href="{{  route('login') }}" class="font-bold uppercase text-gray-600">Login</a>
                    <a href="{{ route('register') }}" class="font-bold uppercase text-gray-600">Crear Cuenta</a>
                </nav>
           </div>
       </header>
        <!-- Contenido -->
       <main class="container mx-auto mt-10">
            <!-- Titulo del contenido -->
            <h2 class="font-black text-center text-3xl mb-10">@yield('titulo')</h2>
            @yield('contenido')
       </main>
        <!-- Footer -->
       <footer class="mt-10 text-center p-5 text-gray-500 font-bold uppercase">
            DevStagram - Todos los derechos reservados {{ date('Y') }}
       </footer>
    </body>
</html>