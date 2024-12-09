@extends('layouts.app') <!--  INCLUIR EL LAYOUT -->

<!-- TITULO -->
@section('titulo')
    Perfil: {{ $user->username }}
@endsection
<!-- FIN TITULO -->

<!-- CONTENIDO  -->
@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{ asset('img/usuario.svg') }}" alt="usuario imagen">
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">
                <!-- NOMBRE USUARIO -->
                <p class="font-bold text-2xl">{{ $user->username }}</p>

                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                    0
                    <span class="font-normal">seguidores</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">Sigue</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">Posts</span>
                </p>
            </div>  
        </div>
    </div>

    <!-- PUBLICACIONES -->
    <section class="container mx-auto mt-10">
        <h2 class="font-black text-center text-3xl mb-10">Publicaciones</h2>
        @if ($posts->count())
            
        <!--  LISTAR PUBLICACIONES -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as  $post)
                <div>
                    <a href="">
                        <img src="{{asset('uploads') .'/' . $post->imagen }}" alt="imagen publicacion {{ $post->titulo }}">
                    </a>
                </div>
            @endforeach
        </div>

        <!--  PAGINACION -->
        <div class="mt-10">
            {{ $posts->links('pagination::tailwind') }}
        </div>
        @else
            <p class="text-center text-gray-600 uppercase text-sm font-bold">No hay publicaciones aun.</p>
        @endif
    </section>
@endsection
<!-- FIN CONTENIDO -->