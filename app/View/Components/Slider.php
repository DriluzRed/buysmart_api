<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Product;
use App\Models\CustomBanner;

class Slider extends Component
{
    public $banners;

    public function __construct()
    {
        $productBanners = Product::getAllBanners();
        $customBanners = CustomBanner::getAllBanners();

        // Combinar los resultados
        $productBanners = $productBanners ?? collect();
        $customBanners = $customBanners ?? collect();

        $banners = $productBanners->merge($customBanners);

        $this->banners = $banners;

    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.slider');
    }
}
