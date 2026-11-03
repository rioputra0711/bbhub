<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Support\ProductPresenter;
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
            ->map(fn (Product $product) => ProductPresenter::toArray($product))
            ->all();

        return view('index', [
            'products' => $products,
        ]);
    }
}
