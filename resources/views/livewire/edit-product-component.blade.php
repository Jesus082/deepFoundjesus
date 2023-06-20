<div id="subir-producto-form">
    <div class="col-md-8 col-xl-6 col-lg-8 col-sm-12 col-12">
        <form enctype="multipart/form-data" wire:submit.prevent='updateProduct("{{ $product->id }}")'>
            @csrf
            <div class="form-outline">
                <label class="form-label" for="title">Título</label>
                <input type="text" class="form-control" id="title" wire:model="name" name="title" required>
                @error('name')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">

                <div class="title-caracteres">
                    <label for="description">Descripción</label>
                    <p>{{ $descriptionLength }}/300</p>
                </div>
                <textarea class="form-control" id="description" wire:model="description" wire:keydown="checkDescriptionLength"
                    name="description" required></textarea>
                @error('description')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group" id="price-status">
                <div class="title-caracteres">
                    <label for="price">Precio</label>
                    <label for="status">Estado del producto</label>

                </div>
                <div class="price-status d-flex flex-row justify-content-between w-100">
                    <input type="number" class="form-control" id="price" wire:model="price" name="price"
                        step="1" required min="0">

                    @error('price')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror

                    <select class="form-control" name="statuses" id="" wire:model="status" required>
                        <option value="" hidden selected>Estado</option>
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}"> {{ $status->status }} </option>
                        @endforeach
                    </select>

                </div>

            </div>


            <div class="form-group">
                <div class="title-caracteres">
                    <label for="status"> Categoria </label>
                    <label for="status"> Subcategoria </label>
                </div>
                <div class="col-sm-10" id="categorias">

                    <select class="form-control" name="" id="" wire:model="category">
                        <option value="" hidden selected> Categoria </option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"> {{ $category->name }} </option>
                        @endforeach
                    </select>


                    <select class="form-control" name="" id="" wire:model="subcategory">
                        <option value="" hidden selected> Subcategoria </option>
                        @foreach ($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}"> {{ $subcategory->name }} </option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="form group" id="anioFabricacion">
                <label for="anio" class="form-label w-100">Año De Fabricacion:</label>
                <select class="" id="anio" name="anio" wire:model="manufacturing">
                    <option value="" hidden selected> Año de fabricacion </option>
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

            <div class="form-group">
                <label for="images">Imagenes</label>
                <div class="col-md-12 row container-images form-control">
                    @foreach ($images as $image)
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-6">
                            <div class="card" wire:key="{{ $loop->index . rand() }}">
                                <img src="{{ Storage::url($image['image']) }}" class="card-img-top" alt="">
                                <button type="button" class="remove-image"
                                    wire:click="removeImg({{ $loop->index }})">X</button>
                            </div>
                        </div>
                    @endforeach
                    @error('images')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror

                    @foreach ($tmpImages as $key => $imagetmp)
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-6">
                        <div class="card" wire:key="{{ $loop->index . rand() }}">
                            <img class="card-img-top" src="{{ $imagetmp->temporaryUrl() }}">
                            <button type="button" class="remove-image"
                                wire:click="removeImgTmp({{ $key }})">X</button>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-6">
                        <div class="card">
                            <label for="image-upload-input"
                                class="flex items-center justify-center border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600"
                                id="image-upload">
                                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                    fill="currentColor" class="bi bi-card-image" viewBox="0 0 16 16">
                                    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                    <path
                                        d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z" />
                                </svg>
                                <input type="file" id="image-upload-input" class="form-control hidden"
                                    wire:model="newImage" />
                            </label>
                        </div>
                    </div>
                </div>
            </div>




            <div class="form-group">
                <select class="form-control" wire:model="selectedAutonomia">
                    <option value="" hidden selected>Seleccione una autonomía</option>
                    @foreach ($autonomias as $autonomia)
                        <option value="{{ $autonomia['autonomia_id'] }}">{{ $autonomia['nombre'] }}</option>
                    @endforeach
                </select>

                @if ($selectedAutonomia)
                    <p wire:target="selectedAutonomia" wire:loading>
                        cargando provincias...
                    </p>
                    <select class="form-control" wire:model="selectedProvincia" wire:target="selectedAutonomia"
                        wire:loading.attr="hidden">
                        <option value="" hidden selected>Seleccione una provincia</option>
                        @foreach ($provincias as $provincia)
                            @if ($provincia['aut'] === $selectedAutonomia)
                                <option value="{{ $provincia['provincia_id'] }}">{{ $provincia['nombre'] }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                @endif

                @if ($selectedProvincia)
                    <p wire:target="selectedProvincia" wire:loading>
                        cargando municipios...
                    </p>
                    <select wire:model="selectedMunicipio" class="form-control"
                        wire:target="selectedProvincia, selectedAutonomia" wire:loading.attr="hidden">
                        <option value="" hidden selected>Seleccione un municipio</option>
                        @foreach ($municipios as $municipio)
                            @if ($municipio['provincia_id'] === $selectedProvincia)
                                <option value="{{ $municipio['municipio_id'] }}">{{ $municipio['nombre'] }}</option>
                            @endif
                        @endforeach
                    </select>
                @endif
            </div>

            <div class="form-group">

                <button type="submit" class="form-control subir-producto">Subir Producto</button>
            </div>
        </form>
    </div>

</div>
