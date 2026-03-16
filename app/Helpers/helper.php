<?php

use App\Models\Category;

    function getCategories(){

        return Category::orderBy('name','ASC')
                ->with('sub_categories')
                ->where('showHome','Oui')
                ->where('status','1')
                ->get();
    }
