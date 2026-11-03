<?php

namespace App\Support;

use App\Models\Product;

class ProductPresenter
{
    /**
     * Normalised product payload shared by the landing carousel and the catalog.
     *
     * @return array<string, mixed>
     */
    public static function toArray(Product $product): array
    {
        return [
            'id' => $product->id,
            'code' => $product->product_code,
            'title' => $product->name,
            'image' => $product->image_path ? asset($product->image_path) : null,
            'species' => $product->species?->name,
            'location' => $product->origin_region ?: $product->origin_country,
            'dimensions' => self::dimensions($product),
            'volume' => (float) $product->available_volume_m3,
            'moisture_min' => $product->moisture_content_min !== null ? (float) $product->moisture_content_min : null,
            'moisture_max' => $product->moisture_content_max !== null ? (float) $product->moisture_content_max : null,
            'price' => $product->price_per_m3 !== null ? (float) $product->price_per_m3 : null,
            'min_order' => $product->min_order_m3 !== null ? (float) $product->min_order_m3 : null,
            'grade' => $product->grade,
            'custom' => (bool) $product->is_custom_order,
            'description' => $product->description,
        ];
    }

    /**
     * Human readable dimension label, e.g. "25 × 150 mm" or "Dia 400 mm".
     */
    public static function dimensions(Product $product): ?string
    {
        $thickness = $product->thickness_mm;
        $width = $product->width_mm;

        if ($thickness === null && $width === null) {
            return null;
        }

        $thicknessLabel = self::trim((float) $thickness);

        if (strcasecmp((string) $product->surface, 'round') === 0) {
            return 'Dia '.$thicknessLabel.' mm';
        }

        if ($width === null) {
            return $thicknessLabel.' mm';
        }

        return $thicknessLabel.' × '.self::trim((float) $width).' mm';
    }

    private static function trim(float $value): string
    {
        return rtrim(rtrim(number_format($value, 2, '.', ''), '0'), '.');
    }
}
