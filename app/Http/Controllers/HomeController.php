<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\DeliveryArea;
use App\Models\Item;
use App\Models\Order;
use App\Models\Page;
use App\Models\RatingCategory;
use App\Models\Setting;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

class HomeController extends Controller
{
    private function siteData()
    {
        return [
            'categories' => Category::with('items')->get(),
            'deliveryAreas' => DeliveryArea::all(),
            'setting' => Setting::first(),
            'aboutPages' => Page::with('images')->get(),
            'ratingCategories' => RatingCategory::with('options')->get(),
        ];
    }

    public function index()
    {
        return view('home', $this->siteData());
    }

    public function about()
    {
        return view('pages.about', $this->siteData());
    }

    public function ratingsPage()
    {
        return view('pages.ratings', $this->siteData());
    }

    public function locationPage()
    {
        return view('pages.location', $this->siteData());
    }

    public function menuPage()
    {
        return view('pages.menu', $this->siteData());
    }

    public function aiSearch(Request $request)
    {
        $q = mb_strtolower(trim($request->message ?? ''));

        if (!$q) {
            return response()->json([
                'answer' => 'اكتب سؤالك حتى أساعدك 🌟',
            ]);
        }

        $results = [];

        $items = Item::with('category')->get();

        foreach ($items as $item) {
            $name = mb_strtolower($item->name ?? '');
            $desc = mb_strtolower($item->description ?? '');
            $cat  = mb_strtolower($item->category->name ?? '');

            if (
                str_contains($name, $q) ||
                str_contains($q, $name) ||
                str_contains($desc, $q) ||
                str_contains($cat, $q)
            ) {
                $results[] =
                    '🍽️ الأكلة: ' . $item->name .
                    '<br>📂 القسم: ' . ($item->category->name ?? '-') .
                    '<br>💰 السعر: ' . number_format($item->price) . ' د.ع' .
                    '<br>📝 الوصف: ' . ($item->description ?? '-');
            }
        }

        if (str_contains($q, 'توصيل')) {
            foreach (DeliveryArea::all() as $area) {
                $results[] =
                    '🚚 ' . $area->name .
                    ' : ' . number_format($area->price) . ' د.ع';
            }
        }

        if (
            str_contains($q, 'عنوان') ||
            str_contains($q, 'موقع') ||
            str_contains($q, 'وين')
        ) {
            $setting = Setting::first();

            $results[] =
                '📍 العنوان: ' . ($setting->address ?? 'غير مضاف');
        }

        if (
            str_contains($q, 'منيو') ||
            str_contains($q, 'اكل') ||
            str_contains($q, 'أكل') ||
            str_contains($q, 'وجبات')
        ) {
            foreach (Category::with('items')->get() as $category) {
                $results[] =
                    '📂 قسم: ' . $category->name .
                    ' - عدد الأكلات: ' . $category->items->count();
            }
        }

        if (empty($results)) {
            return response()->json([
                'answer' => 'ما لقيت جواب 😅 جرب اسم أكلة مثل: قوزي، بيتزا، بركر أو اسأل عن التوصيل والموقع',
            ]);
        }

        return response()->json([
            'answer' => implode('<br><br>', array_slice(array_unique($results), 0, 12)),
        ]);
    }

    public function saveOrder(Request $request)
    {
        $order = Order::create([
            'customer_name' => $request->customer_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'notes' => $request->notes,
            'items' => $request->items,
            'delivery_area' => $request->delivery_area,
            'delivery_price' => $request->delivery_price,
            'items_total' => $request->items_total,
            'total_price' => $request->total_price,
        ]);

        try {
            $this->printOrder($request, $order->id);
        } catch (\Throwable $e) {
            \Log::error('Print Failed: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'order_id' => $order->id,
        ]);
    }

    private function printOrder(Request $request, $orderId)
    {
        $setting = Setting::first();

        $printerIp = $setting->printer_ip ?? '192.168.3.110';
        $printerPort = (int) ($setting->printer_port ?? 9100);

        $connector = new NetworkPrintConnector($printerIp, $printerPort);
        $printer = new Printer($connector);

        $printer->initialize();

        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->setEmphasis(true);
        $printer->text("AL HASSOUN RESTAURANT\n");
        $printer->setEmphasis(false);
        $printer->text("NEW ORDER\n");
        $printer->text("================================\n");
        $printer->text("ORDER #{$orderId}\n");
        $printer->text("================================\n\n");

        $printer->setJustification(Printer::JUSTIFY_LEFT);

        $printer->text("Name: {$request->customer_name}\n");
        $printer->text("Phone: {$request->phone}\n");
        $printer->text("Area: {$request->delivery_area}\n");
        $printer->text("Address: {$request->address}\n");

        $printer->text("--------------------------------\n");
        $printer->text("ITEMS:\n\n");
        $printer->text($request->items . "\n");
        $printer->text("--------------------------------\n");

        $printer->text("Items Total: {$request->items_total} IQD\n");
        $printer->text("Delivery: {$request->delivery_price} IQD\n");

        $printer->setEmphasis(true);
        $printer->text("TOTAL: {$request->total_price} IQD\n");
        $printer->setEmphasis(false);

        if ($request->notes) {
            $printer->text("--------------------------------\n");
            $printer->text("Notes:\n{$request->notes}\n");
        }

        $printer->text("================================\n");

        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("THANK YOU\n");

        $printer->feed(4);
        $printer->cut();
        $printer->close();
    }
}