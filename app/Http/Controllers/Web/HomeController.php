<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Banner;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::where('status',1)->get();

        $categoriesHome = Category::where('status', 1)->get();

        return view('web.home', [
            'banners' => $banners,
            'categoriesHome' => $categoriesHome
        ]);
    }
}
