<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        // Obtener ofertas con paginación
        $offers = Product::where('is_on_sale', true)
            ->with('brand', 'category', 'subcategory')
            ->where('sale_start', '<=', now())
            ->where('sale_end', '>=', now())
            ->where('sale_price', '!=', null)
            ->where('is_featured', true)
            ->paginate($perPage);

        // Obtener productos para banners
        $products_banners = Product::where('is_on_sale', true)
            ->with('brand', 'category', 'subcategory')
            ->where('sale_start', '<=', now())
            ->where('sale_end', '>=', now())
            ->where('sale_price', '!=', null)
            ->where('is_featured', true)
            ->where('on_slider', true)
            ->get();

        $products = Product::where('is_featured', true)
            ->with('brand', 'category', 'subcategory')
            ->get();

        return view('frontend.home')
        ->with('offers', $offers)
        ->with('products_banners', $products_banners)
        ->with('products', $products);
    }
}
