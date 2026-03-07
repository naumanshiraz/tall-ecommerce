<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

#[Title('Product Detail - TallCart')]
class ProductDetailPage extends Component
{
    public $slug;

    public $quantity = 1;

    public function mount($slug) 
    {
        $this->slug = $slug;
    }

    public function increaseQty()
    {
        $this->quantity++;
    }

    public function decreaseQty()
    {
        if($this->quantity > 1) {
            $this->quantity--;
        } 
    }

    public function addToCart($product_id)
    {
        $total_count = CartManagement::addItemToCartWithQuantity($product_id, $this->quantity);

        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);

        LivewireAlert::title('Product Added')
            ->text('Product has been added to the cart successfully.')
            ->position('bottom-end')
            ->timer(3000)
            ->success()
            ->toast()
            ->show();
    }


    public function render()
    {
        $product = Product::where('slug', $this->slug)->firstOrFail();
        
        return view('livewire.product-detail-page', [
            'product' => $product
        ]);
    }
}
