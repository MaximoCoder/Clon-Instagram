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
                <!-- Validar si el usuario esta autenticado -->
                @auth
                    <nav class="flex gap-2 items-center">
                        <a href="{{  route('login') }}" class="font-bold  text-gray-600">Hola: {{ auth()->user()->username }}</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"  class="font-bold uppercase text-gray-600">Cerrar Sesion</button>
                        </form>
                    </nav>
                @endauth
                <!-- El usuario no esta autenticado -->
                @guest
                    <nav class="flex gap-2 items-center">
                        <a href="{{  route('login') }}" class="font-bold uppercase text-gray-600">Login</a>
                        <a href="{{ route('register') }}" class="font-bold uppercase text-gray-600">Crear Cuenta</a>
                    </nav>
                @endguest
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