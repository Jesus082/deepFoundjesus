<x-app-layout>
    <link rel="stylesheet" href="{{ asset('assets/css/mis-productos.css') }}">
    <div class="container-fluid" id="container_mis_productos">
        <div class="row">
            <div class="col-xl-2 col-lg-1"></div> <!-- Espacio en blanco a la izquierda -->
            <div class="col-xl-8 col-lg-10 col-md-12">
                <div class="bg-white overflow-hidden sm:rounded-lg">
                    <h4 class="h4 ml-3">Mis anuncios</h4>
                    <div class="row pr-3 pl-3">
                        @livewire('my-products-component')
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-1"></div> <!-- Espacio en blanco a la izquierda -->
        </div>
    </div>
</x-app-layout>
