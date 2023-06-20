<x-app-layout>

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-2 col-lg-1"></div> <!-- Espacio en blanco a la izquierda -->
            <div class="col-xl-8 col-lg-12 col-md-12">

                <div class="bg-white overflow-hidden sm:rounded-lg">
                    <div class="d-flex flex-column justify-content-center align-items-center h-100 mb-5">
                        <img src="{{ Storage::url('public/images/deepfound-low-resolution-logo-black-on-transparent-background.png') }}"
                            id="logo-pagina" class="my-0" alt="">
                        <h2 class="h4 mt-5 font-weight-bold fst-italic">Descubre la historia en cada objeto: tu lugar
                            para coleccionar recuerdos únicos</h2>
                    </div>

                    <div class="form-group d-flex flex-column justify-content-center align-items-center border rounded shadow p-3 mb-20 w-100"
                        id="formulario-buscar" style="border: 2px solid black; border-radius: 10px;">
                        <h2 class="h2"> ¿Que estas buscando?</h2>
                        <form method="GET" action="{{ route('search_products') }}" class="w-75 d-flex flex-xl-row flex-lg-row flex-md-row flex-sm-column flex-column justify-content-center p-3">
                            <input type="text" name="search" class="form-control m-2"
                                placeholder="Estoy buscando...">
                            <select name="categoryFilter" id="" class="form-control m-2">
                                <option value="" hidden selected> Categoria </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary text-white m-2" style="background-color: rgb(0, 0, 0); border-color: black; color:white;">Buscar</button>
                        </form>
                    </div>

                    @livewire('all-products-component')
                </div>
            </div>

            <div class="col-xl-2 col-lg-1"></div> <!-- Espacio en blanco a la izquierda -->
        </div>
    </div>


</x-app-layout>
