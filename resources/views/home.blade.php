@extends('layouts.app') <!--  INCLUIR EL LAYOUT -->

<!-- TITULO -->
@section('titulo')
    Pagina principal
@endsection
<!-- FIN TITULO -->

<!-- CONTENIDO  -->
@section('contenido')
    @if ($posts->count())
        <!--  LISTAR PUBLICACIONES -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as  $post)
                <div>
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user ]) }}">
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
        <p class="text-center text-gray-600 uppercase text-sm font-bold">No hay publicaciones aun. Sigue a alguien para ver sus publicaciones</p>
    @endif
@endsection
<!-- FIN CONTENIDO -->