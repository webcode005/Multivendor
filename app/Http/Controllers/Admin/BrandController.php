<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

use Session;

class BrandController extends Controller
{
    public function brands()
    {       
            Session::put('page',"brands");
            $brands = Brand::select("*")
            ->orderBy('id', 'DESC')
            ->get();

            $title = "Brands";

            return view('Admin.brands.brand')->with(compact('brands','title'));


    }
    public function update_brand_status(Request $request)
    {
        $data = $request->all();

        if ($data['status'] == "Active") {
            $status = "0";
        } 
        else 
        {
            $status = "1";
        }

        Brand::where('id',$data['brand_id'])->update(['status'=>$status]);
        return response()->json(['status'=>$status,'brand_id'=>$data['brand_id']]);
        
    }

    public function delete_brand($id)
    {
        Brand::where('id',$id)->delete();
        $message = "Brand Deleted Successfully";
        return redirect()->back()->with('success-message',$message);
    }

    // Add Edit brand

    public function addEdit_brand(Request $request,$id = Null)
    {       

        if($id == Null)
        {
            $title = "Add Brand";
            $brands = new Brand;
            $message = "Brand Added Succcessfully!!";
        }
        else
        {

            $title = "Edit Brand";
            $brands =  Brand::find($id);
            $message = "Brand Updated Succcessfully!!";
           
        }

            if($request->isMethod('post'))
            {
                $data =$request->all();

                //print_r($data['name']); die;

                $rules = ["name" =>'required'];

                $customMessage = ["name.required" => "brand Name is required"];

                $this->validate($request,$rules,$customMessage);

                $brands->name = $data['name'];
                $brands->status = 1;
                $brands->save();

                return redirect('admin/brands')->with('success-message',$message);

            }
            
        return view('Admin.brands.addEdit')->with(compact('brands','title'));

    }
    










}
