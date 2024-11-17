<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
  public function index()
    {
        // Fetch featured products (e.g., latest or on sale)
        $featuredProducts = Product::latest()->take(8)->get(); // Adjust query as needed

        // Fetch all categories
        $categories = Category::all(); // Adjust query if you need specific categories

        // Pass data to the view
        return view('admin.index');
    }
}