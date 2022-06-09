<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Subcat;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImage;

use Session;
use DB;
use Auth;

class ProductController extends Controller
{
    public function products()
    {
        $adminType = Auth::guard('admin')->user()->type;
        $vendor_id = Auth::guard('admin')->user()->vendor_id;
        $admin_id = Auth::guard('admin')->user()->id; 
        $admin_name = Auth::guard('admin')->user()->name;        

        Session::put('page',"view_products");
        $title  = "Products";

        if($admin_id == '1')
        {
            $products =DB::table('products')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->join('subcategories', 'products.subcategory_id', '=', 'subcategories.id')
                ->join('subcats', 'products.subcat_id', '=', 'subcats.id')
                ->join('brands', 'products.brand_id', '=', 'brands.id')
                ->join('admins', 'products.admin_id', '=', 'admins.id')
                ->select('products.*', 'categories.category_name', 'subcategories.name as subname', 'subcats.name as sname', 'brands.name as bname', 'admins.name as Adminname')
           
                ->get();
        }           
      
        else
        {
            $products =DB::table('products')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->join('subcategories', 'products.subcategory_id', '=', 'subcategories.id')
                ->join('subcats', 'products.subcat_id', '=', 'subcats.id')
                ->join('brands', 'products.brand_id', '=', 'brands.id')
                ->join('admins', 'products.admin_id', '=', 'admins.id')
                ->select('products.*', 'categories.category_name', 'subcategories.name as subname', 'subcats.name as sname', 'brands.name as bname', 'admins.name as Adminname')
                ->where('products.admin_id',$admin_id )
                ->get();
        }
      

        

        //dd($products);

        $products = json_decode(json_encode($products),true);

        return view('Admin.products.product')->with(compact('products','title','admin_name'));
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
                $product->product_url = preg_replace('/[^A-Za-z0-9\-]/', '-', trim(strtolower($data['prod_name'])));
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
                $message = "Product Added Successfully!!";

                
                $file = $request->file('file');

                if ($file) 
                {
                    $filename = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension(); //Get extension of uploaded file
                    $tempPath = $file->getRealPath();
                    $fileSize = $file->getSize(); //Get size of uploaded file in bytes
                    //Check for file extension and size
                    $this->checkUploadedFileProperties($extension, $fileSize);
                    //Where uploaded file will be stored on the server 
                    $location = 'uploads'; //Created an "uploads" folder for that
                    // Upload file
                    $file->move($location, $filename);
                    // In case the uploaded file path is to be stored in the database 
                    $filepath = public_path($location . "/" . $filename);
                    // Reading file
                    $file = fopen($filepath, "r");
                    $importData_arr = array(); // Read through the file and store the contents as an array
                    $i = 0;
                    //Read the contents of the uploaded file 
                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) 
                        {
                            $num = count($filedata);
                            // Skip first row (Remove below comment if you want to skip the first row)
                            if ($i == 0) 
                            {
                                $i++;
                                continue;
                            }
                            for ($c = 0; $c < $num; $c++) 
                            {
                                $importData_arr[$i][] = $filedata[$c];
                            }
                            $i++;
                        }

                        fclose($file); //Close after reading
                        $j = 0;
                        foreach ($importData_arr as $csv) 
                        {
                            $name = "Basant"; //Get user names
                            $email = "basant.mallick@teammas.in"; //Get the user emails
                            
                            $j++;
                            
                            // insert multiple record into products table

                            $product = new Product;

                            $product->brand_id = $csv['0']; 
                            $product->category_id = $csv['1']; 
                            $product->subcategory_id = $csv['2']; 
                            $product->subcat_id = $csv['3'];

                            $adminType = Auth::guard('admin')->user()->type;
                            $vendor_id = Auth::guard('admin')->user()->vendor_id;
                            $admin_id = Auth::guard('admin')->user()->id;

                            $product->vendor_id = $vendor_id;
                            $product->admin_id = $admin_id;
                            $product->admin_type = $adminType;

                            // $product->vendor_id = $csv['4']; 
                            // $product->admin_id = $csv['5']; 
                            // $product->admin_type = $csv['6']; 

                            $product->product_name = $csv['4']; 
                            $product->product_url = preg_replace('/[^A-Za-z0-9\-]/', '-', trim(strtolower($csv['4'])));; 
                            $product->product_code = $csv['5']; 
                            $product->product_color = $csv['6']; 
                            $product->product_price = $csv['7']; 
                            $product->product_selling_price = $csv['8']; 
                            $product->product_weight = $csv['9']; 
                            $product->product_image = $csv['10']; 
                            $product->product_video = $csv['11']; 
                            $product->description = $csv['12']; 
                            $product->gst = $csv['13']; 
                            $product->status = 0;    

                            $product->save();

                        }
                        // return response()->json([
                        // 'message' => "$j records successfully uploaded"
                        // ]);

                        $message = "$j records successfully uploaded";

                        return redirect('admin/products')->with('success-message',$message);
                }
                else 
                {
                    //no file was uploaded
                    throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
                }             
                
            }



            
        return view('Admin.products.bulk-listing')->with(compact('title'));

    }

    public function checkUploadedFileProperties($extension, $fileSize)
    {
        $valid_extension = array("csv", "xlsx"); //Only want csv and excel files
        $maxFileSize = 2097152; // Uploaded file size limit is 2mb
        if (in_array(strtolower($extension), $valid_extension)) {
        if ($fileSize <= $maxFileSize) {
        } else {
        throw new \Exception('No file was uploaded', Response::HTTP_REQUEST_ENTITY_TOO_LARGE); //413 error
        }
        } else {
        throw new \Exception('Invalid file extension', Response::HTTP_UNSUPPORTED_MEDIA_TYPE); //415 error
        }
    }


    public function sendEmail($email, $name)
    {
        $data = array(
        'email' => 'basant.mallick@teammas.in',
        'name' => 'Basant Mallick',
        'subject' => 'Welcome Message',
        );
        Mail::send('welcomeEmail', $data, function ($message) use ($data) {
        $message->from('basant.mallick@teammas.in');
        $message->to($data['email']);
        $message->subject($data['subject']);
        });
    }  


    // Delete Product Video

    public function delete_product_video($id)
    {
        $product =  Product::select('product_video')->where('id',$id)->first();

        echo $videoName = $product->product_video;


        $video_path = 'Frontend/assets/images/product/';

        if(file_exists($video_path.$videoName))
        {
            unlink($video_path.$videoName);
        }       

        Product::where('id',$id)->update(['product_video'=>'']);

        $message = "Product Video Deleted Successfully";
        return redirect()->back()->with('success-message',$message);
    }

    // Delete Product
    
    public function delete_product($id)
    {
        Product::where('id',$id)->delete();
        $message = "Product Deleted Successfully";
        return redirect()->back()->with('success-message',$message);
    }

    public function multiple_image(Request $request)
    {
        $title = "Upload Bulk Product Images";  
        Session::put('page',"gallery");     

            if($request->isMethod('post'))
            {

                $title = "Upload Bulk Product Images";
                
                $message = "Product Images Added Successfully!!";
                $admin_id = Auth::guard('admin')->user()->id;
        
                // $data = $request->all();

                // print_r($data); die;

                foreach ($request->file('images') as $imagefile) 
                {
                        $image = new ProductImag;
                        
                        $imageName = time().'.'.$request->images->extension();  
                        
                        //$request->images->move(public_path('Frontend/assets/images/product/'), $imageName);
                        
                        $imagefile->store('/Frontend/assets/images/product', ['disk' =>   'my_files']);

                        $image->file_name = $imageName;

                        $image->upload_date = date("Y-m-d H:i:s");

                        $image->uploaded_b = $admin_id;
                        
                        $image->save();
                    }
        
            }

            
        return view('Admin.products.gallery')->with(compact('title'));

    }

    
}
