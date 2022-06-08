<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Subcat;
use App\Models\Brand;
use App\Models\Product;

use Session;
use DB;
use Auth;

class ProductController extends Controller
{
    public function products()
    {
        $products = Product::get()->toArray();

        Session::put('page',"view_products");
        $title  = "Products";

        $products =DB::table('products')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->join('subcategories', 'products.subcategory_id', '=', 'subcategories.id')
                ->join('subcats', 'products.subcat_id', '=', 'subcats.id')
                ->join('brands', 'products.brand_id', '=', 'brands.id')
                ->select('products.*', 'categories.category_name', 'subcategories.name as subname', 'subcats.name as sname', 'brands.name as bname')
                ->get();

        //dd($products);

        $products = json_decode(json_encode($products),true);

        return view('Admin.products.product')->with(compact('products','title'));
    }

    
    public function update_product_status(Request $request)
    {
        $data = $request->all();

        if ($data['status'] == "Active") {
            $status = "0";
        } 
        else 
        {
            $status = "1";
        }

        Product::where('id',$data['product_id'])->update(['status'=>$status]);
        return response()->json(['status'=>$status,'product_id'=>$data['product_id']]);
        
    }

    public function delete_product($id)
    {
        Product::where('id',$id)->delete();
        $message = "Product Deleted Successfully";
        return redirect()->back()->with('success-message',$message);
    }


    // Add Edit Product

    public function addEdit_product(Request $request,$id = Null)
    {     
        
        if($id == Null)
        {
            $title = "Add Product";
            $product = new Product;
            //$getCategories = array();
            $message = "Product Added Successfully!!";
        }
        else
        {

            $title = "Update Product";
            $product =  Product::find($id);
            //$getCategories = product::with('products')->where(['parent_id'=>0,'section_id'=>$product['section_id']])->get();
            $message = "Product Updated Successfully!!";
           
        }

        // get All Categories
        $getCategories = Category::get()->toArray();

        // get All SubCategories
        $getSubCategories = SubCategory::get()->toArray();

        // get All Sub SubCategories
        $getSubCats = Subcat::get()->toArray();

        // get All Brands
        $getBrands = Brand::where('status',1)->get()->toArray();

            if($request->isMethod('post'))
            {
                $data =$request->all();

                //print_r($data); die; 
                
                // For Image

                if(!empty($request->product_image))

                {
                    if($request->hasFile('product_image'))
                    {
                        $imageName = time().'.'.$request->product_image->extension();  
             
                        $request->product_image->move(public_path('Frontend/assets/images/product/'), $imageName);
                    }
                     
                }
                else 
                {
                    $imageName = $request->dbimage;                
                }  
                
    
                // For Video

                if(!empty($request->product_video))
                {
                    if($request->hasFile('product_video'))
                    {
                         $videoName = time().'.'.$request->product_video->extension();  
             
                        $request->product_video->move(public_path('Frontend/assets/images/product/'), $videoName);
                    }
                    
                } 
                
                else 
                
                {
                    $videoName = $request->dbvideo; 
                }


                // $rules = 
                //         [
                //             "prod_name" =>'required',
                //             "product_image" =>'required',
                //             "meta_title" =>'required',
                //             "meta_description" =>'required',
                //             "meta_keywords" =>'required',
                //         ];                                
                          
                // $customMessage = 
                //                 [
                //                     "prod_name.required" => "Product Name is required",
                //                     "meta_title.required" => "Product Meta Title is required",
                //                     "meta_description.required" => "Product Meta Description is required",
                //                     "meta_keywords.required" => "Product Meta Keywords is required",
                //                     'product_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                                    
                //                  ];

                // $this->validate($request,$rules,$customMessage);

                $product->product_name = $data['prod_name']; 
                $product->product_url = preg_replace('/[^a-z0-9-]+/', '-', trim(strtolower($data['prod_name'])));
                $product->brand_id = $data['brand_id'];
                $product->category_id = $data['category_id'];
                $product->subcategory_id = $data['subcategory_id'];
                $product->subcat_id = $data['subcat_id']; 

                $adminType = Auth::guard('admin')->user()->type;
                $vendor_id = Auth::guard('admin')->user()->vendor_id;
                $admin_id = Auth::guard('admin')->user()->id;

                $product->vendor_id = $vendor_id;
                $product->admin_id = $admin_id;
                $product->admin_type = $adminType;
                
                $product->product_image = $imageName;
                $product->product_video = $videoName; 

                $product->product_code = $data['product_code']; 
                $product->product_color = $data['product_color'];
                $product->product_price = $data['product_price'];
                $product->product_selling_price = $data['product_selling_price'];
                $product->product_weight = $data['product_weight']; 
                $product->description = $data['description']; 
                $product->meta_title = $data['meta_title'];
                $product->meta_description = $data['meta_description'];                
                $product->meta_keywords = $data['meta_keywords']; 
                
                $product->is_featured = $data['is_featured']; 
                $product->gst = $data['gst'];              
                
                
                $product->status = 1;
                $product->save();

                return redirect('admin/products')->with('success-message',$message);

            }

            
        return view('Admin.products.addEdit')->with(compact('product','title','getCategories','getSubCategories','getSubCats','getBrands'));

    }

    
    // Append Category Level

