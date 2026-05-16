<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryArea;
use Illuminate\Http\Request;

class DeliveryAreaController extends Controller
{
    public function index()
    {
        $areas = DeliveryArea::latest()->get();

        return view('admin.delivery.index', compact('areas'));
    }

    public function create()
    {
        return view('admin.delivery.create');
    }

    public function store(Request $request)
    {
        DeliveryArea::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('delivery-areas.index');
    }

    public function edit(DeliveryArea $delivery_area)
    {
        return view('admin.delivery.edit', compact('delivery_area'));
    }

    public function update(Request $request, DeliveryArea $delivery_area)
    {
        $delivery_area->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('delivery-areas.index');
    }

    public function destroy(DeliveryArea $delivery_area)
    {
        $delivery_area->delete();

        return redirect()->route('delivery-areas.index');
    }
}