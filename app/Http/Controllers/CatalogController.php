<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function index(Request $request): View
    {
        $products = Product::query()
            ->active()
            ->with('category')
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->string('q')->toString().'%');
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereHas('category', fn ($category) => $category
                    ->where('slug', $request->string('category')->toString()));
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('catalog.index', [
            'products' => $products,
            'categories' => Category::query()->where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function show(Product $product): View
    {
        $this->authorize('view', $product);

        return view('catalog.show', [
            'product' => $product->load('category'),
        ]);
    }
}
