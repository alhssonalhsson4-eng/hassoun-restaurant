<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('category')
            ->latest()
            ->get();

        return view('admin.items.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('uploads/items'), $imageName);
        }

        Item::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imageName,
        ]);

        return redirect()->route('items.index');
    }

    public function edit(Item $item)
    {
        $categories = Category::all();

        return view('admin.items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, Item $item)
    {
        $imageName = $item->image;

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('uploads/items'), $imageName);
        }

        $item->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imageName,
        ]);

        return redirect()->route('items.index');
    }

    public function destroy(Item $item)
    {
        if ($item->image && file_exists(public_path('uploads/items/' . $item->image))) {
            unlink(public_path('uploads/items/' . $item->image));
        }

        $item->delete();

        return redirect()->route('items.index');
    }
}