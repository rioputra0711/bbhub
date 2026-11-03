<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $products = Product::query()
            ->active()
            ->with('species')
            ->orderBy('product_code')
            ->get()
            ->map(fn (Product $product) => [
                'id' => $product->id,
                'code' => $product->product_code,
                'title' => $product->name,
                'image' => $product->image_path ? asset($product->image_path) : null,
                'species' => $product->species?->name,
                'location' => $product->origin_region ?: $product->origin_country,
                'dimensions' => $this->dimensions($product),
                'volume' => (float) $product->available_volume_m3,
                'moisture_min' => $product->moisture_content_min !== null ? (float) $product->moisture_content_min : null,
                'moisture_max' => $product->moisture_content_max !== null ? (float) $product->moisture_content_max : null,
                'price' => $product->price_per_m3 !== null ? (float) $product->price_per_m3 : null,
                'grade' => $product->grade,
                'custom' => (bool) $product->is_custom_order,
            ])
            ->all();

        return view('index', [
            'products' => $products,
        ]);
    }

    private function dimensions(Product $product): ?string
    {
        $thickness = $product->thickness_mm;
        $width = $product->width_mm;

        if ($thickness === null && $width === null) {
            return null;
        }

        $thicknessLabel = rtrim(rtrim(number_format((float) $thickness, 2, '.', ''), '0'), '.');

        if (strcasecmp((string) $product->surface, 'round') === 0) {
            return 'Dia '.$thicknessLabel.' mm';
        }

        if ($width === null) {
            return $thicknessLabel.' mm';
        }

        $widthLabel = rtrim(rtrim(number_format((float) $width, 2, '.', ''), '0'), '.');

        return $thicknessLabel.' × '.$widthLabel.' mm';
    }
}
