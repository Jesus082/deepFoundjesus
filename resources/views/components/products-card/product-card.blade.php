<div class="card-body">
    <div class="d-flex flex-row justify-content-between mb-4">
        <a href="{{ route('users-menu', ['id' => $product->user->id]) }}" class="d-flex flex-row justify-content-around">
            <img src="{{ asset($product->user->profile_photo_url) }}"
                class="rounded-circle w-12 h-12 mr-2 object-cover bg-cover"" alt="">
            <h4 class="h4">{{ $product->user->name }}</h4>
        </a>
        <!--
        <button type="button" class="btn btn-outline-danger rounded-pill w-20 d-flex flex-row align-items-center justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                class="bi bi-heart" viewBox="0 0 16 16">
                <path
                    d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z">
                </path>
            </svg>
        </button>
    -->
        @livewire('like-component', [$product])
    </div>
    <div id="carouselExampleControls{{ $product->id }}" class="carousel slide carousel-fade" data-bs-ride="carousel"
        data-bs-interval="false">
        <div class="carousel-inner">
            @foreach ($product->images as $key => $image)
                <div class="carousel-item @if ($key === 0) active @endif">
                    <a data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-slide-to="{{ $loop->index }}">
                        <img src="{{ Storage::url($image->image) }}" class="card-img-top" alt="">
                    </a>
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
    <h1 class="h2 fw-normal">{{ $product->name }}</h1>
    <h1 class="h2 fw-bold">{{ $product->price }}€</h1>
    <h5 class="mt-9 mb-5 h5"> {{ $product->description }} </h5>

    <div class="d-flex flex-row row mt-9 ">
        <div class=" col-md-3 d-flex flex-column">
            <h2 class="h3">Estado</h2>
            <h5 class=""> {{ $product->status->status }}</h5>
        </div>
        <div class="col-md-3 d-flex flex-column ">
            <h2 class="h3">Fabricacion</h2>
            <h5> {{ $product->manufacturing }}</h5>
        </div>
        <div class="col-md-3 d-flex flex-column">
            <h2 class="h3">Estado de venta</h2>
            @if ($product->reserved)
                <div class="d-flex flex-row">
                    <h5 class="mr-1">Reservado</h5>
                    <div class="icono-estado-producto2 reservado">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-bookmark-check" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                            <path
                                d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                        </svg>
                    </div>
                </div>
            @elseif ($product->sold)
                <div class="d-flex flex-row">
                    <h5>Vendido</h5>
                    <div class="icono-estado-producto2 vendido">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-handbag" viewBox="0 0 16 16">
                            <path
                                d="M8 1a2 2 0 0 1 2 2v2H6V3a2 2 0 0 1 2-2zm3 4V3a3 3 0 1 0-6 0v2H3.36a1.5 1.5 0 0 0-1.483 1.277L.85 13.13A2.5 2.5 0 0 0 3.322 16h9.355a2.5 2.5 0 0 0 2.473-2.87l-1.028-6.853A1.5 1.5 0 0 0 12.64 5H11zm-1 1v1.5a.5.5 0 0 0 1 0V6h1.639a.5.5 0 0 1 .494.426l1.028 6.851A1.5 1.5 0 0 1 12.678 15H3.322a1.5 1.5 0 0 1-1.483-1.277L1.81 6.872A.5.5 0 0 1 2.304 6H3V5a1 1 0 1 1 2 0z" />
                        </svg>
                    </div>
                </div>
            @else
                <div class="d-flex flex-row">
                    <h5>Activo</h5>
                    <div class="icono-estado-producto2 activo">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-shield-check" viewBox="0 0 16 16">
                            <path
                                d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z" />
                            <path
                                d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                        </svg>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="row mt-5">
        <div class="d-flex flex-row">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
                <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
              </svg>
            <p class=" ml-1 pr-2">{{ $nombreAutonomia }}</p>
            <p>/</p>
            <p class="ml-1 pr-2">{{ $nombreProvincia }}</p>
            <p>/</p>
            <p class="ml-1">{{ $nombreMunicipio }}</p>
        </div>
    </div>


    <!-- Modal de imagenes-->
    <div class="modal fade" id="exampleModal" tabindex="0" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel"
                    data-bs-interval="false">
                    <div class="carousel-inner overflow-hidden">
                        @foreach ($product->images as $key => $image)
                            <div class="carousel-item @if ($key === 0) active @endif">
                                <img src="{{ Storage::url($image->image) }}" class="d-block w-100 h-auto"
                                    alt="">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>


    <script>
        let myCarousel = document.querySelector('#carouselExampleControls')
        let myModalEl = document.getElementById('exampleModal')

        myModalEl.addEventListener('show.bs.modal', function(event) {
            const trigger = event.relatedTarget
            let bsCarousel = bootstrap.Carousel.getInstance(myCarousel)
            bsCarousel.to(trigger.dataset.bsSlideTo)
        })
    </script>
</div>
