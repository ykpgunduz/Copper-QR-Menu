<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getDetails($id)
    {
        $product = Product::findOrFail($id);
        return view('partials.product-details', compact('product'));
    }
}
