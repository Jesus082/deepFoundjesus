<div>
    <div class="col-md-6 d-flex justify-content-center d-flex" id="subir-producto-form">
        <form enctype="multipart/form-data" wire:submit.prevent="store">
            @csrf
            <div class="form-outline">

                @error('name')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror

                <label class="form-label" for="title">Título</label>
                <input type="text" class="form-control" id="title" wire:model="name" name="title" required>
            </div>

            <div class="form-group">

                @error('description')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror

                <label for="description">Descripción</label>
                <textarea class="form-control" id="description" wire:model="description" wire:keydown="checkDescriptionLength"
                    name="description" required></textarea>
                <p>Caracteres: {{ $descriptionLength }}</p>
            </div>

            <div class="form-group">

                @error('price')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror

                <label for="price">Precio</label>
                <input type="number" class="form-control" id="price" wire:model="price" name="price"
                    step="0.01" required>
            </div>


            <div class="form-group" id="images">

                <div class="row">
                    @error('images')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                    @foreach ($images as $key => $image)
                        <div class="col-3 card" wire:key="{{ $loop->index }}">
                            <div class="position-relative">
                                <img class="card-img-top" src="{{ $image->temporaryUrl() }}">
                                <button type="button" class="btn btn-danger btn-remove-image"
                                    wire:click="removeMe({{ $loop->index }})">X</button>
                            </div>
                        </div>
                    @endforeach



                <label for="image-upload-input" class="flex items-center justify-center w-150 h-150 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 m-0" id="image-upload">
                    <i class="fas fa-image icon-lg text-gray-400"></i>
                    <input type="file" id="image-upload-input" class="hidden" wire:model="newImage" />
                </label>
            </div>
            </div>

            <div class="form-group">
                <div class="col-sm-10">
                    <label for="status"> Selecciona una categoria </label>
                    <select class="form-control" name="" id="" wire:model="category">
                        <option value=""> Selecciona una categoria </option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"> {{ $category->name }} </option>
                        @endforeach
                    </select>

                    <select class="form-control" name="" id="" wire:model="subcategory">

                        @foreach ($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}"> {{ $subcategory->name }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Subir Producto</button>
        </form>
    </div>

</div>
