<?php

namespace App\Livewire\Admin\Category;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class Categories extends Component
{

public $id;
    use WithPagination;
    public function render()
    {
        $categories=Category::simplePaginate(4);
       
        return view('livewire.admin.category.categories',compact('categories'));
    }





     public function delete($id)
    {
        $category = Category::findOrFail($id);
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