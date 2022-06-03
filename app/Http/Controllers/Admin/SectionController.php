<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;

use Session;

class SectionController extends Controller
{
    public function sections()
    {       
            Session::put('page',"sections");
            $sections = Section::select("*")
            ->orderBy('id', 'DESC')
            ->get();

            $title = "Sections";

            return view('Admin.sections.section')->with(compact('sections','title'));


    }
    public function update_section_status(Request $request)
    {
        $data = $request->all();

        if ($data['status'] == "Active") {
            $status = "0";
        } 
        else 
        {
            $status = "1";
        }

        Section::where('id',$data['section_id'])->update(['status'=>$status]);
        return response()->json(['status'=>$status,'section_id'=>$data['section_id']]);
        
    }

    public function delete_section($id)
    {
        Section::where('id',$id)->delete();
        $message = "Section Deleted Successfully";
        return redirect()->back()->with('success-message',$message);
    }

    // Add Edit Section

    public function addEdit_section(Request $request,$id = Null)
    {       

        if($id == Null)
        {
            $title = "Add Section";
            $sections = new Section;
            $message = "Section Added Succcessfully!!";
        }
        else
        {

            $title = "Edit Section";
            $sections =  Section::find($id);
            $message = "Section Updated Succcessfully!!";
           
        }

            if($request->isMethod('post'))
            {
                $data =$request->all();

                //print_r($data['name']); die;

                $rules = ["name" =>'required'];

                $customMessage = ["name.required" => "Section Name is required"];

                $this->validate($request,$rules,$customMessage);

                $sections->name = $data['name'];
                $sections->status = 1;
                $sections->save();

                return redirect('admin/sections')->with('success-message',$message);

            }
            
        return view('Admin.sections.addEdit')->with(compact('sections','title'));

    }
    










}