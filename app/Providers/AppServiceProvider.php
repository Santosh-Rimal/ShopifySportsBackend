<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Service;
use App\Models\Category;
use App\Models\OrderItem;
use Illuminate\Support\Carbon;
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
    $sale = Order::where('status', 'COMPLETE')->count();
    View::share('sale', $sale);


    $order = Order::count();
    View::share('order', $order);


    $totalRevenue = Order::where('status', 'COMPLETE')->sum('total');
    // dd($totalRevenue);

    // Share the total revenue with all views
    View::share('totalRevenue', $totalRevenue);
    

     $authenticatedUserId = Auth::id();

    // Count total users excluding the currently authenticated user and admins
    $totalUsersExcludingAuthAndAdmins = User::where('id', '!=', $authenticatedUserId)
                                            ->where('role', '!=', 'admin')
                                            ->count();

    // Share the total number of users excluding the authenticated user and admins
    View::share('totalUsersExcludingAuthAndAdmins', $totalUsersExcludingAuthAndAdmins);












    //  For cart start
    $dailyRevenue = Order::where('status', 'COMPLETE')
                          ->whereDate('created_at', Carbon::today())
                          ->sum('total');

    $weeklyRevenue = Order::where('status', 'COMPLETE')
                          ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                          ->sum('total');

    $monthlyRevenue = Order::where('status', 'COMPLETE')
                           ->whereMonth('created_at', Carbon::now()->month)
                           ->sum('total');



    View::share('dailyRevenue', $dailyRevenue);
    View::share('weeklyRevenue', $weeklyRevenue);
    View::share('monthlyRevenue', $monthlyRevenue);



    // Chart end



    $orders = Order::with(['orderItems.product.category'])
                  ->where('status', 'COMPLETE')
                  ->whereDate('created_at', Carbon::today())
                  ->get();
// dd($orders);
                   View::share('orders', $orders);







        $completedOrders = Order::where('status', 'COMPLETE')->count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $failedOrders = Order::where('status', 'failed')->count();
        $canceledOrders = Order::where('status', 'canceled')->count();


        view()->share([
            'completedOrders' => $completedOrders,
            'pendingOrders' => $pendingOrders,
            'failedOrders' => $failedOrders,
            'canceledOrders' => $canceledOrders
        ]);
}














    protected $policies = [
    Catesgory::class => CategoryPolicy::class,
    Contact::class => ContactPolicy::class,
    Product::class => ProductPolicy::class,
    Service::class => ServicePolicy::class,
];


}