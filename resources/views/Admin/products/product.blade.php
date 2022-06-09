@extends('Admin.layouts.layouts')
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
                <h5 class="card-header">{{$title}} Tables <a href="/admin/add-edit-product" class="btn btn-success btn-md" style="float: right;">Add Product</a></h5>
                <div class="card-datatable table-responsive">
                  <table class="dt-responsive1 table border-top" id="example">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Category</th>
                        <th>SubCategory</th>
                        <th>SubCat</th>
                        <th>Brand</th>
                        <th>Url</th>
                        <th>Color</th>
                        <th>Uploaded_by</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php $ik='1';?>
                        @foreach($products as $product)                        

                        <tr>
                            <td>{{ $ik++;}}</td>                            
                            <td>{{ $product['product_name']}}</td>
                            <td>{{ $product['product_code']}}</td>
                            <td>{{ $product['category_name']}}</td>
                            <td>{{ $product['subname']}}</td>
                            <td>{{ $product['sname']}}</td>
                            <td>{{ $product['bname']}}</td>
                            <td>{{ $product['product_url']}}</td>
                            <td>{{ $product['product_color']}}</td>
                            <td>@if($product['vendor_id'] == '0') {{$product['admin_type']}} @else  <a href="{{url('admin/view-vendor-details').'/'.$product['admin_id']}}">{{ $product['admin_type'].' ('.$product['Adminname'].')'}}</a>@endif</td>                            
                            <td>@if($product['status'] == '1')
                              <a href="javascript:void(0)" class="updateProductStatus" id="product-{{$product['id']}}" product_id="{{$product['id']}}"> <span class="badge bg-success"  id="status" status="Active"> Active </span></a> 
                              @else <a class="updateProductStatus" id="product-{{$product['id']}}" product_id="{{$product['id']}}" href="javascript:void(0)"> <span class="badge bg-danger" id="status" status="InActive"> InActive </span> </a> @endif </td>
                            
                            <td><a class="btn btn-sm btn-primary" href="{{url('admin/add-edit-product')}}/{{ $product['id']}}">Edit</a> | <a class="btn btn-sm btn-danger deleteproduct" title="Product" href="{{url('admin/delete-product')}}/{{ $product['id']}}">Delete</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!--/ Responsive Datatable -->
            </div>
            <!-- / Content -->

<script type="text/javascript">
	$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
            
@endsection

