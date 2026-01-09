<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\TempImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    public function subCategorie(Request $request){

        $subCategories = SubCategory::select('sub_categories.*','categories.name as categoryName')
                        ->latest('sub_categories.id')
                        ->leftJoin('categories','categories.id','sub_categories.category_id');
        if (!empty($request->get('keyword'))) {
            # code...
            $subCategories = $subCategories->where('sub_categories.name','like','%'. $request->get('keyword') .'%');
            $subCategories = $subCategories->orWhere('categories.name','like','%'. $request->get('keyword') .'%');
        }

        $subCategories = $subCategories->paginate(8);
        Session::put('page','subCategorie');
        return view('admin.subcategories.subcategorie', compact('subCategories'));
    }

    public function create(){

        $categories = Category::orderBy('name','ASC')->get();
        return view('admin.subcategories.create', compact('categories'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name'          => 'required',
            'slug'          => 'required|unique:sub_categories',
            'category'      => 'required',
            'status'        => 'required'
        ]);

        if ($validator->passes()) {
            # code...
            $subCategory = new SubCategory();
            $subCategory->name          = $request->name;
            $subCategory->slug          = $request->slug;
            $subCategory->category_id   = $request->category;
            $subCategory->showHome      = $request->showHome;
            $subCategory->status        = $request->status;
            $subCategory->save();

            // Sauvegardez une image
            if (!empty($request->image_id)) {
                # code...
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.',$tempImage->name);
                $ext = last($extArray);

                $newImageName = $subCategory->id.'-'.time().'.'.$ext;
                $sPath = public_path().'/temp/'.$tempImage->name;
                $dPath = public_path().'/uploads/sub-categories/'.$newImageName;
                File::copy($sPath,$dPath);

                $subCategory->image = $newImageName;
                $subCategory->save();

            }

            Session()->flash('success','Sous-catégorie ajoutée avec succès');
            return response()->json([
                'status'    => true,
                'message'   => 'Sous-catégorie ajoutée avec succès',
            ]);

        } else {
            # code...
            return response()->json([
                'status'    => false,
                'errors'    => $validator->errors(),
            ]);
        }
    }
}
