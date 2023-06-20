<x-app-layout>
    <link rel="stylesheet" href="{{ asset('assets/css/mis-productos.css') }}">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-2 col-lg-1"></div> <!-- Espacio en blanco a la izquierda -->
            <div class="col-xl-8 col-lg-12 col-md-12">
                <div class="bg-white overflow-hidden sm:rounded-lg">
                    <h1 class="h1">Productos Guardados</h1>
                </div>
                @livewire('producs-saved-component')
            </div>
        </div>

        <div class="col-xl-2 col-lg-1"></div> <!-- Espacio en blanco a la izquierda -->
    </div>
</x-app-layout>
