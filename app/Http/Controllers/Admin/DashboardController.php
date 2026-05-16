<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\Order;
use App\Models\DeliveryArea;

class DashboardController extends Controller
{
    public function index()
    {
        $ordersCount = Order::count();

        $salesTotal = Order::sum('total_price');

        $itemsCount = Item::count();

        $categoriesCount = Category::count();

        $deliveryAreasCount = DeliveryArea::count();

        $latestOrders = Order::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'ordersCount',
            'salesTotal',
            'itemsCount',
            'categoriesCount',
            'deliveryAreasCount',
            'latestOrders'
        ));
    }
}