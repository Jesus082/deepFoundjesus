<div>
    <div class="row pr-3 pl-3" id="productos_usuario">
        @foreach ($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-8 col-12 p-2 pb-5">
                <a href="{{ route('item', ['id' => $product->id]) }}" target="_blank">
                    <div class="card preview-card-product">
                        <x-products-card.preview-product-card :product="$product" />
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
