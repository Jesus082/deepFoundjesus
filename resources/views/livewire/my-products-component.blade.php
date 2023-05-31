<div>
    <div class="container-fluid">
        <div class="row">
            @foreach ($products as $product)
                <div class="card" style="width: 18rem;">
                    <x-product-card :product="$product" :isUserProductsRoute="$isUserProductsRoute" />
                </div>
            @endforeach
        </div>
    </div>
</div>
