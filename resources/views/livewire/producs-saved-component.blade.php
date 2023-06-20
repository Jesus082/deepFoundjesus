<div class="row w-100">
    <div class="">
        <div class="card bg-body rounded mb-3 shadow-sm" id="card-user-mis-productos">
            <div class="row g-0">
                <div class="col-md-12 d-flex flex-xl-row flex-lg-row flex-md-row flex-sm-row flex-column align-items-center">
                    <img src="{{ asset($user->profile_photo_url) }}" class="object-cover bg-cover ml-4 mt-2" alt="..."
                        id="img_usario_perfil">
                    <div class="col-md-6">
                        <h2 class="h4 ml-2">{{ $user->name }}</h2>
                    </div>

                </div>
            </div>
        </div>
    @foreach ($products as $product)
        <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-2 pb-5">
            <a href="{{ route('item', ['id' => $product->id]) }}" target="_blank">
                <div class="card preview-card-product" id="card_myproducts" wire:key="{{ $loop->index . rand()}}">
                    <x-products-card.preview-product-card :product="$product"/>
                </div>
            </a>
        </div>
    @endforeach
</div>
