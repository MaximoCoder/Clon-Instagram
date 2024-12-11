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
        <div class="grid grid-cols-1 gap-6">
            @foreach ($posts as $post)
            <div class="bg-white border rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 max-w-xl mx-auto w-full">
                <div class="relative">
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user ]) }}" class="block">
                        <img 
                            src="{{asset('uploads') .'/' . $post->imagen }}" 
                            alt="imagen publicacion {{ $post->titulo }}"
                            class="w-full h-64 object-cover hover:scale-105 transition-transform duration-300"
                        >
                    </a>
                </div>
                
                <div class="p-4">
                    <div class="flex items-center space-x-3 mb-2">
                        <a href="{{ route('posts.index', $post->user) }}" class="flex items-center">
                            <!-- VALIDAR SI EL USUARIO TIENE UNA IMAGEN DE PERFIL -->
                            <img 
                                src="{{ 
                                    $post->user->imagen ? 
                                    asset('perfiles') . '/' . $post->user->imagen : 
                                    asset('img/usuario.svg') }}"  
                                alt="{{ $post->user->username }}"
                                class="w-8 h-8 rounded-full object-cover mr-2"
                            >
                            <span class="font-semibold text-sm">{{ $post->user->username }}</span>
                        </a>
                        <p class="text-sm text-gray-500">
                            <!-- DIFERENCIA DE TIEMPO DE CUANDO SE CREO -->
                            {{ $post->created_at->diffForHumans()}}
                        </p>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <div class="flex space-x-4">
                            @if($post->checkLike(auth()->user()))
                                <!-- Si YA DIO LIKE entonces mostramos el boton para quitar like-->
                                <form action="{{ route('posts.likes.destroy', $post) }}" method="POST">
                                    @method('DELETE') <!-- METODO SPOOFING -->
                                    @csrf
                                    <div class="my-4">
                                        <button type="submit" class="flex items-center text-red-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="red" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                            <span>{{ $post->likes->count()}}</span>
                                        </button>
                                    </div>
                                </form>
                            @else
                                <!-- Si no ha dado like le mostramos el boton para dar like-->
                                <form action="{{ route('posts.likes.store', $post) }}" method="POST">
                                    @csrf
                                    <div class="my-4">
                                        <button type="submit" class="flex items-center text-gray-600 hover:text-red-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                            <span>{{ $post->likes->count()}}</span>
                                        </button>
                                    </div>
                                </form>
                            @endif
                            
                            <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user ]) }}" class="flex items-center text-gray-600 hover:text-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                <span>{{$post->comentarios->count()}}</span>
                            </a>
                        </div>
                        
                        <button class="text-gray-600 hover:text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                            </svg>
                        </button>
                    </div>
                    
                    <div class="mt-2">
                        <p class="text-sm text-gray-600 line-clamp-2">
                            <span class="font-semibold text-sm">{{ $post->user->username }}</span>    
                            {{ $post->descripcion }}
                        </p>
                    </div>
                </div>
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