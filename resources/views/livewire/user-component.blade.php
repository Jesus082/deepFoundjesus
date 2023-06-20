<div>
    <div class="col-12 mt-2">
        <div class="content d-flex flex-column justify-content-center align-items-center h-100">
            <img src="{{ asset($user->profile_photo_url) }}" alt="" class="object-cover bg-cover">
            <h2 class="h5">{{ $user->name }}</h2>
        </div>
    </div>
    <div class="row d-flex justify-content-start p-3">
        <div class="col-1">
            <a href="{{ route('user-products', ['id' => $user->id]) }}">
                Productos
            </a>
        </div>
        <div class="col-1">
            <a href="">
                informacion
            </a>
        </div>
    </div>
</div>
