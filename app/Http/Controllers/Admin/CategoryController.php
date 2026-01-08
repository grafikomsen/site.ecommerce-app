<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\TempImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function categorie(Request $request){

        $categories = Category::latest();
        if (!empty($request->get('keyword'))) {
            # code...
            $categories = $categories->where('name','like','%'. $request->get('keyword') .'%');
        }

        $categories = $categories->paginate(5);
        Session::put('page','categorie');
        return view('admin.categories.service', compact('categories'));
    }

    public function create(){
        return view('admin.categories.create');
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'name'  => 'required',
            'slug'  => 'required|unique:categories'
        ]);

        if ($validator->passes()) {
            # code...
            $category = new Category();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->showHome = $request->showHome;
            $category->status = $request->status;
            $category->save();

            // Sauvegardez une image
            if (!empty($request->image_id)) {
                # code...
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.',$tempImage->name);
                $ext = last($extArray);

                $newImageName = $category->id.'-'.time().'.'.$ext;
                $sPath = public_path().'/temp/'.$tempImage->name;
                $dPath = public_path().'/uploads/categories/'.$newImageName;
                File::copy($sPath,$dPath);

                $category->image = $newImageName;
                $category->save();
            }

            $message = "Catégorie ajoutée avec succès";
            Session()->flash('success', $message);
            return response()->json([
                'status'    => true,
                'message'   => 'Catégorie ajoutée avec succès',
            ]);
        } else {
            # code...
            return response()->json([
                'status'    => false,
                'errors'   => $validator->errors(),
            ]);
        }
    }
}
