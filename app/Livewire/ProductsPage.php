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

    public $selected_brands = []; 

    public function render()
    {
        $productQuery = Product::query()->where('is_active', 1);

        if(!blank($this->selected_categories)) {
            $productQuery->whereIn('category_id', $this->selected_categories);
        }

        if(!blank($this->selected_brands)) {
            $productQuery->whereIn('brand_id', $this->selected_brands);
        }
        
        $categories = Category::where('is_active', 1)->get(['id', 'name', 'slug']);
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
