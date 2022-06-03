@extends('admin.layouts.layouts')
@section('content')

  <!-- Content wrapper -->
  <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Vendor /</span> {{ucfirst($slug)}} Details</h4>

            @if ($slug =="personal") 

            <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{url('/admin/setting')}}"
                        ><i class="bx bx-lock-alt me-1"></i> Security</a
                      >
                    </li>
                    <!-- <li class="nav-item">
                      <a class="nav-link" href="pages-account-settings-billing.html"
                        ><i class="bx bx-detail me-1"></i> Billing & Plans</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="pages-account-settings-notifications.html"
                        ><i class="bx bx-bell me-1"></i> Notifications</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="pages-account-settings-connections.html"
                        ><i class="bx bx-link-alt me-1"></i> Connections</a
                      >
                    </li> -->
                  </ul>
                  <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <form id="formAccountSettings" method="POST" action="{{url('admin/update-vendor-details/personal')}}" enctype="multipart/form-data">
                    @csrf
                    <!-- Account -->
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible" role="alert">
                            @foreach ($errors->all() as $error) 
                              <li>{{ $error }}</li>
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        @endif

                        @if(Session::has('error-message'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                            Error: {{ Session::get('error-message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        @endif
                        @if(Session::has('success-message'))
                              <div class="alert alert-success alert-dismissible" role="alert">
                              Success:  {{ Session::get('success-message') }}
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <input type="hidden" name="dbimage" value="{{$vendorDetails['photo']}}">
                        <img src="{{ url('backend/assets/img/profile')}}/{{$vendorDetails['photo']}}" alt="user-avatar" class="d-block rounded"  height="100"  width="100" id="uploadedAvatar" />
                        <div class="button-wrapper">
                          <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Upload new photo</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" name="photo" >
                          </label>
                          <button type="button" class="btn btn-label-secondary account-image-reset mb-4">
                            <i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Reset</span>
                          </button>

                          <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                        </div>
                      </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                  
                        <div class="row">
                          
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label"> Name</label>
                            <input class="form-control" type="text" readonly name="lastName" id="lastName" value="{{$vendorDetails['name']}}" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input class="form-control" type="text" id="email" name="email" value="{{$vendorDetails['email']}}"
                              placeholder="john.doe@example.com" readonly />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="Company" class="form-label">Company</label>
                            <input type="text" class="form-control" id="Company" name="company" value="{{Auth::guard('admin')->user()->company}}"  readonly />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">Phone Number</label>
                            <div class="input-group input-group-merge">
                              <span class="input-group-text">IN (+91)</span>
                              <input type="text" id="phoneNumber" name="phoneNumber"  class="form-control" placeholder="202 555 0111" minlength="10" maxlength="10" value="{{$vendorDetails['phone']}}" />
                            </div>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address"  value="{{$vendorDetails['address']}}"  placeholder="Address" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city"  value="{{$vendorDetails['city']}}"  placeholder="Address" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">State</label>
                            <input class="form-control" type="text" id="state" name="state" placeholder="California"  value="{{$vendorDetails['state']}}"/>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="pincode" class="form-label">Zip Code</label>
                            <input type="text" class="form-control" id="pincode" name="pincode" placeholder="231465" maxlength="6" value="{{$vendorDetails['pincode']}}">
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="country">Country</label>
                            <select id="country" name="country" class="select2 form-select">
                              
                              <option value="{{$vendorDetails['country']}}">{{$vendorDetails['country']}}</option>
                              <option value="">Select</option>
                              <option value="Australia">Australia</option>
                              <option value="Bangladesh">Bangladesh</option>
                              <option value="Belarus">Belarus</option>
                              <option value="Brazil">Brazil</option>
                              <option value="Canada">Canada</option>
                              <option value="China">China</option>
                              <option value="France">France</option>
                              <option value="Germany">Germany</option>
                              <option value="India">India</option>
                              <option value="Indonesia">Indonesia</option>
                              <option value="Israel">Israel</option>
                              <option value="Italy">Italy</option>
                              <option value="Japan">Japan</option>
                              <option value="Korea">Korea, Republic of</option>
                              <option value="Mexico">Mexico</option>
                              <option value="Philippines">Philippines</option>
                              <option value="Russia">Russian Federation</option>
                              <option value="South Africa">South Africa</option>
                              <option value="Thailand">Thailand</option>
                              <option value="Turkey">Turkey</option>
                              <option value="Ukraine">Ukraine</option>
                              <option value="United Arab Emirates">United Arab Emirates</option>
                              <option value="United Kingdom">United Kingdom</option>
                              <option value="United States">United States</option>
                            </select>
                          </div>
                          
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Save changes</button>
                          
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>                
                </div>
              </div>
              
            @elseif ($slug =="business") 

            <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Business</a>
                    </li>
                    
                  </ul>
                  <div class="card mb-4">
                    <h5 class="card-header">Business Details</h5>
                    <form id="formAccountSettings" method="POST" action="{{url('admin/update-vendor-details/business')}}" enctype="multipart/form-data">
                    @csrf
                    
                    <hr class="my-0" />
                    <div class="card-body">
                    @if($errors->any())
                            <div class="alert alert-danger alert-dismissible" role="alert">
                            @foreach ($errors->all() as $error) 
                              <li>{{ $error }}</li>
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        @endif

                        @if(Session::has('error-message'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                            Error: {{ Session::get('error-message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        @endif
                        @if(Session::has('success-message'))
                              <div class="alert alert-success alert-dismissible" role="alert">
                              Success:  {{ Session::get('success-message') }}
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                  
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Shop Name</label>
                            <input class="form-control" type="text" id="shop_name" name="shop_name"
                              value="{{$vendorBusinessDetails['shop_name']}}" readonly  />
                          </div>
                          
                          <div class="mb-3 col-md-6">
                            <label for="shop_email" class="form-label">E-mail</label>
                            <input class="form-control" type="text" id="shop_email" name="shop_email" value="{{$vendorBusinessDetails['shop_email']}}"
                              placeholder="john.doe@example.com" readonly />
                          </div>
                         
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">Phone Number</label>
                            <div class="input-group input-group-merge">
                              <span class="input-group-text">IN (+91)</span>
                              <input type="text" id="shop_phone" name="shop_phone" class="form-control" placeholder="202 555 0111" minlength="10" maxlength="10" value="{{$vendorBusinessDetails['shop_phone']}}"/>
                            </div>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="shop_address" class="form-label">Shop Address</label>
                            <input type="text" class="form-control" id="shop_address" name="shop_address"  value="{{$vendorBusinessDetails['shop_address']}}"  placeholder="Address" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="shop_city" class="form-label">Shop City</label>
                            <input type="text" class="form-control" id="shop_city" name="shop_city"  value="{{$vendorBusinessDetails['shop_city']}}"  placeholder="Address" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="shop_state" class="form-label">Shop State</label>
                            <input class="form-control" type="text" id="shop_state" name="shop_state" placeholder="California"  value="{{$vendorBusinessDetails['shop_state']}}"/>
                          </div>
                          
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="shop_country">Shop Country</label>
                            <select id="shop_country" name="shop_country" class="select2 form-select">
                              
                              <option value="{{$vendorBusinessDetails['shop_country']}}">{{$vendorBusinessDetails['shop_country']}}</option>
                              <option value="">Select</option>
                              <option value="Australia">Australia</option>
                              <option value="Bangladesh">Bangladesh</option>
                              <option value="Belarus">Belarus</option>
                              <option value="Brazil">Brazil</option>
                              <option value="Canada">Canada</option>
                              <option value="China">China</option>
                              <option value="France">France</option>
                              <option value="Germany">Germany</option>
                              <option value="India">India</option>
                              <option value="Indonesia">Indonesia</option>
                              <option value="Israel">Israel</option>
                              <option value="Italy">Italy</option>
                              <option value="Japan">Japan</option>
                              <option value="Korea">Korea, Republic of</option>
                              <option value="Mexico">Mexico</option>
                              <option value="Philippines">Philippines</option>
                              <option value="Russia">Russian Federation</option>
                              <option value="South Africa">South Africa</option>
                              <option value="Thailand">Thailand</option>
                              <option value="Turkey">Turkey</option>
                              <option value="Ukraine">Ukraine</option>
                              <option value="United Arab Emirates">United Arab Emirates</option>
                              <option value="United Kingdom">United Kingdom</option>
                              <option value="United States">United States</option>
                            </select>
                          </div>


                          <div class="mb-3 col-md-6">
                            <label for="business_license_number" class="form-label">Business License Number</label>
                            <input type="text" class="form-control"  id="business_license_number" name="business_license_number" placeholder="231465" value="{{$vendorBusinessDetails['business_license_number']}}">
                          </div>

                          <div class="mb-3 col-md-6">
                            <label for="gst_number" class="form-label">GST Number</label>
                            <input type="text" class="form-control" id="gst_number" name="gst_number" placeholder="231465" maxlength="13"value="{{$vendorBusinessDetails['gst_number']}}"/>
                          </div>

                          <div class="mb-3 col-md-6">
                            <label for="pan_number" class="form-label">Pan Number</label>
                            <input type="text" class="form-control" id="pan_number" name="pan_number" placeholder="231465" maxlength="10" value="{{$vendorBusinessDetails['pan_number']}}" />
                          </div>
                          
                          <div class="mb-3 col-md-6">
                            <label for="shop_address_proof" class="form-label">Shop Address Proof</label>
                            <input type="text" class="form-control" id="shop_address_proof" name="shop_address_proof" placeholder="231465" maxlength="6" value="{{$vendorBusinessDetails['shop_address_proof']}}">
                          </div>
                          
                          <div class="mb-3 col-md-6">
                            <label for="shop_address_proof" class="form-label">Shop Address Proof</label>
                            <input type="text" class="form-control" id="shop_address_proof" name="shop_address_proof" placeholder="231465" maxlength="6" value="{{$vendorBusinessDetails['shop_address_proof']}}">
                          </div>

                          <div class="col-md-6 mb-3">
                          <label for="shop_address_proof_image" class="form-label">Shop Address Proof Image</label>
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <input type="hidden" name="dbimage" value="{{$vendorBusinessDetails['proof_image']}}">
                                    <img src="{{ url('backend/assets/img/proof')}}/{{$vendorBusinessDetails['proof_image']}}" alt="Shop Address Proof Image" class="d-block rounded"  height="100"  width="100" id="uploadedAvatar" />
                                    <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block">Upload Proof Image</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" name="proof_image" >
                                    </label>
                                    <button type="button" class="btn btn-label-secondary account-image-reset mb-4">
                                        <i class="bx bx-reset d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Reset</span>
                                    </button>

                                    <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                </div>
                            </div>
                          </div>
                          
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Save changes</button>
                          
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>                
                </div>
              </div>
            
            @elseif ($slug =="bank")

            <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Bank</a>
                    </li>
                    <!-- <li class="nav-item">
                      <a class="nav-link" href="{{url('/admin/setting')}}"
                        ><i class="bx bx-lock-alt me-1"></i> Security</a
                      >
                    </li> -->
                    <!-- <li class="nav-item">
                      <a class="nav-link" href="pages-account-settings-billing.html"
                        ><i class="bx bx-detail me-1"></i> Billing & Plans</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="pages-account-settings-notifications.html"
                        ><i class="bx bx-bell me-1"></i> Notifications</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="pages-account-settings-connections.html"
                        ><i class="bx bx-link-alt me-1"></i> Connections</a
                      >
                    </li> -->
                  </ul>
                  <div class="card mb-2">
                    <h5 class="card-header">Bank Details</h5>
                   
                    <hr class="my-0" />
                    <div class="card-body">
                    @if($errors->any())
                            <div class="alert alert-danger alert-dismissible" role="alert">
                            @foreach ($errors->all() as $error) 
                              <li>{{ $error }}</li>
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        @endif

                        @if(Session::has('error-message'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                            Error: {{ Session::get('error-message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        @endif
                        @if(Session::has('success-message'))
                              <div class="alert alert-success alert-dismissible" role="alert">
                              Success:  {{ Session::get('success-message') }}
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                    <form id="formAccountSettings" method="POST" action="{{url('admin/update-vendor-details/bank')}}">
                        @csrf
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="account_holder_name" class="form-label">Account Holder Name</label>
                            <input class="form-control" type="text" id="account_holder_name" name="account_holder_name" value="{{$vendorBankDetails['account_holder_name']}}"/>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="Company" class="form-label">Company</label>
                            <input type="text" class="form-control" id="Company" name="company"value="{{Auth::guard('admin')->user()->company}}"  readonly />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="bank_name" class="form-label">Bank Name</label>
                            <input class="form-control" type="text" name="bank_name" id="bank_name" value="{{$vendorBankDetails['bank_name']}}" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="account_number" class="form-label">Account Number</label>
                            <input class="form-control" type="text" id="account_number" name="account_number" value="{{$vendorBankDetails['account_number']}}"
                              placeholder="97854654465">
                          </div>
                         
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="bank_ifsc_code">Bank IFSC Code</label>
                                                          
                            <input type="text" id="bank_ifsc_code"  name="bank_ifsc_code" class="form-control" placeholder="SBIN0111" value="{{$vendorBankDetails['bank_ifsc_code']}}">
                            
                          </div>
                          
                          
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Save changes</button>
                          
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>                
                </div>
              </div>

            @endif       


             
            </div>
            <!-- / Content -->

         

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->

@endsection