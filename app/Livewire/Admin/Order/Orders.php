<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;

    public function render()
    {
        $orders = Order::with('user')->latest()->paginate(10); // Adjust the number as needed
        return view('livewire.admin.order.orders', compact('orders'));
    }
}