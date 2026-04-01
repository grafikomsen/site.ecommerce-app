<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Artesaos\SEOTools\Facades\SEOTools as SEO;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shop(Request $request, $categorieSlug = null, $subCategorieSlug = null){

        $categorieSelected      = '';
        $subCategorieSelected   = '';
        $brandsArray             = [];

        $categories = Category::orderBy('name_fr','ASC')->with('sub_categories')->where('status',1)->get();
        $brands     = Brand::orderBy('name_fr','ASC')->where('status',1)->get();
        $products   = Product::where('status',1);

        // Appliquer les filters ici
        if (!empty($categorieSlug)) {
            $categorie  = Category::where('slug', $categorieSlug)->first();
            if ($categorie) {
                $products = $products->where('category_id', $categorie->id);
                $categorieSelected = $categorie->id;
            }
        }

        if (!empty($subCategorieSlug)) {
            $subCategorie = SubCategory::where('slug', $subCategorieSlug)->first();
            if ($subCategorie) {
                $products = $products->where('sub_category_id', $subCategorie->id);
                $subCategorieSelected = $subCategorie->id;
            }
        }

        if ($request->get('price_max') != '' && $request->get('price_min') != '') {
            # code...
            if ($request->get('price_max') == 999999) {
                # code...
                $products = $products->whereBetween('price',[intval($request->get('price_min')),999999]);
            } else {
                # code...
                $products = $products->whereBetween('price',[intval($request->get('price_min')),intval($request->get('price_max'))]);
            }
        }

        if (!empty($request->get('brand'))) {
            # code...
            $brandArray = explode(',',$request->get('brand'));
            $products   = $products->whereIn('brand_id',$brandArray);
        }

        if (!empty($request->get('search'))) {
            $products = $products->where(function ($query) use ($request) {
                $query->where('title_fr','like','%'.$request->get('search').'%')
                      ->orWhere('title_en','like','%'.$request->get('search').'%');
            });
        }

        if ($request->get('sort') != '') {
            if ($request->get('sort') == 'latest') {
                $products = $products->orderBy('created_at', 'DESC');
            } else if ($request->get('sort') == 'price_asc') {
                $products = $products->orderBy('price', 'ASC');
            } else if ($request->get('sort') == 'price_desc') {
                $products = $products->orderBy('price', 'DESC');
            } else {
                $products = $products->orderBy('created_at', 'DESC');
            }
        } else {
            $products = $products->orderBy('id', 'ASC');
        }

        $products = $products->paginate(9);
        $priceMax = (intval($request->get('price_max') == 0) ? 1000000 : $request->get('price_max'));
        $priceMin = intval($request->get('price_min'));
        $sort     = $request->get('sort');

        $pageTitle = config('app.name', 'eshop');
        $pageDescription = 'Parcourez notre boutique pour trouver les meilleurs produits disponibles.';
        $keywords = explode(',', env('SEO_DEFAULT_KEYWORDS', 'ecommerce,shopping,produits,eshop'));

        if (!empty($subCategorieSlug) && isset($subCategorie)) {
            $pageTitle = $subCategorie->meta_title_fr ?: $subCategorie->name_fr;
            $pageDescription = $subCategorie->meta_description_fr ?: $pageDescription;
            $keywords = $subCategorie->meta_keywords_fr ? explode(',', $subCategorie->meta_keywords_fr) : $keywords;
        } elseif (!empty($categorieSlug) && isset($categorie)) {
            $pageTitle = $categorie->meta_title_fr ?: $categorie->name_fr;
            $pageDescription = $categorie->meta_description_fr ?: $pageDescription;
            $keywords = $categorie->meta_keywords_fr ? explode(',', $categorie->meta_keywords_fr) : $keywords;
        }

        SEO::setTitle($pageTitle);
        SEO::setDescription($pageDescription);
        SEO::setCanonical(url()->full());
        SEO::metatags()->setKeywords($keywords);
        SEO::opengraph()->setUrl(url()->full());
        SEO::opengraph()->setTitle($pageTitle);
        SEO::opengraph()->setDescription($pageDescription);

        $sort     = $request->get('sort');
        return view('frontend.shop', compact('categories','products','brands','categorieSelected','subCategorieSelected','brandsArray','priceMin', 'priceMax','sort'));
    }

    public function product($slug)
    {
        $product = Product::where('slug',$slug)->with('product_images')->first();
        if ($product == null) {
            abort(404);
        }

        $pageTitle = $product->meta_title_fr ?: $product->title;
        $pageDescription = $product->meta_description_fr ?: $product->short_description;
        $keywords = $product->meta_keywords_fr ? explode(',', $product->meta_keywords_fr) : explode(',', env('SEO_DEFAULT_KEYWORDS', 'ecommerce,shopping,produits,eshop'));

        SEO::setTitle($pageTitle);
        SEO::setDescription($pageDescription);
        SEO::setCanonical(url()->full());
        SEO::metatags()->setKeywords($keywords);
        SEO::opengraph()->setUrl(url()->full());
        SEO::opengraph()->setTitle($pageTitle);
        SEO::opengraph()->setDescription($pageDescription);

        if ($product->product_images->isNotEmpty()) {
            $imageUrl = $product->product_images->first()->image_large_url ?? $product->product_images->first()->image_url;
            if ($imageUrl) {
                SEO::addImages([$imageUrl]);
            }
        }

        $relatedProducts = [];
        if ($product->related_products) {
            $productArray = explode(',',$product->related_products);
            $relatedProducts = Product::whereIn('id',$productArray)->where('status',1)->get();
        }

        return view('frontend.product', compact('product','relatedProducts'));
    }
}
