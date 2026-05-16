<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        if (!$setting) {
            $setting = Setting::create([]);
        }

        return view('admin.settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::first();

        if (!$setting) {
            $setting = Setting::create([]);
        }

        $heroImage = $setting->hero_image;

        if ($request->hasFile('hero_image')) {
            $image = $request->file('hero_image');
            $heroImage = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/settings'), $heroImage);
        }

        $setting->update([
            'restaurant_name_ar' => $request->restaurant_name_ar,
            'restaurant_name_en' => $request->restaurant_name_en,
            'slogan_ar' => $request->slogan_ar,
            'slogan_en' => $request->slogan_en,
            'order_whatsapp' => $request->order_whatsapp,
            'rating_whatsapp' => $request->rating_whatsapp,
            'address' => $request->address,
            'map_url' => $request->map_url,
            'hero_image' => $heroImage,
            'theme_color' => $request->theme_color,
            'button_color' => $request->button_color,
            'background_color' => $request->background_color,
            'text_color' => $request->text_color,
        ]);

        return redirect()->route('settings.index');
    }

    public function location()
    {
        $setting = Setting::first();

        if (!$setting) {
            $setting = Setting::create([]);
        }

        return view('admin.location.index', compact('setting'));
    }

    public function updateLocation(Request $request)
    {
        $setting = Setting::first();

        if (!$setting) {
            $setting = Setting::create([]);
        }

        $setting->update([
            'address' => $request->address,
            'map_url' => $request->map_url,
        ]);

        return redirect()->route('location.index');
    }

    public function aiAssistant()
    {
        $setting = Setting::first();

        if (!$setting) {
            $setting = Setting::create([]);
        }

        return view('admin.ai.index', compact('setting'));
    }

    public function updateAiAssistant(Request $request)
    {
        $setting = Setting::first();

        if (!$setting) {
            $setting = Setting::create([]);
        }

        $setting->update([
            'ai_context' => $request->ai_context,
        ]);

        return redirect()->route('ai.assistant');
    }

    public function printer()
    {
        $setting = Setting::first();

        if (!$setting) {
            $setting = Setting::create([]);
        }

        return view('admin.printer.index', compact('setting'));
    }

    public function updatePrinter(Request $request)
    {
        $setting = Setting::first();

        if (!$setting) {
            $setting = Setting::create([]);
        }

        $setting->update([
            'printer_ip' => $request->printer_ip,
            'printer_port' => $request->printer_port ?? '9100',
        ]);

        return redirect()->route('printer.index');
    }
}