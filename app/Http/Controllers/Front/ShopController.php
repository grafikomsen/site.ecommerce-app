<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shop(Request $request, $categorieSlug = null, $subCategorieSlug = null){

        $categorieSelected      = '';
        $subCategorieSelected   = '';
        $brandArray             = [];

        $categories = Category::orderBy('name','ASC')->with('sub_categories')->where('status',1)->get();
        $brands     = Brand::orderBy('name','ASC')->where('status',1)->get();
        $products   = Product::where('status',1);

        // Appliquer les filters ici
        if (!empty($categorieSlug)) {
            # code...
            $categorie  = Category::where('slug',$categorieSlug)->first();
            $products   = $products->where('category_id',$categorie->id);
            $categorieSelected = $categorie->id;
        }

        if (!empty($subCategorieSlug)) {
            # code...
            $subCategorie   = Category::where('slug',$subCategorieSlug)->first();
            $products       = $products->where('sub_category_id',$subCategorie->id);
            $categorieSelected = $subCategorie->id;
        }

        if ($request->get('price_max' != '' && $request->get('price_min' != ''))) {
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
            # code...
            $products = $products->where('title','%'.$request->get('search').'%');
        }

        if ($request->get('sort') != '') {
            # code...
            if ($request->get('search') == 'latest') {
                # code...
                $products = $products->orderBy('name', 'DESC');
            } else if ($request->get('search') == 'price_asc') {
                # code...
                $products = $products->orderBy('name', 'ASC');
            } else {
                # code...
                $products = $products->orderBy('name', 'DESC');
            }
        } else {
            # code...
            $products = $products->orderBy('id', 'ASC');
        }

        $products = $products->paginate(9);
        $priceMax = (intval($request->get('price_max') == 0) ? 1000000 : $request->get('price_max'));
        $priceMin = intval($request->get('price_min'));
        $sort     = $request->get('sort');
        return view('frontend.shop', compact('categories','products','brands','categorieSelected','subCategorieSelected','brandsArray','priceMin', 'priceMax','sort'));
    }


}
