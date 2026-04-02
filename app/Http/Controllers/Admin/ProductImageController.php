<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductImage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class ProductImageController extends Controller
{
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id'   => 'required|exists:products,id',
            'image'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'alt_text_fr'  => 'nullable|string|max:255',
            'alt_text_en'  => 'nullable|string|max:255',
            'is_primary'   => 'nullable|boolean',
            'display_order'=> 'nullable|integer',
            'sort_order'   => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $uploadedImage = $request->file('image');
        $extension = $uploadedImage->getClientOriginalExtension();

        $productImage = ProductImage::create([
            'product_id'   => $request->product_id,
            'alt_text_fr'  => $request->alt_text_fr,
            'alt_text_en'  => $request->alt_text_en,
            'is_primary'   => $request->boolean('is_primary', false),
            'display_order'=> $request->input('display_order', 0),
            'sort_order'   => $request->input('sort_order'),
        ]);

        $imageName = $request->product_id.'-'.$productImage->id.'-'.time().'.'.$extension;
        $productImage->image_path = $imageName;
        $productImage->save();

        $sizes = config('image.product_sizes');
        $basePath = public_path('uploads/product');

        File::ensureDirectoryExists($basePath);
        foreach ($sizes as $folder => $settings) {
            $path = $folder ? public_path('uploads/product/'.$folder) : $basePath;
            File::ensureDirectoryExists($path);

            $image = Image::make($uploadedImage->getPathname());
            if ($settings['fit']) {
                $image->fit($settings['width'], $settings['height']);
            } else {
                $image->resize($settings['width'], $settings['height'], function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }
            $image->save($path.'/'.$imageName);
        }

        return response()->json([
            'status'      => true,
            'image_id'    => $productImage->id,
            'imagePath'   => asset('uploads/product/'.$productImage->image_path),
            'imageLarge'  => asset('uploads/product/large/'.$productImage->image_path),
            'imageMedium' => asset('uploads/product/medium/'.$productImage->image_path),
            'imageSmall'  => asset('uploads/product/small/'.$productImage->image_path),
            'imageThumb'  => asset('uploads/product/thumb/'.$productImage->image_path),
            'message'     => 'Image enregistrée avec succès',
        ]);
    }

    public function destroy(Request $request)
    {

        $productImage = ProductImage::find($request->id);
        if (empty($productImage)) {
            return response()->json([
                'status'  => false,
                'message' => 'Image not found'
            ]);
        }

        // Delete files
        $sizes = array_keys(config('image.product_sizes'));
        $deletePaths = [public_path('uploads/product/'.$productImage->image_path)];
        foreach ($sizes as $folder) {
            if ($folder) {
                $deletePaths[] = public_path('uploads/product/'.$folder.'/'.$productImage->image_path);
            }
        }
        File::delete($deletePaths);

        $productImage->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Image deleted successfully'
        ]);
    }
}
