<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('My Order Detail')]
class MyOrderDetailPage extends Component
{
    public $order_id;

    public function mount($order_id)
    {
        $this->order_id = $order_id;
    }

    public function render()
    {
        $order = Order::where('id', $this->order_id)->first();

        return view('livewire.my-order-detail-page', [
            'order' => $order
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
