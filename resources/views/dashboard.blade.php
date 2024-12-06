@extends('layouts.app') <!--  INCLUIR EL LAYOUT -->

<!-- TITULO -->
@section('titulo')
    Tu cuenta
@endsection
<!-- FIN TITULO -->

<!-- CONTENIDO  -->
@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 md:flex">
            <div class="md:w-8/12 lg:w-6/12 px-5">
                <img src="{{ asset('img/usuario.svg') }}" alt="usuario imagen">
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5">
                <p class="font-bold text-2xl">{{ auth()->user()->username }}</p>
            </div>  
        </div>
    </div>
@endsection
<!-- FIN CONTENIDO -->