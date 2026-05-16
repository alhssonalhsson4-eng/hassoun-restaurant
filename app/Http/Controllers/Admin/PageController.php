<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::with('images')->latest()->get();

        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        Page::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
        ]);

        return redirect()->route('pages.index');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $page->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
        ]);

        return redirect()->route('pages.index');
    }

    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()->route('pages.index');
    }
}