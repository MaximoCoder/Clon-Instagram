<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @livewireStyles
        @stack('styles')
        @vite('resources/css/app.css')
        <title>DevStagram - @yield('titulo')</title>
        @vite('resources/js/app.js')
        <!-- Styles Tailwind -->
        @vite('resources/css/app.css')
    </head>

    <body>
       <header class="p-5 border-b bg-white shadow">
           <div class="container mx-auto flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-3xl font-black">DevStagram</a>
                <!-- Validar si el usuario esta autenticado -->
                @auth
                    <nav class="flex gap-2 items-center">
                        <a href="{{  route('posts.create') }}" class="flex items-center gap-2 bg-white border p-2 rounded text-sm cursor-pointer  font-bold uppercase text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                            </svg>

                        
                            Crear
                        </a>
                        <a href="{{  route('posts.index', auth()->user()->username) }}" class="flex items-center font-bold text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            {{ auth()->user()->username }}
                        </a>
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
       @livewireScripts
    </body>
</html>