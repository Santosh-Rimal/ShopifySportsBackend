<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class CreateCategory extends Component
{
      use WithFileUploads;

    #[Validate('required|min:4|regex:/^[a-zA-Z\s\d]*$/|regex:/^(?![\d\s]+$).+$/|string|unique:categories,name')]
    public $category = '';
  #[validate('nullable|image|mimes:png,jpg,jpeg,jfif,gif')]
 public $photo;
   public function save()
{
    $this->validate();
    $category = Category::create([
        'name' => $this->category,
        'image' => $this->photo ? $this->photo->store('category', 'public') : null,
    ]);
    session()->flash('status', 'Category successfully Inserted.');
    return redirect('/category');
}
    public function render()
    {
        return view('livewire.admin.category.create-category');
    }
}