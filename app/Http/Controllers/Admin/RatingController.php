<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RatingCategory;
use App\Models\RatingOption;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index()
    {
        $categories = RatingCategory::with('options')->get();

        return view('admin.ratings.index', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        RatingCategory::create([
            'name' => $request->name,
            'icon' => $request->icon,
        ]);

        return back();
    }

    public function storeOption(Request $request)
    {
        RatingOption::create([
            'rating_category_id' => $request->rating_category_id,
            'name' => $request->name,
        ]);

        return back();
    }

    public function destroyCategory(RatingCategory $category)
    {
        $category->delete();

        return back();
    }

    public function destroyOption(RatingOption $option)
    {
        $option->delete();

        return back();
    }
}