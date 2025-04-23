<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CachedProductController extends Controller
{
    //
    public function index()
    {
        $startTime = microtime(true);

        // Use Redis Cache
        $products = Cache::remember('products.all', 60 * 60, function () {
            return Product::take(3000)->get();
        });

        $endTime = microtime(true);
        $duration = round(($endTime - $startTime) * 1000, 2);

        return view('products.index', [
            'products' => $products,
            'source' => Cache::has('products.all') ? 'Redis Cache' : 'Database',
            'duration' => $duration,
        ]);
    }
}
