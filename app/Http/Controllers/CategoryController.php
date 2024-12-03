<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Request $request, $slug)
    {
            $category = Category::where('slug', $slug)->with('subcategories')->firstOrFail();
            // Obtener los productos de la categoría
            if(!$category) {
               abort(404);
            }try {

            $query = Product::query();
            $query->where('category_id', $category->id);

            // Aplicar filtros
            if ($request->filled('search')) {
                $query->where('name', 'like', '%' . $request->search . '%');
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

            // Obtener los productos filtrados
            $products = $query->paginate(10);
            
            return view('frontend.categories.show', compact('category', 'products'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al cargar los productos de esta categoría');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }

    public function getCategories()
    {
        try {
            $categories = Category::with('subcategories')->get();

            return response()->json($categories, 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al cargar los datos',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
