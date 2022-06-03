<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Session;
use App\Models\Admin;

class AdminController extends Controller
{
    
    public function login()
    {
          return view('Admin.login');
    }
    
     public function signin(Request $request)
    {
         if ($request->isMethod('post')) {
              $data = $request->all();
              //print_r($data); 
               //echo $password = Hash::make(123456);
              // die;

              if (Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password'],'status'=>1])) {
                   return redirect('admin/dashboard');
              }
              else 
              {
               return redirect()->back()->with('error-message','Invalid Email or Password!');
              }
              
         }
         
         return view('Admin.login');    
       
    }
    public function logout()
    {
          Auth::guard('admin')->logout();
                return redirect('admin/login')->with('success-message','You Have Successfully Logout!!');
    }

    public function dashboard()
    {
          Session::put('page',"dashboard");
          return view('Admin.dashboard');
       
    }
   
    public function profile(Request $request)
    {
          if($request->isMethod('post'))
          {
               $data = $request->all();
                //print_r($data); die;

                $rules = [
                     'phoneNumber' => 'required|numeric',
                     'city' => 'required',
                     'state' => 'required',
                     'address' => 'required',
                     'country' => 'required',
                     'pincode' => 'required',
                ];

                $customMessage = [
                    'phoneNumber.required' => 'Phone Number Must be Numeric & Required',
                    'city.required' => 'City is required',
                    'state.required' => 'State is required',
                    'address.required' => 'Address is required',
                    'country.required' => 'Country is required',
                    'pincode.required' => 'Pincode is required',
                ];

                $this->validate($request,$rules,$customMessage);

               if(empty($request->image))

               {
                    $imageName = $request->dbimage; 
               }
               else 
               {
                    $validatedData = $request->validate([
                         'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
               
                         ]);
                              
                    $imageName = time().'.'.$request->image->extension();  
          
                    $request->image->move(public_path('backend/assets/img/profile/'), $imageName);
               }

                // Update Admin Details

                Admin::where('id',Auth::guard('admin')->user()->id)
                         ->update(
                                   [
                                   'image'=>$imageName,
                                   'phone'=>$data['phoneNumber'],
                                   'address'=>$data['address'],
                                   'city'=>$data['city'],
                                   'state'=>$data['state'],
                                   'pincode'=>$data['pincode'],
                                   'country'=>$data['country'],
                                   ]
                                 );
                         
                         return redirect()->back()->with('success-message', 'Profile has been updated successfully !!');
          }
     
     
     
     $adminDetails = Admin::where('email',Auth::guard('admin')->user()->email)->first()->toArray();
          
          
          return view('Admin.profile')->with(compact('adminDetails'));
       
    }

    public function setting(Request $request)
    {
         //echo"<pre>"; print_r(Auth::guard('admin')->user()); die;
          if($request->isMethod('post'))
          {
               $data = $request->all();
               // print_r($data); die;

               // check current password
               if(Hash::check($data['currentPassword'],Auth::guard('admin')->user()->password))
               {
                    // check new password and confirm password
                    if($data['newPassword']==$data['confirmPassword'])
                    {
                         Admin::where('id',Auth::guard('admin')->user()->id)->update(['pass'=>$data['newPassword'],'password'=>bcrypt($data['newPassword'])]);
                         
                         return redirect()->back()->with('success-message', 'Password has been updated successfully !!');
                    }
                    else
                    {
                         return redirect()->back()->with('error-message', 'Your New password & Confirm Password Not Match !!');
                    }

               }
               else
               {
                    return redirect()->back()->with('error-message', 'Your Current password is Incorrect !!');
               }
          }
         
         $adminDetails = Admin::where('email',Auth::guard('admin')->user()->email)->first()->toArray();     
     
          return view('Admin.setting')->with(compact('adminDetails'));
       
    }

    public function checkAdminPassword(Request $request)
    {
        $data = $request->all(); 
        //print_r($data['currentPassword']); die;
          if (Hash::check($data['currentPassword'],Auth::guard('admin')->user()->password)) {
               return "true";
          }
          else
          {
               return "false";
          }

    }

    public function admins($type=null)
    {
     $admins = Admin::query();
     if (!empty($type)) {
          $admins = $admins->where('type',$type);
          $title = ucfirst($type).'s';
          Session::put('page',"view_".strtolower($title));
     }  
     else
     {
          $title = "All Admins/Subadmins/Vendors";
          Session::put('page',"view_all");
     }   
         $admins = $admins->get()->toArray();

         return view('Admin.admins')->with(compact('admins','title'));
    }

    public function update_admin_status(Request $request)
    {
         $data = $request->all();

         if ($data['status'] == "Active") {
              $status = "0";
         } 
         else 
         {
          $status = "1";
         }

         Admin::where('id',$data['admin_id'])->update(['status'=>$status]);
         return response()->json(['status'=>$status,'admin_id'=>$data['admin_id']]);
         
    }



}
