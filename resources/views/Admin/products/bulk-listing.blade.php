@extends('Admin.layouts.layouts')
@section('content')

  <!-- Content wrapper -->
  <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              
              <div class="row">
                <div class="col-md-12">
                  
                  <div class="card mb-4">
                    <h5 class="card-header">Bulk Product Listing</h5>
                    <form id="formAccountSettings" enctype="multipart/form-data" method="POST" action="{{url('admin/bulk-listing')}}">
                    @csrf
                    <!-- Account -->
                    <div class="card-body">                                             
                  
                        <div class="row">
                          

                          <div class="mb-3 col-md-6">
                            <label for="image" class="form-label"> CSV File</label>
                            <input class="form-control1" type="file" name="file" id="image" required>
                            
                          </div>  
                          <br>
                          <a href="{{url('backend/assets/uploads/product_listing.csv')}}">Sample File</a>
                          <br>                      
                         
                        </div>
                        <div class="mt-2 offset-md-5">
                          <button type="submit" class="btn btn-primary me-2">Upload</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                  
                </div>
              </div>
            </div>
            <!-- / Content -->

         </div>
          <!-- Content wrapper -->

@endsection