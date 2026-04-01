<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
use App\Models\TempImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{
    public function product(Request $request){

        //$products = Product::latest('id')->with('product_images');
        $products = Product::latest('id');
        if ($request->get('keyword') != "") {
            $products = $products->where(function ($query) use ($request) {
                $query->where('title_fr','like','%'.$request->keyword.'%')
                      ->orWhere('title_en','like','%'.$request->keyword.'%');
            });
        }

        $products = $products->paginate(10);
        Session::put('page', 'product');
        return view('admin.products.products', compact('products'));
    }

    public function create(){

        $brands = Brand::orderBy('name_fr','ASC')->get();
        $categories = Category::orderBy('name_fr','ASC')->get();
        $subCategories = SubCategory::orderBy('name_fr','ASC')->get();
        return view('admin.products.create', compact('categories','brands','subCategories'));
    }

    public function store(Request $request){

        if (empty($request->slug) && !empty($request->title)) {
            $request->merge(['slug' => Str::slug($request->title)]);
        }

        $rules = [
            'title'         => 'required',
            'slug'          => 'required|unique:products',
            'price'         => 'required|numeric',
            'sku'           => 'required',
            'track_qty'     => 'required|in:Yes,No',
            'category'      => 'required|numeric',
            'is_featured'   => 'required',
        ];

        $messages = [
            'title'         => 'Veuillez entrer le titre',
            'slug'          => 'Veuillez entrer le slug',
            'price'         => 'Veuillez entrer le prix',
            'sku'           => 'Veuillez entrer le sku',
            'track_qty'     => 'Veuillez entrer la Qty',
            'category'      => 'Veuillez entrer la catégorie',
            'is_featured'   => 'Veuillez entrer le produit envette',
        ];

        if (!empty($request->track_qty) && $request->track_qty == 'Yes') {
            # code...
            $rules['qty'] = 'required|numeric';
        }

        $Validator = Validator::make($request->all(), $rules, $messages);

        if ($Validator->passes()) {
            $product = new Product();
            $product->title_fr             = $request->title;
            $product->title_en             = $request->title;
            $product->slug                 = $request->slug;
            $product->description_fr       = $request->description;
            $product->description_en       = $request->description;
            $product->short_description_fr = $request->short_description;
            $product->short_description_en = $request->short_description;
            $product->shipping_returns_fr  = $request->shipping_returns;
            $product->shipping_returns_en  = $request->shipping_returns;
            $product->price                = $request->price;
            $product->compare_price        = $request->compare_price;
            $product->cost_price           = $request->cost_price;
            $product->sku                  = $request->sku;
            $product->barcode              = $request->barcode;
            $product->weight               = $request->weight;
            $product->length               = $request->length;
            $product->width                = $request->width;
            $product->height               = $request->height;
            $product->low_stock_threshold  = $request->low_stock_threshold;
            $product->stock_status         = $request->stock_status ?? 'in_stock';
            $product->draft                = $request->draft ?? 'pending';
            $product->visible              = $request->visible ?? 'visible';
            $product->has_variations       = ($request->has_variations == 'Yes');
            $product->is_on_sale           = ($request->is_on_sale == 'Yes');
            $product->is_new               = ($request->is_new == 'Yes');
            $product->track_qty            = $request->track_qty;
            $product->qty                  = $request->qty;
            $product->meta_title_fr        = $request->meta_title;
            $product->meta_title_en        = $request->meta_title;
            $product->meta_description_fr  = $request->meta_description;
            $product->meta_description_en  = $request->meta_description;
            $product->meta_keywords_fr     = $request->meta_keywords;
            $product->meta_keywords_en     = $request->meta_keywords;
            $product->vendor_id            = Auth::id();
            $product->category_id          = $request->category;
            $product->sub_category_id      = $request->sub_category;
            $product->brand_id             = $request->brand;
            $product->status               = $request->status;
            $product->is_featured          = $request->is_featured;
            $product->related_products     = (!empty($request->related_products)) ? implode(',',$request->related_products) : '';
            $product->save();

            if (!empty($request->image_array)) {
                # code...
                foreach ($request->image_array as $temp_image_id) {
                    # code...
                    $tempImageInfo = TempImage::find($temp_image_id);
                    $extArray = explode('.',$tempImageInfo->name);
                    $ext = last($extArray);

                    $productImage = new ProductImage();
                    $productImage->product_id = $product->id;
                    $productImage->image_path = null;
                    $productImage->save();

                    $imageName = $product->id.'-'.$productImage->id.'-'.time().'.'.$ext;
                    $productImage->image_path = $imageName;
                    $productImage->save();

                    $sourcePath = public_path('/temp/'.$tempImageInfo->name);
                    $sizes = config('image.product_sizes');
                    $basePath = public_path('uploads/product');

                    File::ensureDirectoryExists($basePath);
                    foreach ($sizes as $folder => $settings) {
                        $path = $folder ? public_path('uploads/product/'.$folder) : $basePath;
                        File::ensureDirectoryExists($path);

                        $image = Image::make($sourcePath);
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
                }
            }

            Session()->flash('success','Produit ajouté avec succès');

            return response()->json([
                'status'  => true,
                'message' => 'Produit ajouté avec succès',
            ]);
        } else {
            # code...
            return response()->json([
                'status' => false,
                'errors' => $Validator->errors(),
            ]);
        }
    }

    public function edit($productId, Request $request){

        $product = Product::find($productId);
        if (empty($product)) {
            # code...
            return redirect()->route('admin.product')->with('error','Produit introuvable');
        }

        // Fetch Product Images
        $productImages = ProductImage::where('product_id',$product->id)->get();

        // Fetch related product
        $relatedProducts = [];
        if ($product->related_products) {
            # code...
            $productArray = explode(',',$product->related_products);
            $relatedProducts = Product::whereIn('id',$productArray)->get();
        }

        $subCategories = SubCategory::where('category_id',$product->category_id)->get();
        $brands = Brand::orderBy('name_fr','ASC')->get();
        $categories = Category::orderBy('name_fr','ASC')->get();
        return view('admin.products.edit', compact('categories','brands','subCategories','product','productImages','relatedProducts'));
    }

    public function updated($productId, Request $request){

        $product = Product::find($productId);

        if (empty($request->slug) && !empty($request->title)) {
            $request->merge(['slug' => Str::slug($request->title)]);
        }

        $rules = [
            'title'         => 'required',
            'slug'          => 'required|unique:products,slug,'.$product->id.',id',
            'price'         => 'required|numeric',
            'sku'           => 'required|unique:products,sku,'.$product->id.',id',
            'track_qty'     => 'required|in:Yes,No',
            'category'      => 'required|numeric',
            'is_featured'   => 'required',
        ];

        if (!empty($request->track_qty) && $request->track_qty == 'Yes') {
            # code...
            $rules['qty'] = 'required|numeric';
        }

        $Validator = Validator::make($request->all(), $rules);

        if ($Validator->passes()) {
            $product->title_fr             = $request->title;
            $product->title_en             = $request->title;
            $product->slug                 = $request->slug;
            $product->description_fr       = $request->description;
            $product->description_en       = $request->description;
            $product->short_description_fr = $request->short_description;
            $product->short_description_en = $request->short_description;
            $product->shipping_returns_fr  = $request->shipping_returns;
            $product->shipping_returns_en  = $request->shipping_returns;
            $product->price                = $request->price;
            $product->compare_price        = $request->compare_price;
            $product->cost_price           = $request->cost_price;
            $product->sku                  = $request->sku;
            $product->barcode              = $request->barcode;
            $product->weight               = $request->weight;
            $product->length               = $request->length;
            $product->width                = $request->width;
            $product->height               = $request->height;
            $product->low_stock_threshold  = $request->low_stock_threshold;
            $product->stock_status         = $request->stock_status ?? 'in_stock';
            $product->draft                = $request->draft ?? 'pending';
            $product->visible              = $request->visible ?? 'visible';
            $product->has_variations       = ($request->has_variations == 'Yes');
            $product->is_on_sale           = ($request->is_on_sale == 'Yes');
            $product->is_new               = ($request->is_new == 'Yes');
            $product->track_qty            = $request->track_qty;
            $product->qty                  = $request->qty;
            $product->meta_title_fr        = $request->meta_title;
            $product->meta_title_en        = $request->meta_title;
            $product->meta_description_fr  = $request->meta_description;
            $product->meta_description_en  = $request->meta_description;
            $product->meta_keywords_fr     = $request->meta_keywords;
            $product->meta_keywords_en     = $request->meta_keywords;
            $product->category_id          = $request->category;
            $product->sub_category_id      = $request->sub_category;
            $product->brand_id             = $request->brand;
            $product->status               = $request->status;
            $product->is_featured          = $request->is_featured;
            $product->related_products     = (!empty($request->related_products)) ? implode(',',$request->related_products) : '';
            $product->save();

            Session()->flash('success','Produit mis à jour avec succès');
            return response()->json([
                'status'  => true,
                'message' => 'Produit mis à jour avec succès',
            ]);
        } else {
            # code...
            return response()->json([
                'status' => false,
                'errors' => $Validator->errors(),
            ]);
        }
    }

    public function destroy($productId, Request $request){

        $product = Product::find($productId);
        if (empty($product)) {
            # code...
            Session()->flash('error','Produit introuvable');
            return response()->json([
                'status'   => false,
                'notFound' => true,
            ]);
        }

        $productImages = ProductImage::where('product_id',$productId)->get();
        if ($productImages->isNotEmpty()) {
            $sizes = array_keys(config('image.product_sizes'));
            foreach($productImages as $productImage){
                $deletePaths = [public_path('uploads/product/'.$productImage->image)];
                foreach ($sizes as $folder) {
                    if ($folder) {
                        $deletePaths[] = public_path('uploads/product/'.$folder.'/'.$productImage->image);
                    }
                }
                File::delete($deletePaths);
            }
            ProductImage::where('product_id',$productId)->delete();
        }

        $product->delete();
        Session()->flash('success','Produit supprimé avec succès');
        return response()->json([
            'status'  => true,
            'message' => 'Produit supprimé avec succès',
        ]);
    }

    public function getProducts(Request $request){

        $tempProduct = [];
        if ($request->term != "") {
            # code...
            $products = Product::where(function ($query) use ($request) {
                $query->where('title_fr','like','%'.$request->term.'%')
                      ->orWhere('title_en','like','%'.$request->term.'%');
            })->get();

            if ($products != null) {
                # code...
                foreach ($products as $product) {
                    # code...
                    $tempProduct[] = array('id' => $product->id, 'text' => $product->title);
                }
            }
        }

        return response()->json([
            'tags'   => $tempProduct,
            'status' => true
        ]);
    }
}
