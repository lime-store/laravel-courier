<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $available = Order::where('status', 'available')->latest()->get();

        $myOrders = Order::where('courier_id', auth()->id())
                           ->where('status', 'in_progress')
                           ->latest()->get();

        return view('courier.index', compact('available', 'myOrders'));                           
    }

    public function take(Order $order)
    {
        abort_if($order->status !== 'available', 403, 'Заказ уже взят');

        $order->update([
            'status'        => 'in_progress',
            'courier_id'    => auth()->id(), 
        ]);

        return back()->with('success', 'Заказ взят!');
    }

    public function updateStatus(Request $request, Order $order)
    {
        abort_if($order->courier_id !== auth()->id(), 403, 'Это не ваш заказ!');

        $request->validate([
            'status' => 'required|in:done, cancelled',
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Статус обновлен');
    }   
}
