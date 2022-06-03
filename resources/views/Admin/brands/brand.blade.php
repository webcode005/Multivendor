@extends('admin.layouts.layouts')
@section('content')


          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row">
                                                         
                                @if ($message = Session::get('success-message'))
                                <br><br>
                                <div class="col-md-12">                                                       
                                    <div class="alert alert-dark alert-dismissible" role="alert">
                                      {{ $message }}
                                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>                                        
                                    </div>
                                </div>
                                        
                                    @endif
                                    @if ($errors->any())
                                    <br><br>
                                    <div class="alert alert-danger">
                                        <strong>Opps!</strong> Something went wrong<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                
                            </div>
              
              <!-- Responsive Datatable -->
              <div class="card">
                <h5 class="card-header">{{$title}} Tables <a href="/admin/add-edit-brand" class="btn btn-success btn-md" style="float: right;">Add Brand</a></h5>
                <div class="card-datatable table-responsive">
                  <table class="dt-responsive table border-top" id="example">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php $ik='1';?>
                        @foreach($brands as $brand)
                            <tr>
                                <td>{{ $ik++;}}</td>
                                <td>{{ $brand['name']}}</td>
                                
                                <td>@if($brand['status'] == '1')
                                  <a href="javascript:void(0)" class="updatebrandStatus" id="brand-{{$brand['id']}}" brand_id="{{$brand['id']}}"> <span class="badge bg-success"  id="status" status="Active"> Active </span></a> 
                                  @else <a class="updatebrandStatus" id="brand-{{$brand['id']}}" brand_id="{{$brand['id']}}" href="javascript:void(0)"> <span class="badge bg-danger" id="status" status="InActive"> InActive </span> </a> @endif </td>
                                
                                <td><a class="btn btn-sm btn-primary" href="{{url('admin/add-edit-brand')}}/{{ $brand['id']}}">Edit</a> | <a class="btn btn-sm btn-danger deletebrand" title="brands" href="{{url('admin/delete-brand')}}/{{ $brand['id']}}">Delete</a></td>
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