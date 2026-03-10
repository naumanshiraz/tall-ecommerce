<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('My Orders')]
class MyOrdersPage extends Component
{
    use WithPagination;

    public function render()
    {
        $my_orders = Order::where('user_id', auth()->id())->latest()->paginate(20);

        return view('livewire.my-orders-page', [
            'orders' => $my_orders
        ]);
    }

    public function getStatusColor(string $status): string
    {
        return match($status) {
            'new'        => 'bg-blue-500',
            'processing' => 'bg-yellow-500',
            'shipped'    => 'bg-green-500',
            'delivered'  => 'bg-green-700',
            'cancelled'  => 'bg-red-500',
        };
    }

    public function getPaymentStatusColor(string $status): string
    {
        return match($status) {
            'paid'    => 'bg-green-500',
            'pending' => 'bg-blue-500',
            'failed'  => 'bg-red-500',
        };
    }
}
