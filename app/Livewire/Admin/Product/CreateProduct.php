<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;

class CreateProduct extends Component
{
use WithFileUploads;
    #[validate('required|string|regex:/^[a-zA-Z\s\d]*$/|regex:/^(?![\d\s]+$).+$/|max:255|min:4')]
public $name;

    #[validate('string|regex:/^[a-zA-Z\s\d]*$/|regex:/^(?![\d\s]+$).+$/|max:500')]
    public $description;
    #[validate('required|numeric|min:100|max:100000')]
    public $price;
    #[validate('required|image|mimes:png,jpg,jpeg,jfif,gif')]
    public $image;
    #[validate('required')]
    public $category_id;

    #[validate('nullable|integer')]
    public $discount;

     #[validate('nullable|date|after_or_equal:today')]
    public $discount_start_date;

     #[validate('nullable|date|after_or_equal:discount_start_date')]
    public $discount_end_date;
    public function render()
    {
        $categories = Category::get();
        return view('livewire.admin.product.create-product', compact('categories'));
    }

    public function save()
    {
        // Validate the input
        $validatedData = $this->validate();

        if ($this->image) {
            // Store the image and get the path
            $validatedData['image'] = $this->image->store('products', 'public');
        }

        // Save the product data
        Product::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'image' => $validatedData['image'] ?? null,
            'category_id' => $validatedData['category_id'],
            'discount'=> $validatedData['discount'],
            'discount_start_date'=> $validatedData['discount_start_date'],
            'discount_end_date'=> $validatedData['discount_end_date'],
        ]);

        session()->flash('status', 'Product successfully created.');

        // Redirect or reset form
        $this->reset();
    }
}