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
            $categories = $categories->where(function ($query) use ($request) {
                $query->where('name_fr', 'like', '%'.$request->get('keyword').'%')
                      ->orWhere('name_en', 'like', '%'.$request->get('keyword').'%');
            });
        }

        $categories = $categories->paginate(10);
        Session::put('page','categorie');
        return view('admin.categories.categorie', compact('categories'));
    }

    public function create(){
        return view('admin.categories.create');
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'name_fr'  => 'required',
            'name_en'  => 'required',
            'slug'  => 'required|unique:categories'
        ]);

        if ($validator->passes()) {
            # code...
            $category = new Category();
            $category->name_fr = $request->name_fr;
            $category->name_en = $request->name_en;
            $category->slug = $request->slug;
            $category->description_fr = $request->description_fr;
            $category->description_en = $request->description_en;
            $category->logo = $request->logo;
            $category->icon = $request->icon;
            $category->banner = $request->banner;
            $category->meta_title_fr = $request->meta_title_fr;
            $category->meta_title_en = $request->meta_title_en;
            $category->meta_description_fr = $request->meta_description_fr;
            $category->meta_description_en = $request->meta_description_en;
            $category->meta_keywords_fr = $request->meta_keywords_fr;
            $category->meta_keywords_en = $request->meta_keywords_en;
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

    public function edit($categoryId){

        $category = Category::find($categoryId);
        if (empty($category)) {
            # code...
            return redirect()->route('admin.categorie');
        }
        return view('admin.categories.edit', compact('category'));
    }

    public function updated($categoryId, Request $request){

        $category = Category::find($categoryId);
        if (empty($category)) {
            # code...
            Session()->flash('error','Catégorie introuvable');
            return response()->json([
                'status'   => false,
                'notFound' => true,
                'message'  => 'Catégorie introuvable'
            ]);
        }

        $validator = Validator::make($request->all(),[
            'name_fr'  => 'required',
            'name_en'  => 'required',
            'slug'  => 'required|unique:categories,slug,'.$category->id.',id'
        ]);

        if ($validator->passes()) {
            # code...
            $category->name_fr = $request->name_fr;
            $category->name_en = $request->name_en;
            $category->slug = $request->slug;
            $category->description_fr = $request->description_fr;
            $category->description_en = $request->description_en;
            $category->logo = $request->logo;
            $category->icon = $request->icon;
            $category->banner = $request->banner;
            $category->meta_title_fr = $request->meta_title_fr;
            $category->meta_title_en = $request->meta_title_en;
            $category->meta_description_fr = $request->meta_description_fr;
            $category->meta_description_en = $request->meta_description_en;
            $category->meta_keywords_fr = $request->meta_keywords_fr;
            $category->meta_keywords_en = $request->meta_keywords_en;
            $category->showHome = $request->showHome;
            $category->status = $request->status;
            $category->save();

            // Sauvegardez une image
            if (!empty($request->image_id)) {
                # code...
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.', $tempImage->name);
                $ext = last($extArray);

                $newImageName = $category->id.'-'.time().'.'.$ext;
                $sPath = public_path().'/temp/'.$tempImage->name;
                $dPath = public_path().'/uploads/categories/'.$newImageName;
                File::copy($sPath,$dPath);

                $category->image = $newImageName;
                $category->save();
            }

            Session()->flash('success','Catégorie mise à jour avec succès');
            return response()->json([
                'status'    => true,
                'message'   => 'Catégorie mise à jour avec succès',
            ]);

        } else {
            # code...
            return response()->json([
                'status'    => false,
                'errors'    => $validator->errors(),
            ]);
        }
    }

    public function destroy($categoryId){

        $category = Category::find($categoryId);
        if (empty($category)) {
            Session()->flash('error','Catégorie introuvable');
            return response()->json([
                'status'    => false,
                'message'   => 'Catégorie introuvable'
            ]);
        }

        if (!empty($category->image)) {
            File::delete(public_path('uploads/categories/thump/'.$category->image));
            File::delete(public_path('uploads/categories/'.$category->image));
        }

        $category->delete();

        Session()->flash('success','Suppression de la catégorie réussie');
        return response()->json([
            'status'    => true,
            'message'   => 'Suppression de la catégorie réussie'
        ]);
    }
}
