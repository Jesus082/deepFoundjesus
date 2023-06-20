<div class="row">
    @foreach ($productos as $product)
        <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-2 pb-5">
            <a href="{{ route('item', ['id' => $product->id]) }}" target="_blank">
                <div class="card preview-card-product mb-5" id="card_allproducts">
                    <x-products-card.preview-product-card :product="$product" />
                </div>
            </a>
        </div>
    @endforeach
</div>
