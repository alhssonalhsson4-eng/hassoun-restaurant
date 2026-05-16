<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\PageImage;

class PageImageController extends Controller
{
    public function index(Page $page)
    {
        $images = $page->images;

        return view('admin.pages.images', compact('page', 'images'));
    }

    public function store(Request $request, Page $page)
    {
        $imageName = null;

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('uploads/page-images'), $imageName);
        }

        PageImage::create([
            'page_id' => $page->id,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        return back();
    }

    public function edit(PageImage $image)
    {
        return view('admin.pages.edit-image', compact('image'));
    }

    public function update(Request $request, PageImage $image)
    {
        $imageName = $image->image;

        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads/page-images'), $imageName);
        }

        $image->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        return redirect()->route('pages.images', $image->page_id);
    }

    public function destroy(PageImage $image)
    {
        if ($image->image &&
            file_exists(public_path('uploads/page-images/' . $image->image))) {

            unlink(public_path('uploads/page-images/' . $image->image));
        }

        $image->delete();

        return back();
    }
}