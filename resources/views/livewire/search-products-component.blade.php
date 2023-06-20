    <div>
        <div class="mt-3" id="main-buscador-livewire">
            <div id="buscador-livewire" class="d-flex mb-4">
                <input type="text" wire:model="search" class="w-75  border rounded">
                <button type="button" class="btn btn-primary ml-3" data-bs-toggle="collapse"
                    data-bs-target="#filtrosCollapse"
                    style="background-color: rgb(0, 0, 0); border-color: black; color:white;">
                    Filtros
                </button>
            </div>
            <div id="filtrosCollapse" class="collapse" wire:ignore.self>

                <div class="row d-flex flex-xl-row flex-sm-row flex-column mb-3">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-11">
                        <select class="form-control" name="" id="" wire:model="categoryFilter">
                            <option value="" hidden selected> Categoria </option>
                            <option value="">Todas las Categorias</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"> {{ $category->name }} </option>
                            @endforeach
                        </select>
                    </div>


                    <div class=" mt-3 mt-sm-0 mt-md-0 mt-lg-0 mt-xl-0 col-lg-3 col-md-3 col-sm-6 col-11">
                        <select class="form-control" name="" id="" wire:model="subCategoryFilter">
                            <option value="" hidden selected> Subcategoria </option>
                            <option value="">Todas las SubCategorias</option>
                            @foreach ($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}"> {{ $subcategory->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3 mt-sm-3 mt-md-0 mt-lg-0 mt-xl-0 col-lg-3 col-md-3 col-sm-6 col-11 ">
                        <select class="form-control" name="" id="" wire:model="statusFilter">
                            <option value="" hidden selected> Estado </option>
                            <option value="">Cualquier Estado</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}"> {{ $status->status }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-4 col-md-3 col-sm-6 col-11 mb-5 justify-content-start align-items-start">
                        <div class="text-xl-center text-lg-center text-md-left">
                            <label class="h5" for="precio_desde">Rango de precio</label>
                        </div>
                        <div
                            class="d-flex flex-xl-row flex-lg-row flex-md-column flex-column align-items-md-start justify-content-xl-around justify-content-lg-around justify-content-md-around">
                            <div class="col-xl-5 col-lg-5 col-sm-12 col-md-12">
                                <input type="number" class="form-control" id="precio_desde" wire:model="min_price"
                                    placeholder="Desde" min="0">
                            </div>
                            <div class="col-xl-5 col-lg-5 col-sm-12 col-md-12">
                                <input type="number" class="form-control" id="precio_hasta" wire:model="max_price"
                                    placeholder="Hasta"
                                    @if (is_numeric($min_price)) min="{{ $min_price + 100 }}" @else min="0" @endif>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-3 col-sm-6 col-11 mb-5 content justify-content-start align-items-start">
                        <div class="text-xl-center text-lg-center text-md-left">
                            <label class="h5" for="anio">Fabricación</label>
                        </div>
                        <div
                            class="d-flex flex-xl-row flex-lg-row flex-md-column flex-column align-items-md-start justify-content-xl-around justify-content-lg-around justify-content-md-around">
                            <div class="col-xl-5 col-lg-7 col-sm-12 col-md-12">
                                <select class="form-control" id="anio" name="anio" wire:model="min_year">
                                    <option value="">Cualquier Año</option>
                                    <option value="" hidden selected>Desde</option>
                                    <?php
                                    // Obtener el año actual
                                    $anioActual = date('Y');

                                    // Años D.C.
                                    for ($i = $anioActual; $i >= 0; $i--) {
                                        echo "<option value=\"$i\">$i</option>";
                                    }

                                    // Años A.C.
                                    for ($i = 1; $i <= $anioActual; $i++) {
                                        $anioAC = $i * -1;
                                        echo "<option value=\"$anioAC\">$anioAC A.C.</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-xl-5 col-lg-7 col-sm-12 col-md-12">
                                <select class="form-control" id="anio" name="anio" wire:model="max_year">
                                    <option value="2023">Cualquier Año</option>
                                    <option value="" hidden selected>Hasta</option>
                                    <?php
                                    // Obtener el año actual
                                    $anioActual = date('Y');

                                    // Años D.C.
                                    for ($i = $anioActual; $i >= 0; $i--) {
                                        echo "<option value=\"$i\">$i</option>";
                                    }

                                    // Años A.C.
                                    for ($i = 1; $i <= $anioActual; $i++) {
                                        $anioAC = $i * -1;
                                        echo "<option value=\"$anioAC\">$anioAC A.C.</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-5 justify-content-start align-items-start">
                        <div class="text-xl-center text-lg-center text-md-left">
                            <label class="h5" for="ordenar_por">Ordenar por</label>
                        </div>
                        <div class="d-flex flex-row justify-content-xl-around justify-content-lg-around">
                            <div class="col-md-12 col-sm-12 col-11">
                                <select class="form-control" id="ordenar_por" name="ordenar_por" wire:model="sortOrder">
                                    <option value="asc">Más Barato</option>
                                    <option value="desc">Más Caro</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row pr-3 pl-3" id="productos_usuario">
                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-8 col-12 p-2 pb-5">
                        <a href="{{ route('item', ['id' => $product->id]) }}" target="_blank">
                            <div class="card preview-card-product mb-5" id="card_allproducts"
                                wire:key="{{ $loop->index . rand() }}" wire:loading.attr="disabled">
                                <x-products-card.preview-product-card :product="$product" />
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
