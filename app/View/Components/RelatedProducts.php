<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Product;

class RelatedProducts extends Component
{
    /**
     * Create a new component instance.
     */
    public $relatedProducts;
    
    public function __construct()
    {
        $this->relatedProducts = Product::inRandomOrder()->limit(4)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.related-products');
    }
}
