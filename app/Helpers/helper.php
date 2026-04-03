<?php

use App\Models\Category;
use App\Models\ProductImage;

function getCategories(){

    return Category::orderBy('name_fr','ASC')
            ->with('sub_categories')
            ->where('showHome','Oui')
            ->where('status','1')
            ->get();
}

function getProductImage($productId){
    return ProductImage::where('product_id',$productId)->first();
}
