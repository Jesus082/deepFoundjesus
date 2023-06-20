<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-2 col-lg-1"></div> <!-- Espacio en blanco a la izquierda -->
            <div class="col-xl-8 col-lg-12 col-md-12">
                <div class="bg-white overflow-hidden sm:rounded-lg">
                    @livewire('search-products-component', ['search' => $search, 'categoryFilter' => $categoryFilter])
                </div>
            </div>
            <div class="col-xl-2 col-lg-1"></div> <!-- Espacio en blanco a la izquierda -->
        </div>
    </div>

</x-app-layout>
