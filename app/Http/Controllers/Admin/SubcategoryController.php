<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Subcat;

use Session;
use DB;

class SubcategoryController extends Controller
{
    
    public function subcategories()
    {
        $subcategories = Subcategory::get()->toArray();

        Session::put('page',"subcategories");
        $title  = "SubCategories";

        $subcategories =DB::table('subcategories')
                ->join('categories', 'subcategories.category_id', '=', 'categories.id')
                ->select('subcategories.*', 'categories.category_name')
                ->get();

        //dd($subcategories);

        $subcategories = json_decode(json_encode($subcategories),true);

        return view('Admin.subcategories.subcategory')->with(compact('subcategories','title'));
    }

    
    public function update_subcategory_status(Request $request)
    {
        $data = $request->all();

        if ($data['status'] == "Active") {
            $status = "0";
        } 
        else 
        {
            $status = "1";
        }

        Subcategory::where('id',$data['category_id'])->update(['status'=>$status]);
        return response()->json(['status'=>$status,'category_id'=>$data['category_id']]);
        
    }

    public function delete_subcategory($id)
    {
        Subcategory::where('id',$id)->delete();
        $message = "SubCategory Deleted Successfully";
        return redirect()->back()->with('success-message',$message);
    }

    // Append Category Level

    public function append_subcategory_level(Request $request)
    {
        $data = $request->all();
        
        $getCategories = Subcategory::where(['status'=>1,'category_id'=>$data['category_id']])->get()->toArray();
        return view('Admin.categories.append-category-level')->with(compact('getCategories'));
    }

    // Add Edit category

    public function addEdit_subcategory(Request $request,$id = Null)
    {     
        //print_r($request->all())  ; die;

        if($id == Null)
        {
            $title = "Add SubCategory";
            $category = new Subcategory;
            //$getCategories = array();
            $message = "Category Added Succcessfully!!";
        }
        else
        {

            $title = "Edit SubCategory";
            $category =  Subcategory::find($id);
            //$getCategories = Category::with('subCategories')->where(['parent_id'=>0,'section_id'=>$category['section_id']])->get();
            $message = "SubCategory Updated Succcessfully!!";
           
        }

        $getCategories = Category::get()->toArray();

            if($request->isMethod('post'))
            {
                $data =$request->all();

                //print_r($data); die;        

                $rules = 
                        [
                            "name" =>'required',
                            "category_id" =>'required',
                        ];                                
                          
                $customMessage = 
                                [
                                    "name.required" => "Category Name is required",
                                     "category_id.required" => "Category is required",
                                    
                                 ];

                $this->validate($request,$rules,$customMessage);

                // $category->parent_id = $data['parent'];
                // $category->section_id = $data['section'];
                $category->name = $data['name'];
                
                $category->category_id = $data['category_id'];
                $category->url = preg_replace('/[^a-z0-9-]+/', '-', trim(strtolower($data['name'])));
                
                $category->status = 1;
                $category->save();

                return redirect('admin/subcategories')->with('success-message',$message);

            }
            
        return view('Admin.subcategories.addEdit')->with(compact('category','title','getCategories'));

    }

    // Subcat

    public function subcat()
    {
        Session::put('page',"subcat");
        $title  = "Sub SubCategories";

        $subcategories =DB::table('subcats')
                ->join('categories', 'subcats.category_id', '=', 'categories.id')
                ->join('subcategories', 'subcats.subcategory_id', '=', 'subcategories.id')
                ->select('subcats.*', 'categories.category_name', 'subcategories.name as subcatename')
                ->get();

        //dd($subcategories);

        $subcategories = json_decode(json_encode($subcategories),true);

        return view('Admin.subsubcat.subcategory')->with(compact('subcategories','title'));
    }

    
    public function update_subcat_status(Request $request)
    {
        $data = $request->all();

        if ($data['status'] == "Active") {
            $status = "0";
        } 
        else 
        {
            $status = "1";
        }

        Subcat::where('id',$data['category_id'])->update(['status'=>$status]);
        return response()->json(['status'=>$status,'category_id'=>$data['category_id']]);
        
    }

    public function delete_subcat($id)
    {
        Subcat::where('id',$id)->delete();
        $message = "SubCategory Deleted Successfully";
        return redirect()->back()->with('success-message',$message);
    }

    // Append Category Level

    public function append_subcat_level(Request $request)
    {
        $data = $request->all();
        $getCategories = Subcat::where(['status'=>1,'id'=>$data['category_id']])->get()->toArray();
        return view('Admin.categories.append-category-level')->with(compact('getCategories'));
    }

    // Add Edit category

    public function addEdit_subcat(Request $request,$id = Null)
    {   
        if($id == Null)
        {
            $title = "Add Sub SubCategory";
            $category = new Subcat;
            $subcategoryy = "";
            $message = "Sub SubCategory Added Succcessfully!!";
        }
        else
        {

            $title = "Edit Sub SubCategory";
            $category =  Subcat::find($id);
            $scatid = $category['subcategory_id']; 
            $subcategoryy =  Subcategory::find($scatid);           
            // print_r($subcategoryy); 
            // echo"<br><br> Category<br>";
            // print_r($category); 
            // die;             
           
            $message = "Sub SubCategory Updated Succcessfully!!";
           
        }


        $getCategories = Category::get()->toArray();


            if($request->isMethod('post'))
            {
                $data =$request->all();

                //print_r($data); die;        

                $rules = 
                        [
                            "name" =>'required',
                            "category_id" =>'required',
                            "subcategory_id" =>'required',
                        ];                                
                          
                $customMessage = 
                                [
                                    "name.required" => "Category Name is required",
                                     "category_id.required" => "Category is required",
                                     "subcategory_id.required" => "Sub Category is required",
                                                                         
                                 ];

                $this->validate($request,$rules,$customMessage);

                // $category->parent_id = $data['parent'];
                // $category->section_id = $data['section'];
                $category->name = $data['name'];               
                
                $category->url = preg_replace('/[^a-z0-9-]+/', '-', trim(strtolower($data['name'])));

                $category->category_id = $data['category_id'];
                $category->subcategory_id = $data['subcategory_id'];
                
                $category->status = 1;
                $category->save();

                return redirect('admin/subcat')->with('success-message',$message);

            }
            
        return view('Admin.subsubcat.addEdit')->with(compact('category','title','getCategories','subcategoryy'));

    }

    // Append Subcategories

    public function append_subcategories(Request $request)
    {
         $cat_id = $request->category_id; 
         $getSubCategories = Subcategory::where(['category_id'=>$cat_id])->get()->toArray();
         $count = count($getSubCategories);
            if($count !='0') 
            {
                echo'<option value="">Choose SubCategory</option>';
                foreach($getSubCategories as $main_category)
                {
        
                echo'<option value="'.$main_category["id"].'">'.$main_category["name"].'</option>';
                    
                }
            }
            else
            {
                echo'<option value="">No SubCategory Found!!</option>';
            }
        
       
    }

    

    // Append SubSubcategories

    public function append_subcat(Request $request)
    {
         $cat_id = $request->category_id; 
         $getSubCategories = Subcat::where(['subcategory_id'=>$cat_id])->get()->toArray();
         $count = count($getSubCategories);
         
            if($count !='0') 
            {
                echo'<option value="">Choose Sub SubCategory</option>';
                foreach($getSubCategories as $main_category)
                {
        
                echo'<option value="'.$main_category["id"].'">'.$main_category["name"].'</option>';
                    
                }
            }
            else
            {
                echo'<option value="">No Sub SubCategory Found!!</option>';
            }
        
       
    }


}
