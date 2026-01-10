<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\TempImagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

// Frontend
Route::get('/', function () {
    return view('welcome');
});

// Account.
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', IsUser::class])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Backend
Route::prefix('admin')->middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/logout', [AdminController::class, 'destroy'])->name('admin.logout');

    // Catégories
    Route::get('/categories', [CategoryController::class, 'categorie'])->name('admin.categorie');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categorie.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('admin.categorie.store');
    Route::get('/categorie/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categorie.edit');
    Route::put('/categorie/{category}', [CategoryController::class, 'updated'])->name('admin.categorie.updated');
    Route::delete('/categorie/{category}', [CategoryController::class, 'destroy'])->name('admin.categorie.destroy');

    // Catégories
    Route::get('/sous-categories', [SubCategoryController::class, 'subCategorie'])->name('admin.subCategorie');
    Route::get('/sous-categories/create', [SubCategoryController::class, 'create'])->name('admin.subCategorie.create');
    Route::post('/sous-categories/store', [SubCategoryController::class, 'store'])->name('admin.subCategorie.store');
    Route::get('/sous-categories/{subcategory}/edit', [SubCategoryController::class, 'edit'])->name('admin.subCategorie.edit');
    Route::put('/sous-categories/{subcategory}', [SubCategoryController::class, 'updated'])->name('admin.subCategorie.updated');
    Route::delete('/sous-categories/{subcategory}', [SubCategoryController::class, 'destroy'])->name('admin.subCategorie.destroy');

    // IMAGES
    //Route::post('/product-images/update', [ProductImageController::class, 'update'])->name('product-images.update');
    //Route::delete('/product-images/delete', [ProductImageController::class, 'destroy'])->name('product-images.destroy');
    Route::post('/upload-temp-image', [TempImagesController::class, 'create'])->name('temp-images.create');

    // SLUG
    Route::get('/getSlug', function(Request $request){
        $slug = '';
        if (!empty($request->title)) {
            # code...
            $slug = Str::slug($request->title);
        }

        return response()->json([
            'status' => true,
            'slug'   => $slug,
        ]);
    })->name('getSlug');
});
