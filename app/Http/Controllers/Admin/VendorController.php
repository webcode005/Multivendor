<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Session;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\VendorBusinessDetail;
use App\Models\VendorBankDetail;

class VendorController extends Controller
{
    // update

    public function update($slug, Request $request)
    {

        if ($slug =='personal') {

                 
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
                     'photo' => 'required',
                ];

                $customMessage = [
                    'phoneNumber.required' => 'Phone Number Must be Numeric & Required',
                    'city.required' => 'City is required',
                    'state.required' => 'State is required',
                    'address.required' => 'Address is required',
                    'country.required' => 'Country is required',
                    'pincode.required' => 'Pincode is required',
                    'photo.required' => 'Photo is required',
                ];

                $this->validate($request,$rules,$customMessage);

               if(empty($request->photo))

               {
                    $imageName = $request->dbimage; 
               }
               else 
               {
                    $validatedData = $request->validate([
                         'photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
               
                         ]);
                              
                    $imageName = time().'.'.$request->photo->extension();  
          
                    $request->photo->move(public_path('backend/assets/img/profile/'), $imageName);
               }

                // Update Vendor Details

                Vendor::where('id',Auth::guard('admin')->user()->vendor_id)
                         ->update(
                                   [
                                   'photo'=>$imageName,
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

            $vendorDetails = Vendor::where('id',Auth::guard('admin')->user()->vendor_id)->first()->toArray();
            return view('Admin.vendor-details')->with(compact('slug','vendorDetails'));
        }
        elseif ($slug =='business') 
        {
                   
            if($request->isMethod('post'))
            {
                $data = $request->all();
                    //print_r($data); die;

                    $rules = 
                    [
                        'shop_name' => 'required',
                        'shop_email' => 'required',
                        'shop_phone' => 'required|numeric',
                        'shop_address' => 'required',
                        'shop_city' => 'required',
                        'shop_state' => 'required',
                        'shop_country' => 'required',
                        'shop_address_proof' => 'required',
                        'business_license_number' => 'required',
                        'gst_number' => 'required',
                        'pan_number' => 'required',
                        'proof_image' => 'required',
                    ];

                    $customMessage = 
                    [
                        'shop_name.required' => 'Shop Name is Required',
                        'shop_email.required' => 'Shop Email is required',
                        'shop_phone.required' => 'Shop Phone Must be Numeric & Required',
                        'shop_address.required' => 'Shop Address is required',
                        'shop_city.required' => 'Shop City is Required',
                        'shop_state.required' => 'Shop State is required',
                        'shop_country.required' => 'Shop Country is Required',
                        'proof_image.required' => 'Shop Address Proof Image is required',
                        'business_license_number.required' => 'business_license_number is Required',
                        'gst_number.required' => 'GST Number is required',
                        'pan_number.required' => 'PAN Number is Required',
                    ];

                    $this->validate($request,$rules,$customMessage);

                    if(empty($request->proof_image))

                    {
                            $imageName = $request->dbimage; 
                    }
                    else 
                    {
                            $validatedData = $request->validate([
                                'proof_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                    
                                ]);
                                    
                            $imageName = time().'.'.$request->proof_image->extension();  
                
                            $request->proof_image->move(public_path('backend/assets/img/proof/'), $imageName);
                    }

                    // Update Vendor Business Details

                    VendorBusinessDetail::where('vendor_id',Auth::guard('admin')->user()->vendor_id)
                            ->update(
                                        [
                                            'shop_name'=>$data['shop_name'],
                                            'shop_email'=>$data['shop_email'],
                                            'shop_phone'=>$data['shop_phone'],
                                            'shop_address'=>$data['shop_address'],
                                            'shop_city'=>$data['shop_city'],
                                            'shop_state'=>$data['shop_state'],
                                            'shop_country'=>$data['shop_country'],
                                            'shop_address_proof'=>$data['shop_address_proof'],
                                            'proof_image'=>$imageName,
                                            'business_license_number'=>$data['business_license_number'],
                                            'gst_number'=>$data['gst_number'],
                                            'pan_number'=>$data['pan_number'],
                                        ]
                                    );
                            
                            return redirect()->back()->with('success-message', 'Bank Details has been updated successfully !!');
            }


            $vendorBusinessDetails = VendorBusinessDetail::where('id',Auth::guard('admin')->user()->vendor_id)->first()->toArray();
            return view('Admin.vendor-details')->with(compact('slug','vendorBusinessDetails'));
        }
         else 
         {
                  
            if($request->isMethod('post'))
            {
                $data = $request->all();
                    //print_r($data); die;

                    $rules = 
                    [
                        'account_holder_name' => 'required',
                        'bank_name' => 'required',
                        'account_number' => 'required|numeric',
                        'bank_ifsc_code' => 'required',
                    ];

                    $customMessage = 
                    [
                        'account_holder_name.required' => 'Account Holder Name is Required',
                        'bank_name.required' => 'Bank Name is required',
                        'account_number.required' => 'account_number Must be Numeric & Required',
                        'bank_ifsc_code.required' => 'Bank IFSC Code is required',
                    ];

                    $this->validate($request,$rules,$customMessage);

                    // Update Vendor Bank Details

                    VendorBankDetail::where('vendor_id',Auth::guard('admin')->user()->vendor_id)
                            ->update(
                                        [
                                        'account_holder_name'=>$data['account_holder_name'],
                                        'bank_name'=>$data['bank_name'],
                                        'account_number'=>$data['account_number'],
                                        'bank_ifsc_code'=>$data['bank_ifsc_code'],
                                        ]
                                    );
                            
                            return redirect()->back()->with('success-message', 'Bank Details has been updated successfully !!');
            }

            $vendorBankDetails = VendorBankDetail::where('id',Auth::guard('admin')->user()->vendor_id)->first()->toArray();
            return view('Admin.vendor-details')->with(compact('slug','vendorBankDetails'));
         }

         
    
    }

    public function view_vendor_details($id)
    {
        
        $vendorDetails = Admin::with('VendorPersonal','VendorBusiness','VendorBank')->where('id',$id)->first();
        $vendorDetails = json_decode(json_encode($vendorDetails),True);

        // dd($vendorDetails); 
        return view('Admin.view-vendor-details')->with(compact('vendorDetails'));
    }



}
