<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\TempImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function brand(Request $request){

        $brands = Brand::latest();
        if (!empty($request->get('keyword'))) {
            # code...
            $brands = $brands->where('name','like','%'. $request->get('keyword') .'%');
        }

        $brands = $brands->paginate(5);
        Session::put('page','brand');
        return view('admin.brands.brand', compact('brands'));
    }

    public function create(){
        return view('admin.brands.create');
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'name'  => 'required',
            'slug'  => 'required|unique:brands'
        ]);

        if ($validator->passes()) {
            # code...
            $brand = new Brand();
            $brand->name_fr = $request->name;
            $brand->slug    = $request->slug;
            $brand->status  = $request->status;
            $brand->save();

            // Sauvegardez une image
            if (!empty($request->image_id)) {
                # code...
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.',$tempImage->name);
                $ext = last($extArray);

                $newImageName = $brand->id.'-'.time().'.'.$ext;
                $sPath = public_path().'/temp/'.$tempImage->name;
                $dPath = public_path().'/uploads/brands/'.$newImageName;
                File::copy($sPath,$dPath);

                $brand->image = $newImageName;
                $brand->save();
            }

            $message = "Marque ajoutée avec succès";
            Session()->flash('success', $message);
            return response()->json([
                'status'    => true,
                'message'   => 'Marque ajoutée avec succès',
            ]);
        } else {
            # code...
            return response()->json([
                'status'    => false,
                'errors'   => $validator->errors(),
            ]);
        }
    }

    public function edit($brandId){

        $brand = Brand::find($brandId);
        if (empty($brand)) {
            # code...
            return redirect()->route('admin.brand');
        }
        return view('admin.brands.edit', compact('brand'));
    }

    public function updated($brandId, Request $request){

        $brand = Brand::find($brandId);
        if (empty($brand)) {
            # code...
            Session()->flash('error','Marque introuvable');
            return response()->json([
                'status'   => false,
                'notFound' => true,
                'message'  => 'Marque introuvable'
            ]);
        }

        $validator = Validator::make($request->all(),[
            'name'  => 'required',
            'slug'  => 'required|unique:brands,slug,'.$brand->id.',id'
        ]);

        if ($validator->passes()) {
            # code...
            $brand->name_fr  = $request->name;
            $brand->slug     = $request->slug;
            $brand->status   = $request->status;
            $brand->save();

            // Sauvegardez une image
            if (!empty($request->image_id)) {
                # code...
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.', $tempImage->name);
                $ext = last($extArray);

                $newImageName = $brand->id.'-'.time().'.'.$ext;
                $sPath = public_path().'/temp/'.$tempImage->name;
                $dPath = public_path().'/uploads/brands/'.$newImageName;
                File::copy($sPath,$dPath);

                $brand->image = $newImageName;
                $brand->save();
            }

            Session()->flash('success','Marque mise à jour avec succès');
            return response()->json([
                'status'    => true,
                'message'   => 'Marque mise à jour avec succès',
            ]);

        } else {
            # code...
            return response()->json([
                'status'    => false,
                'errors'    => $validator->errors(),
            ]);
        }
    }

    public function destroy($brandId){

        $brand = Brand::find($brandId);
        if (empty($brand)) {
            # code...
            Session()->flash('error','Catégorie introuvable');
            return response()->json([
                'status'    => true,
                'message'   => 'Catégorie introuvable'
            ]);
        }

        File::delete(public_path().'/uploads/brands/thump/'.$brand->id);
        File::delete(public_path().'/uploads/brands/'.$brand->id);

        $brand->delete();

        Session()->flash('success','Suppression de la marque réussie');
        return response()->json([
            'status'    => true,
            'message'   => 'Suppression de la marque réussie'
        ]);
    }
}
