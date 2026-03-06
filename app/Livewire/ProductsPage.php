<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Products - TallCart')]
class ProductsPage extends Component
{
    use WithPagination;

    #[Url]
    public $selected_categories = []; 

    #[Url]
    public $selected_brands = []; 

    #[Url]
    public $featured;

    #[Url]
    public $on_sale;

    #[Url]
    public $price_range = 100000;

    #[Url]
    public $sort = 'latest';

    public function render()
    {
        $productQuery = Product::query()->where('is_active', 1);

        if(!blank($this->selected_categories)) {
            $productQuery->whereIn('category_id', $this->selected_categories);
        }

        if(!blank($this->selected_brands)) {
            $productQuery->whereIn('brand_id', $this->selected_brands);
        }

        if($this->featured) {
            $productQuery->where('is_featured', 1);
        }

        if($this->on_sale) {
            $productQuery->where('on_sale', 1);
        }

        if($this->price_range) {
            $productQuery->whereBetween('price', [0, $this->price_range]);
        }

        if($this->sort == 'latest') {
            $productQuery->latest();
        }

        if($this->sort == 'price') {
            $productQuery->orderBy('price');
        }
        
        $categories = Category::where('is_active', 1)
            ->whereNotNull('parent_id')
            ->get(['id', 'name', 'slug']);
        $brands = Brand::where('is_active', 1)
            ->whereNotNull('parent_id')
            ->get(['id', 'name', 'slug']);

        return view('livewire.products-page', [
            'products' => $productQuery->paginate(perPage: 12),
            'categories' => $categories,
            'brands' => $brands
        ]);
    }
}
