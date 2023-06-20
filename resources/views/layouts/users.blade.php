<x-app-layout>
    <link rel="stylesheet" href="{{ asset('assets/css/usuario.css') }}">
    <div class="container-fluid d-flex justify-content-center h-100">
        <div class="row d-flex justify-content-center h-100" id="tarjeta_usuario" style="background-color:rgb(255, 255, 255)">
            @livewire('user-component', [$id])
            @yield('content')
        </div>
    </div>
</x-app-layout>
