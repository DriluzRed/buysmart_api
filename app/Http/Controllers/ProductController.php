<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();

        try{
            $query = Product::query();

            if ($request->filled('search')) {
                $query->where('name', 'like', '%' . $request->search . '%');
            }
    
            if ($request->filled('category')) {
                $query->where('category_id', $request->category);
            }
    
            if ($request->filled('subcategory')) {
                $query->where('sub_category_id', $request->subcategory);
            }
    
            if ($request->filled('min_price')) {
                $query->where('price', '>=', $request->min_price);
            }
    
            if ($request->filled('max_price')) {
                $query->where('price', '<=', $request->max_price);
            }
    
            if($request->filled('is_new')) {
                $query->where('is_new', 1);
            }
    
            if($request->filled('on_sale')) {
                $query->where('is_on_sale', 1);
            }
    
            $products = $query->paginate(10);
    
            return view('frontend.products.index', compact('products', 'categories', 'subcategories'));
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Error al cargar los productos');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
   
        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            abort(404);
        }
        try {
            $images = [];
            $images[] = $product->main_image;
            if ($product->productImages) {
                foreach ($product->productImages as $image) {
                    $images[] = $image->image;
                }
            }
            return view('frontend.products.show', compact('product', 'images'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al cargar el producto');
        }
            

        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    public function searchProducts(Request $request)
    {
        $query = '';
        if ($request->has('q')) {
            $query = $request->q;
        }
        $products = Product::where('name', 'like', "%$query%")->get();
        return view('components.search-products', compact('products'));
    }

}
