  <div class="card-body">
      @if ($product->reserved)
          <div class="icono-estado-producto reservado">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                  class="bi bi-bookmark-check" viewBox="0 0 16 16">
                  <path fill-rule="evenodd"
                      d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                  <path
                      d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
              </svg>
          </div>
      @endif

      @if ($product->sold)
          <div class="icono-estado-producto vendido">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                  class="bi bi-handbag" viewBox="0 0 16 16">
                  <path
                      d="M8 1a2 2 0 0 1 2 2v2H6V3a2 2 0 0 1 2-2zm3 4V3a3 3 0 1 0-6 0v2H3.36a1.5 1.5 0 0 0-1.483 1.277L.85 13.13A2.5 2.5 0 0 0 3.322 16h9.355a2.5 2.5 0 0 0 2.473-2.87l-1.028-6.853A1.5 1.5 0 0 0 12.64 5H11zm-1 1v1.5a.5.5 0 0 0 1 0V6h1.639a.5.5 0 0 1 .494.426l1.028 6.851A1.5 1.5 0 0 1 12.678 15H3.322a1.5 1.5 0 0 1-1.483-1.277L1.81 6.872A.5.5 0 0 1 2.304 6H3V5a1 1 0 1 1 2 0z" />
              </svg>
          </div>
      @endif




      <div id="carouselExampleControls{{ $product->id }}" class="carousel slide" data-bs-ride="carousel"
          data-bs-interval="false">
          <div class="carousel-inner">
              @foreach ($product->images as $key => $image)
                  <div class="carousel-item @if ($key === 0) active @endif">
                      <img src="{{ Storage::url($image->image) }}" class="card-img-top" alt="">
                  </div>
              @endforeach
          </div>

          <button class="carousel-control-prev" type="button"
              data-bs-target="#carouselExampleControls{{ $product->id }}" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button"
              data-bs-target="#carouselExampleControls{{ $product->id }}" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
          </button>
      </div>
      <div class="d-flex flex-column inform_product">
        <p id="name_product" class="text-truncate text-uppercase">{{ $product->name }}</p>
        <p class="mt-2 mb-2" id="price_product"> <strong>{{ $product->price }}€ </strong></p>
          @if (strlen($product->description) > 50)
              <p class="card-text h6" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                  {{ substr($product->description, 0, 50) }}...</p>
          @else
              <p class="card-text h6">{{ $product->description }}</p>
          @endif
      </div>

      <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="#">Action</a></li>
          <li><a class="dropdown-item" href="#">Another action</a></li>
          <li><a class="dropdown-item" href="#">Something else here</a></li>
      </ul>
      @if (isset($isUserProductsRoute))
          <div class="h-100">
              <div class="dropdown p-3">
                  <button class="btn btn-primary btn-xs col-lg-12 dropdown-toggle overflow" style="background-color: black; color:white;"
                      type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                      Opciones
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                      <li>
                          <button class="dropdown-item" wire:click="is_reserved({{ $product->id }})">
                              Reservar
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                  class="bi bi-bookmark-check" viewBox="0 0 16 16">
                                  <path fill-rule="evenodd"
                                      d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                  <path
                                      d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                              </svg>
                          </button>
                      </li>
                      <li>
                          <button class="dropdown-item" wire:click="is_sold({{ $product->id }})">
                              Vendido
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                  class="bi bi-handbag" viewBox="0 0 16 16">
                                  <path
                                      d="M8 1a2 2 0 0 1 2 2v2H6V3a2 2 0 0 1 2-2zm3 4V3a3 3 0 1 0-6 0v2H3.36a1.5 1.5 0 0 0-1.483 1.277L.85 13.13A2.5 2.5 0 0 0 3.322 16h9.355a2.5 2.5 0 0 0 2.473-2.87l-1.028-6.853A1.5 1.5 0 0 0 12.64 5H11zm-1 1v1.5a.5.5 0 0 0 1 0V6h1.639a.5.5 0 0 1 .494.426l1.028 6.851A1.5 1.5 0 0 1 12.678 15H3.322a1.5 1.5 0 0 1-1.483-1.723l1.028-6.851A.5.5 0 0 1 3.36 6H5v1.5a.5.5 0 1 0 1 0V6h4z" />
                              </svg>
                          </button>
                      </li>
                      <li>
                          <a class="dropdown-item" href="{{ route('editar-producto', ['id' => $product->id]) }}">
                              Editar
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                  class="bi bi-pencil" viewBox="0 0 16 16">
                                  <path
                                      d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                              </svg>
                          </a>
                      </li>
                      <li>
                          <button class="dropdown-item"
                              onclick="confirm('¿Está seguro?') || event.stopImmediatePropagation()"
                              wire:click="deleteProduct({{ $product->id }})">
                              Eliminar
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                  fill="currentColor" class="bi bi-x-octagon" viewBox="0 0 16 16">
                                  <path
                                      d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z" />
                                  <path
                                      d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                              </svg>
                          </button>
                      </li>
                  </ul>
              </div>
          </div>
      @endif
  </div>
