<div>
    <div>
        <div class="col-md-6 d-flex justify-content-center">
            <form enctype="multipart/form-data" wire:submit.prevent="store">
                @csrf

                <div class="form-group">
                    <label for="title">Título</label>
                    <input type="text" class="form-control" id="title" wire:model="name" name="title" required>
                </div>

                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea class="form-control" id="description" wire:model="description" name="description" required></textarea>
                </div>

                <div class="form-group">
                    <label for="price">Precio</label>
                    <input type="number" class="form-control" id="price" wire:model="price" name="price"
                        step="0.01" required>
                </div>


                <div class="form-group">

                    <div class="row">
                        @foreach ($images as $key => $image)
                            <div class="col-3 card me-1 mb-1" wire:key="{{ $loop->index }}">
                                <img src="{{ $image->temporaryUrl() }}">
                                <button type="button" wire:click="removeMe({{ $loop->index }})">Remove</button>
                            </div>
                        @endforeach

                    </div>
                    <label class="form-label">Image Upload</label>
                    <input type="file" class="form-control" wire:model="newImage">
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

</div>
