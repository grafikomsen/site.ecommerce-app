<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){

        $prodFeatured   = Product::where('is_featured','Yes')->where('status','1')->get();
        $latestFeatured = Product::orderBy('id','ASC')->where('status','1')->take(8)->get();

        return view('frontend.home', compact('prodFeatured','latestFeatured'));
    }
}
