@extends('layouts.app') <!--  INCLUIR EL LAYOUT -->

<!-- TITULO -->
@section('titulo')
    @auth
        @if ($user->id === auth()->user()->id)
            Tu perfil
        @else
            Perfil: {{ $user->username }}
        @endif
    @endauth
@endsection
<!-- FIN TITULO -->

<!-- CONTENIDO  -->
@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <!-- Validar si el usuario tiene una imagen de perfil -->

                <img src="{{ 
                    $user->imagen ? 
                    asset('perfiles') . '/' . $user->imagen : 
                    asset('img/usuario.svg') }}" 
                    class="rounded-full" alt="usuario imagen"
                >
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">
                <div class="flex items-center gap-4">
                    <!-- NOMBRE USUARIO -->
                    <p class="font-bold text-2xl">{{ $user->username }}</p>
                    @auth
                        @if ($user->id === auth()->user()->id)
                            <a href="{{ route('perfil.index') }}" class=" text-gray-500 hover:text-gray-600 cursor:pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                                <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                </svg>

                            </a>
                        @endif
                    @endauth
                </div>
                

                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                    <!-- Contar Seguidores -->
                    {{ $user->followers->count() }}
                    <span class="font-normal">@choice('Seguidor|Seguidores', $user->followers->count() )</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    <!-- Contar Seguidos -->
                    {{ $user->following->count() }}
                    <span class="font-normal">Seguidos</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $user->posts->count() }}
                    <span class="font-normal">Posts</span>
                </p>
                <!-- BOTON DE SIGUIENDO -->
                @auth
                    <!-- VALIDAR SI EL USUARIO ES DIFERENTE AL PERFIL ACTUAL -->
                    @if ($user->id !== auth()->user()->id)
                        <!-- Validar si ya lo esta siguiendo -->
                        @if (!$user->siguiendo( auth()->user() ))
                            <!-- No lo sigue -->
                            <form action="{{  route('users.follow', $user) }}" method="POST">
                                @csrf
                                <input type="submit" class="bg-blue-600 hover:bg-blue-700 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                                value="Seguir"
                                >
                            </form>
                        @else
                            <!-- Ya lo sigue -->
                            <form action="{{  route('users.unfollow', $user) }}" method="POST">
                                @method('DELETE') <!-- METODO SPOOFING -->
                                @csrf
                                <input type="submit" class="bg-red-600 hover:bg-red-700 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                                value="Dejar de seguir"
                                >
                            </form>
                        @endif
                    @endif
                @endauth
                
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
                    <a href="{{ route('posts.show', ['user' => $user ,'post' => $post]) }}">
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