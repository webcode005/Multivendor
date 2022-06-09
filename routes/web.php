<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\VendorController;

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\ProductController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');




require __DIR__.'/auth.php';



Route::prefix('admin')->group(function () 
{
    
    Route::get('/login',[AdminController::class,'login']);
    Route::post('/signin',[AdminController::class,'signin']);
    // Route::get('/logout',[AdminController::class,'logout']);
    
    
    Route::group(['middleware'=>['admin']],function () 
    {
        
        Route::get('/dashboard',[AdminController::class,'dashboard']);
        
        Route::match(['get', 'post'],'/profile',[AdminController::class,'profile']);
        
        Route::match(['get', 'post'], '/setting',[AdminController::class,'setting']);  

        // check current password of admin

        Route::post('/check-current-password',[AdminController::class,'checkAdminPassword']);

        // Update Vendor Details
        Route::match(['get', 'post'], '/update-vendor-details/{slug}',[VendorController::class,'update']);  
        
        // View Admins / Subadmins / Vendors

        Route::get('admins/{type?}',[AdminController::class,'admins']);

        // View Vendor Details
        Route::get('view-vendor-details/{id}',[VendorController::class,'view_vendor_details']); 
        
        // Update Admin / Vendor Status

        Route::post('update-admin-status',[AdminController::class,'update_admin_status']); 
        
        // Admin Logout
        Route::get('/logout',[AdminController::class,'logout']);

        
        // Catalogue Management

        // Section Details
        Route::get('/sections',[SectionController::class,'sections']);

        // Update Section Status

        Route::post('update-section-status',[SectionController::class,'update_section_status']);
        Route::get('delete-section/{id}',[SectionController::class,'delete_section']) ;
        
        // Add Edit Section

        Route::match(['get', 'post'],'add-edit-section/{id?}',[SectionController::class,'addEdit_section']) ;
        

        // Brand Details
        Route::get('/brands',[BrandController::class,'brands']);

        // Update Brand Status

        Route::post('update-brand-status',[BrandController::class,'update_brand_status']);
        Route::get('delete-brand/{id}',[BrandController::class,'delete_brand']) ;
        
        // Add Edit Brand

        Route::match(['get', 'post'],'add-edit-brand/{id?}',[BrandController::class,'addEdit_brand']) ;
        
        // Category Details
        Route::get('/categories',[CategoryController::class,'categories']);

        // Update category Status

        Route::post('update-category-status',[CategoryController::class,'update_category_status']);
        Route::get('delete-category/{id}',[CategoryController::class,'delete_category']) ;
        
        // Add Edit category

        Route::match(['get', 'post'],'add-edit-category/{id?}',[CategoryController::class,'addEdit_category']) ;

        
        // SubCategory Details
        Route::get('/subcategories',[SubcategoryController::class,'subcategories']);

        // Update Subcategory Status

        Route::post('update-subcategory-status',[SubcategoryController::class,'update_subcategory_status']);
        Route::get('delete-subcategory/{id}',[SubcategoryController::class,'delete_subcategory']) ;
        
        // Add Edit Subcategory

        Route::match(['get', 'post'],'add-edit-subcategory/{id?}',[SubcategoryController::class,'addEdit_subcategory']) ;
        
        
        // SubCat Details
        Route::get('/subcat',[SubcategoryController::class,'subcat']);

        // Update Sub Subcat Status

        Route::post('update-subcat-status',[SubcategoryController::class,'update_subcat_status']);
        Route::get('delete-subcat/{id}',[SubcategoryController::class,'delete_subcat']) ;
        
        // Add Edit Subcat

        Route::match(['get', 'post'],'add-edit-subcat/{id?}',[SubcategoryController::class,'addEdit_subcat']) ;
               
        // Append Section Level
        Route::get('append-section-level',[CategoryController::class,'append_section_level']) ;

        // append subcategory

        Route::post('append-subcategories',[SubcategoryController::class,'append_subcategories']);

        // append Sub subcategory

        Route::post('append-subcat',[SubcategoryController::class,'append_subcat']);

        




        // SubCategory Details
        Route::get('/subcategories',[SubcategoryController::class,'subcategories']);

        // Update Subcategory Status

        Route::post('update-subcategory-status',[SubcategoryController::class,'update_subcategory_status']);
        Route::get('delete-subcategory/{id}',[SubcategoryController::class,'delete_subcategory']) ;
        
        // Add Edit Subcategory

        Route::match(['get', 'post'],'add-edit-subcategory/{id?}',[SubcategoryController::class,'addEdit_subcategory']) ;
        
        
        // Product Details
        Route::get('/products',[ProductController::class,'products']);

        // Update Product Status

        Route::post('update-product-status',[ProductController::class,'update_product_status']);
        Route::get('delete-product/{id}',[ProductController::class,'delete_product']) ;
        
        // Add Edit product

        Route::match(['get', 'post'],'add-edit-product/{id?}',[ProductController::class,'addEdit_product']) ;

        // Bulk Product Listing

        Route::match(['get', 'post'],'bulk-listing',[ProductController::class,'bulk_lisiting_product']) ;
        
        // Delete Product Video
        
        Route::get('/remove-product-video/{id}',[ProductController::class,'delete_product_video']) ;
        
        // Add Mulitiple product Image or Gallery

        Route::match(['get', 'post'],'gallery',[ProductController::class,'multiple_image']) ;

        
        
    });
    
});
