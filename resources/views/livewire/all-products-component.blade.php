<div>
    <div class="container-fluid">
        <div class="row">
            @foreach ($productos as $product)
                <div class="card" style="width: 18rem;">
                    <x-product-card :product="$product" />
                </div>
            @endforeach
        </div>
    </div>
</div>
