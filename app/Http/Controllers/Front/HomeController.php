<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Artesaos\SEOTools\Facades\SEOTools as SEO;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){

        SEO::setTitle(config('app.name', 'eshop'));
        SEO::setDescription('Découvrez une sélection de produits et offres exclusives sur notre boutique e-commerce.');
        SEO::setCanonical(route('home'));
        SEO::metatags()->setKeywords(explode(',', env('SEO_DEFAULT_KEYWORDS', 'ecommerce,shopping,produits,eshop')));
        SEO::opengraph()->setUrl(route('home'));
        SEO::opengraph()->setTitle(config('app.name', 'eshop'));
        SEO::opengraph()->setDescription('Découvrez une sélection de produits et offres exclusives sur notre boutique e-commerce.');

        $prodFeatured   = Product::where('is_featured','Yes')->where('status','1')->get();
        $latestFeatured = Product::orderBy('id','ASC')->where('status','1')->take(8)->get();

        return view('frontend.home', compact('prodFeatured','latestFeatured'));
    }
}