    public function append_subcategory_level(Request $request)
    {
        $data = $request->all();
        $getCategories = Product::where(['parent_id'=>0,'section_id'=>$data['section_id']])->get()->toArray();
        return view('Admin.categories.append-category-level')->with(compact('getCategories'));
    }
    
    // Append Category Level

    public function append_subcat_level(Request $request)
    {
        $data = $request->all();
        $getCategories = Subcat::where(['parent_id'=>0,'section_id'=>$data['section_id']])->get()->toArray();
        return view('Admin.categories.append-category-level')->with(compact('getCategories'));
    }


    public function bulk_lisiting_product(Request $request)
    {     
        $title = "Bulk Product Listing";  
        Session::put('page',"bulk_listing");     

            if($request->isMethod('post'))
            {

                $title = "Add Product";
                $product = new Product;
                $message = "Product Added Successfully!!";

                
                $data =$request->all();

                print_r($data); die; 


                $file = $_FILES["file"]["tmp_name"]; 
                    
                $file_open = fopen($file,"r");
                $result = array();
                $idd='1';
                while(($csv = fgetcsv($file_open, 1000, ",")) !== false)
                {

                    if($idd!=1) 
                    {
                                $product->brand_id = $csv['0']; 
                                $product->category_id = $csv['1']; 
                                $product->subcategory_id = $csv['2']; 
                                $product->subcat_id = $csv['3']; 
                                $product->vendor_id = $csv['4']; 
                                $product->admin_id = $csv['5']; 
                                $product->admin_type = $csv['6']; 
                                $product->product_name = $csv['7']; 
                                $product->product_url = $csv['8']; 
                                $product->product_code = $csv['9']; 
                                $product->product_color = $csv['10']; 
                                $product->product_price = $csv['11']; 
                                $product->product_selling_price = $csv['12']; 
                                $product->product_weight = $csv['13']; 
                                $product->product_image = $csv['14']; 
                                $product->product_video = $csv['15']; 
                                $product->description = $csv['16']; 
                                $product->gst = $data['17']; 
                                $product->status = 0;                         
                            

                            
                                $product->saveAll();
                    }

                            
                            
                    $idd++;        
                            
                }

                unset($data);












                
                // For Image

                if(!empty($request->product_image))

                {
                    if($request->hasFile('product_image'))
                    {
                        $imageName = time().'.'.$request->product_image->extension();  
             
                        $request->product_image->move(public_path('Frontend/assets/images/product/'), $imageName);
                    }
                     
                }
                else 
                {
                    $imageName = $request->dbimage;                
                }  
                
    
                // For Video

                if(!empty($request->product_video))
                {
                    if($request->hasFile('product_video'))
                    {
                         $videoName = time().'.'.$request->product_video->extension();  
             
                        $request->product_video->move(public_path('Frontend/assets/images/product/'), $videoName);
                    }
                    
                } 
                
                else 
                
                {
                    $videoName = $request->dbvideo; 
                }


                // $rules = 
                //         [
                //             "prod_name" =>'required',
                //             "product_image" =>'required',
                //             "meta_title" =>'required',
                //             "meta_description" =>'required',
                //             "meta_keywords" =>'required',
                //         ];                                
                          
                // $customMessage = 
                //                 [
                //                     "prod_name.required" => "Product Name is required",
                //                     "meta_title.required" => "Product Meta Title is required",
                //                     "meta_description.required" => "Product Meta Description is required",
                //                     "meta_keywords.required" => "Product Meta Keywords is required",
                //                     'product_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                                    
                //                  ];

                // $this->validate($request,$rules,$customMessage);

                $product->product_name = $data['prod_name']; 
                $product->product_url = preg_replace('/[^a-z0-9-]+/', '-', trim(strtolower($data['prod_name'])));
                $product->brand_id = $data['brand_id'];
                $product->category_id = $data['category_id'];
                $product->subcategory_id = $data['subcategory_id'];
                $product->subcat_id = $data['subcat_id']; 

                $adminType = Auth::guard('admin')->user()->type;
                $vendor_id = Auth::guard('admin')->user()->vendor_id;
                $admin_id = Auth::guard('admin')->user()->id;

                $product->vendor_id = $vendor_id;
                $product->admin_id = $admin_id;
                $product->admin_type = $adminType;
                
                $product->product_image = $imageName;
                $product->product_video = $videoName; 

                $product->product_code = $data['product_code']; 
                $product->product_color = $data['product_color'];
                $product->product_price = $data['product_price'];
                $product->product_selling_price = $data['product_selling_price'];
                $product->product_weight = $data['product_weight']; 
                $product->description = $data['description']; 
                $product->meta_title = $data['meta_title'];
                $product->meta_description = $data['meta_description'];                
                $product->meta_keywords = $data['meta_keywords']; 
                
                $product->is_featured = $data['is_featured']; 
                $product->gst = $data['gst'];              
                
                
                $product->status = 1;
                $product->save();

                return redirect('admin/products')->with('success-message',$message);

            }



            
        return view('Admin.products.bulk-listing')->with(compact('title'));

    }

    
}
