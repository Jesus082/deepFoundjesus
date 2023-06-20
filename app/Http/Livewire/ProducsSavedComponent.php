<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\Producto;
use App\Models\ProductLike;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProducsSavedComponent extends Component
{
    public $user;

    public function render()
    {
        $products = $this->LikeUsers();
        return view('livewire.producs-saved-component', compact('products'));
    }

    public function LikeUsers()
    {
        $this->user = Auth::user();

        $LikesUser = DB::table('product_likes')->select('producto_id')->where('user_id', $this->user->id)->pluck('producto_id')->toArray();

        return Producto::find($LikesUser);

    }
}
