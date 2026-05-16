<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class LocationController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        return view('admin.location.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::first();

        if (!$setting) {
            $setting = new Setting();
        }

        $setting->address = $request->address;
        $setting->map_url = $request->map_url;
        $setting->map_embed = $request->map_embed;

        $setting->save();

        return back()->with('success', 'تم حفظ الموقع');
    }
}