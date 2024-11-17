<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Products extends Component
{
    use WithPagination;
    public function render()
    {
        $products=Product::simplePaginate(10);
        return view('livewire.admin.product.products',compact('products'));
    }


    public function delete($id)
    {
        
           $category = Product::findOrFail($id);
        $this->authorize('delete', $category);
        if($category->image){
            $path=public_path('storage/').$category->image;
            if(file_exists($path)){
                @unlink($path);
            }
        }
        $category->delete();
        session()->flash('delete', 'Category Deleted Successfully.');
    }
    
}