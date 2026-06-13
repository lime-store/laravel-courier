<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        $available = Order::where('status', 'available')->latest()->get();
        $inProgress = Order::where('status', 'in_progress')->with('courier')->latest()->get();
        $archived = Order::whereIn('status', ['done', 'cancelled'])->with('courier')->latest()->get();

        return view('admin.index', compact('available', 'inProgress', 'archived'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'address_from'     => 'required|string|max:255',
            'address_to'       => 'required|string|max:255',
        ]);

        Order::create($request->only('address_from', 'address_to'));

        return redirect()->route('admin.index')->with('success', 'Заказ создан');
    }


}
