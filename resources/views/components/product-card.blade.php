    <div class="card-body">
        <div id="carouselExampleControls{{ $product->id }}" class="carousel slide" data-bs-ride="carousel"
            data-bs-interval="false">
            <div class="carousel-inner">
                @foreach ($product->images as $key => $image)
                    <div class="carousel-item @if ($key === 0) active @endif">
                        <img src="{{ Storage::url($image->image) }}" class="d-block w-100" alt="">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button"
                data-bs-target="#carouselExampleControls{{ $product->id }}" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button"
                data-bs-target="#carouselExampleControls{{ $product->id }}" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
        <h5 class="card-title">{{ $product->name }}</h5>
        <h6 class="card-subtitle mb-2 text-muted">{{ $product->category->name }}</h6>
        <h6 class="card-subtitle mb-2 text-muted">{{ $product->subcategory->name }}</h6>
        <p class="card-text">{{ $product->description }}</p>
        <p class="card-text">{{ $product->user->name }}</p>
        <p class="card-text">{{ $product->precio }}</p>
        @if (isset($isUserProductsRoute))
            <div>
                <a href="{{ route('editar-producto', ['id' => $product->id]) }}" class="btn m-2 rounded">Editar</a>
                <button type="button" class="btn btn-primary m-2 rounded" wire:click="deleteProduct({{ $product->id }})">Eliminar</button>
                <!-- Resto de los botones y acciones -->
            </div>
        @endif
    </div>
