<?php

namespace App\Http\Livewire;
use App\Models\Producto;
use Livewire\Component;

class LikeComponent extends Component
{
    public Producto $product;
    public $count;

    public function mount(Producto $product)
    {
        $this->product = $product;
        $this->count = $product->likes_count;
    }

    public function like(): void
    {

        if ($this->product->isLiked()) {
            $this->product->removeLike();
    
            $this->count--;
        } elseif (auth()->user()) {
            $this->product->likes()->create([
                'user_id' => auth()->id(),
                'producto_id' => $this->product->id,
            ]);
    
            $this->count++;
        } elseif (($ip = request()->ip()) && ($userAgent = request()->userAgent())) {
            $this->product->likes()->create([
                'ip' => $ip,
                'user_agent' => $userAgent,
            ]);
    
            $this->count++;
        }
    }

    public function render()
    {
        return view('livewire.like-component');
    }
}
