<x-app-layout>
    <link rel="stylesheet" href="{{ asset('assets/css/mis-productos.css') }}">
    <div class="container-fluid" id="container_mis_productos">
        <div class="row">
            <div class="col-xl-2 col-lg-1"></div> <!-- Espacio en blanco a la izquierda -->
            <div class="col-xl-8 col-lg-10 col-md-12">
                <div class="bg-white overflow-hidden sm:rounded-lg">
                    <h4 class="h4 ml-3">Mis anuncios</h4>
                    <div class="row pr-3 pl-3">
                        <div class="row w-100">
                            <div class="">
                                <div class="card bg-body rounded mb-3 shadow-sm" id="card-user-mis-productos">
                                    <div class="row g-0">
                                        <div
                                            class="col-md-12 d-flex flex-xl-row flex-lg-row flex-md-row flex-sm-row flex-column align-items-center">
                                            <img src="{{ asset($user->profile_photo_url) }}"
                                                class="object-cover bg-cover ml-4 mt-2" alt="..."
                                                id="img_usario_perfil">
                                            <div class="col-md-6">
                                                <h2 class="h4 ml-2">{{ $user->name }}</h2>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3" id="botones-filtros">
                                    <div class="d-flex justify-content-between">
                                        <button wire:click="all_products()">Todos</button>
                                        <button wire:click="show_products_reserved()">Activos</button>
                                        <button wire:click="show_products_sold()">Vendidos</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @yield('content')

                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-1"></div> <!-- Espacio en blanco a la izquierda -->
        </div>
    </div>
</x-app-layout>
