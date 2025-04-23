<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        $startTime = microtime(true);

        // --- Fetch data directly from DB ---
        $products = Product::take(3000)->get();
        // --- End Fetch ---

        $endTime = microtime(true);
        $duration = round(($endTime - $startTime) * 1000, 2); // Duration in milliseconds

        // For demonstration, pass duration to the view
        return view('products.index', [
            'products' => $products,
            'duration' => $duration,
            'source' => 'Database' // Indicate where data came from
        ]);
    }
}
