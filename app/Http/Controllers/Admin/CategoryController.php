<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Section;

use Session;


class CategoryController extends Controller
{
    
    public function categories()
    {
        $categories = Category::orderBy('id','DESC')->get()->toArray();

        Session::put('page',"categories");
        $title  = "Categories";

        //dd($categories);

        return view('Admin.categories.category')->with(compact('categories','title'));
    }

    
    public function update_category_status(Request $request)
    {
        $data = $request->all();

        if ($data['status'] == "Active") {
            $status = "0";
        } 
        else 
        {
            $status = "1";
        }

        Category::where('id',$data['category_id'])->update(['status'=>$status]);
        return response()->json(['status'=>$status,'category_id'=>$data['category_id']]);
        
    }

    public function delete_category($id)
    {
        category::where('id',$id)->delete();
        $message = "Category Deleted Successfully";
        return redirect()->back()->with('success-message',$message);
    }

    // Append Section Level

    public function append_section_level(Request $request)
    {
        $data = $request->all();
       
        $getCategories = Section::with('subCategories')->where(['parent_id'=>0,'section_id'=>$data['section_id']])->get()->toArray();
        return view('Admin.categories.append-section-level')->with(compact('getCategories'));
    }


      // Append Category Level

      public function append_category_level(Request $request)
      {
          $data = $request->all();
         
          $getCategories = Category::where(['status'=>1,'category_id'=>$data['category_id']])->get()->toArray();
          return view('Admin.categories.append-category-level')->with(compact('getCategories'));
      }

    // Add Edit category

    public function addEdit_category(Request $request,$id = Null)
    {     
        //print_r($request->all())  ; die;

        if($id == Null)
        {
            $title = "Add Category";
            $category = new Category;
            //$getCategories = array();
            $message = "Category Added Successfully!!";
        }
        else
        {

            $title = "Edit Category";
            $category =  Category::find($id);
            //$getCategories = Category::with('subCategories')->where(['parent_id'=>0,'section_id'=>$category['section_id']])->get();
            $message = "Category Updated Successfully!!";
           
        }

        // $getSections = Section::get()->toArray();

            if($request->isMethod('post'))
            {
                $data =$request->all();

                //print_r($data); die;

                if(empty($request->image))

                {
                    $imageName = $request->dbimage; 
                }
                else 
                {
                    if($request->hasFile('image'))
                    {
                        $imageName = time().'.'.$request->image->extension();  
             
                        $request->image->move(public_path('Frontend/assets/images/category/'), $imageName);
                    }
                    
                }           

                $rules = 
                        [
                            "name" =>'required',
                            // "parent" =>'required',
                            // "section" =>'required',
                            // "discount" =>'required',
                            // "description" =>'required',
                            "meta_title" =>'required',
                            "meta_description" =>'required',
                            "meta_keywords" =>'required',
                        ];                                
                          
                $customMessage = 
                                [
                                    "name.required" => "Category Name is required",
                                    // "parent.required" => "Category Parent ID is required",
                                    // "section.required" => "Category Section is required",
                                    "meta_title.required" => "Category Meta Title is required",
                                    "meta_description.required" => "Category Meta Description is required",
                                    'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                                    
                                 ];

                $this->validate($request,$rules,$customMessage);

                // $category->parent_id = $data['parent'];
                // $category->section_id = $data['section'];
                $category->category_name = $data['name'];
                $category->category_image = $imageName;
                $category->category_discount = $data['discount'];
                $category->description = $data['description'];
                $category->url = preg_replace('/[^a-z0-9-]+/', '-', trim(strtolower($data['name'])));
                $category->meta_title = $data['meta_title'];
                $category->meta_description = $data['meta_description'];                
                $category->meta_keywords = $data['meta_keywords'];
                $category->status = 1;
                $category->save();

                return redirect('admin/categories')->with('success-message',$message);

            }
            
        return view('Admin.categories.addEdit')->with(compact('category','title'));

    }


}
