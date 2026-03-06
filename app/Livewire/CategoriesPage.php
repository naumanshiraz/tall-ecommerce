<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Categories - TallCart')]
class CategoriesPage extends Component
{
    public $categoryId;

    public function mount($id = null)
    {
        $this->categoryId = $id;
    }

    public function render()
    {
        $categories = Category::withCount('children')
            ->where('is_active', 1);

        if ($this->categoryId) {
            $categories->where('parent_id', $this->categoryId);
        } else { 
            $categories->whereNull('parent_id');
        }

        return view('livewire.categories-page', [
            'categories' => $categories->get()
        ]);
    }
}