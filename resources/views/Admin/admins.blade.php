@extends('Admin.layouts.layouts')
@section('content')


          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              
              <!-- Responsive Datatable -->
              <div class="card">
                <h5 class="card-header">{{$title}} Tables</h5>
                                         
                <div class="card-datatable table-responsive">
                  <table class="dt-responsive table border-top">
                    <thead>
                      <tr>
                        <th>Admin ID</th>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>City</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($admins as $admin)
                            <tr>
                                <td>{{ $admin['id']}}</td>
                                <td>{{ $admin['name']}}</td>
                                <td><img width="50px" src="{{ asset('backend/assets/img/profile').'/'.$admin['image']}}" style="border-radius: 50px;"></td>
                                <td>{{ $admin['email']}}</td>
                                <td>{{ $admin['phone']}}</td>
                                <td>{{ $admin['city']}}</td>
                                <td>{{ $admin['type']}}</td>
                                <td>@if($admin['status'] == '1')
                                  <a href="javascript:void(0)" class="updateAdminStatus" id="admin-{{$admin['id']}}" admin_id="{{$admin['id']}}"> <span class="badge bg-success"  id="status" status="Active"> Active </span></a> 
                                  @else <a class="updateAdminStatus" id="admin-{{$admin['id']}}" admin_id="{{$admin['id']}}" href="javascript:void(0)"> <span class="badge bg-danger" id="status" status="InActive"> InActive </span> </a> @endif </td>
                                <td>@if($admin['type'] == 'Vendor')<a href="{{url('admin/view-vendor-details')}}/{{ $admin['id']}}">View Details</a>@endif</td>
                            </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!--/ Responsive Datatable -->
            </div>
            <!-- / Content -->

           
@endsection