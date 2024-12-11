@extends('layouts.app') <!--  INCLUIR EL LAYOUT -->

<!-- TITULO -->
@section('titulo')
    Edita tu perfil
@endsection
<!-- FIN TITULO -->

<!-- CONTENIDO  -->
@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-6/12 bg-white shadow p-6 rounded-lg">
            <form action="{{ route('perfil.store') }}" method="POST" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf <!-- TOKEN DE SEGURIDAD -->
                <!-- Mensaje de error -->
                @if (session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ session('mensaje') }}</p>
                @endif
                <!-- NOMBRE DEL USUARIO -->
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input id="username" name="username" type="text" placeholder="Tu username" class="border p-3 w-full rounded-lg @error('name')
                        border-red-500
                    @enderror"
                    value="{{ auth()->user()->username }}"
                    >
                    <!-- Mensajes de error -->
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <!-- EMAIL DEL USUARIO -->
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input id="email" name="email" type="email" placeholder="Tu Email" class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                    value="{{ auth()->user()->email }}"
                    >
                    <!-- Mensajes de error -->
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <!-- PASSWORD DEL USUARIO -->
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>
                    <input id="password" name="password" type="password" placeholder="Tu Password" class="border p-3 w-full rounded-lg @error('password')
                        border-red-500
                    @enderror"
                    >
                    <!-- Mensajes de error -->
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Nuevo PASSWORD DEL USUARIO -->
                <div class="mb-5">
                    <label for="new_password" class="mb-2 block uppercase text-gray-500 font-bold">Nuevo Password</label>
                    <input id="new_password" name="new_password" type="password" placeholder="Tu nuevo Password" class="border p-3 w-full rounded-lg">
                </div>

                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">Foto de Perfil</label>
                    <input id="imagen" name="imagen" type="file"
                        accept=".jpg, .png, .jpeg"
                        class="border p-3 w-full rounded-lg">
                </div>
                <!-- Boton de enviar -->
                <input type="submit" value="Guardar Cambios" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection
<!-- FIN CONTENIDO -->