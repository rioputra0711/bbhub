<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Support\ProductPresenter;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Catalog page with server-side filtering, sorting, and pagination.
     */
    public function index(Request $request): View
    {
        $filters = [
            'q' => trim((string) $request->query('q', '')),
            'species' => array_values(array_filter((array) $request->query('species', []))),
            'grade' => array_values(array_filter((array) $request->query('grade', []))),
            'price_min' => $request->query('price_min'),
            'price_max' => $request->query('price_max'),
            'in_stock' => $request->boolean('in_stock'),
            'sort' => (string) $request->query('sort', 'recommended'),
        ];

        $query = Product::query()->active()->with('species');

        if ($filters['q'] !== '') {
            $term = '%'.$filters['q'].'%';

            $query->where(function ($builder) use ($term) {
                $builder
                    ->where('name', 'like', $term)
                    ->orWhere('product_code', 'like', $term)
                    ->orWhere('grade', 'like', $term)
                    ->orWhereHas('species', fn ($species) => $species->where('name', 'like', $term));
            });
        }

        if ($filters['species'] !== []) {
            $query->whereHas('species', fn ($species) => $species->whereIn('slug', $filters['species']));
        }

        if ($filters['grade'] !== []) {
            $query->whereIn('grade', $filters['grade']);
        }

        if (is_numeric($filters['price_min'])) {
            $query->where('price_per_m3', '>=', (float) $filters['price_min']);
        }

        if (is_numeric($filters['price_max'])) {
            $query->where('price_per_m3', '<=', (float) $filters['price_max']);
        }

        if ($filters['in_stock']) {
            $query->where('available_volume_m3', '>', 0);
        }

        match ($filters['sort']) {
            'price_asc' => $query->orderBy('price_per_m3'),
            'price_desc' => $query->orderByDesc('price_per_m3'),
            'volume' => $query->orderByDesc('available_volume_m3'),
            'newest' => $query->latest('id'),
            default => $query->orderBy('product_code'),
        };

        $products = $query->paginate(9)->withQueryString();

        return view('products', [
            'products' => $products,
            'items' => collect($products->items())->map(fn (Product $product) => ProductPresenter::toArray($product))->all(),
            'filters' => $filters,
            'speciesOptions' => Product::query()
                ->active()
                ->whereHas('species')
                ->with('species')
                ->get()
                ->pluck('species.name', 'species.slug')
                ->filter()
                ->unique()
                ->sort(),
            'gradeOptions' => Product::query()
                ->active()
                ->whereNotNull('grade')
                ->distinct()
                ->orderBy('grade')
                ->pluck('grade'),
        ]);
    }
}
