<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Service;
use App\Models\Category;
use App\Policies\ContactPolicy;
use App\Policies\ProductPolicy;
use App\Policies\ServicePolicy;
use App\Policies\CategoryPolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
   public function boot(): void
{
    // Count the orders that do not have the status 'pending'
    $orderCount = Order::where('status', '!=', 'pending')->count();
    View::share('orderCount', $orderCount);


    $order = Order::count();
    View::share('order', $order);


    $totalRevenue = Order::where('status', 'completed')->sum('total');
    // Share the total revenue with all views
    View::share('totalRevenue', $totalRevenue);


     $authenticatedUserId = Auth::id();

    // Count total users excluding the currently authenticated user and admins
    $totalUsersExcludingAuthAndAdmins = User::where('id', '!=', $authenticatedUserId)
                                            ->where('role', '!=', 'admin')
                                            ->count();

    // Share the total number of users excluding the authenticated user and admins
    View::share('totalUsersExcludingAuthAndAdmins', $totalUsersExcludingAuthAndAdmins);
}

    protected $policies = [
    Catesgory::class => CategoryPolicy::class,
    Contact::class => ContactPolicy::class,
    Product::class => ProductPolicy::class,
    Service::class => ServicePolicy::class,
];
}