<?php


use App\Livewire\Admin\User\Users;
use App\Livewire\Admin\Order\Orders;
use App\Livewire\Admin\About\Aboutus;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Inquiry\Inquiry;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController; 
use App\Livewire\Admin\Product\Products;
use App\Http\Controllers\OrderController;
use App\Livewire\Admin\About\CreateAbout;
use App\Livewire\Admin\About\UpdateAbout;
use App\Http\Controllers\ProductController;
use App\Livewire\Admin\Category\Categories;
use App\Livewire\Admin\Product\CreateProduct;
use App\Livewire\Admin\Product\UpdateProduct;
use App\Livewire\Admin\Service\CreateService;
use App\Livewire\Admin\Category\CreateCategory;
use App\Livewire\Admin\Category\UpdateCategory;


Route::view('dashboard','admin.index')
    ->middleware(['auth', 'verified','IsAdmin'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    Route::get('/logout', function () {
    session()->flush();
    return redirect('/');
})->name('logout');



Route::get('/', [ShopController::class, 'index']) ->middleware(['auth', 'verified','IsAdmin'])->name('shop');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');


Route::post('/cart/add', [CartController::class, 'add'])->middleware(['auth'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->middleware(['auth'])->name('cart.index');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->middleware(['auth'])->name('cart.remove');


Route::get('/my-orders', [OrderController::class, 'showUserOrders'])->middleware(['auth'])->name('orders.user');

Route::get('/checkout', [OrderController::class, 'showCheckoutForm'])->middleware(['auth'])->name('checkout');
Route::post('/checkout', [OrderController::class, 'placeOrder'])->middleware(['auth'])->name('orders.place');
Route::get('/order-complete', [OrderController::class, 'orderComplete'])->middleware(['auth'])->name('checkout.complete');


Route::get('/orders/{order}', [OrderController::class, 'showOrderDetails'])->middleware(['auth'])->name('orders.show');

    Route::get('/category',Categories::class)->middleware(['auth', 'verified','IsAdmin'])->name('category');
    Route::get('/category/create',CreateCategory::class)->middleware(['auth', 'verified','IsAdmin'])->name('category.create');
    Route::get('/category/update/{id}',UpdateCategory::class)->middleware(['auth', 'verified','IsAdmin'])->name('category.update');
    Route::get('/about',Aboutus::class)->middleware(['auth', 'verified','IsAdmin'])->name('about');
    Route::get('/about/create',CreateAbout::class)->middleware(['auth', 'verified','IsAdmin'])->name('about.create');
    Route::get('/about/update/{id}',UpdateAbout::class)->middleware(['auth', 'verified','IsAdmin'])->name('about.update');
    Route::get('/contacts',Inquiry::class)->middleware(['auth', 'verified','IsAdmin'])->name('contacts');
    Route::get('/product',Products::class)->middleware(['auth', 'verified','IsAdmin'])->name('products');
    Route::get('/product/create',CreateProduct::class)->middleware(['auth', 'verified','IsAdmin'])->name('products.create');
    Route::get('/product/edit/{id}',UpdateProduct::class)->middleware(['auth', 'verified','IsAdmin'])->name('products.edit');
    Route::get('/orders',Orders::class)->middleware(['auth', 'verified','IsAdmin'])->name('orders');
    Route::get('/users',Users::class)->middleware(['auth', 'verified','IsAdmin'])->name('users');
    
    // Route::get('/service',Service::class)->middleware(['auth', 'verified','IsAdmin'])->name('services');
    // // Route::get('/service/create',CreateService::class)->middleware(['auth', 'verified','IsAdmin'])->name('services.create');
    // // Route::get('/service/update',UpdateService::class)->middleware(['auth', 'verified','IsAdmin'])->name('services.update');

Route::get('ckeditor5',function(){
    return view('welcome');
});
    

require __DIR__.'/auth.php';