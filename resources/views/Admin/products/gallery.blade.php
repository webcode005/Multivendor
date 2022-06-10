@extends('Admin.layouts.layouts')
@section('content')

  <!-- Content wrapper -->
  <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              
              <div class="row">
                <div class="col-md-12">
                  
                  <div class="card mb-4">
                    <h5 class="card-header">Bulk Product Image</h5>
                    <form id="formAccountSettings" enctype="multipart/form-data" method="POST" action="{{url('admin/add-product-image')}}">
                    @csrf
                    <!-- Account -->
                    <div class="card-body">                                             
                  
                        <div class="row">
                          

                          <div class="mb-3 col-md-6">
                            <label for="image" class="form-label"> Choose Multiple Images</label>
                            <input class="form-control1" type="file" name="image[]" multiple id="image" required/>
                            
                          </div>                        
                         
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
             <h5 class="card-header">{{$title}} Tables </h5>
             <div class="card-datatable table-responsive">
               <table class="dt-responsive1 table border-top" id="example">
                 <thead>
                   <tr>
                     <th>ID</th>
                     <th>File Name</th> 
                     <th>Image</th>                      
                     <th>Uploaded_by</th>
                     <!-- <th>Status</th> -->
                     <th>Action</th>
                   </tr>
                 </thead>
                 <tbody>
                     <?php $ik='1';?>
                     @foreach($product_images as $pimg)                        

                     <tr>
                         <td>{{ $ik++;}}</td>                            
                         <td>{{ $pimg['file_name']}}</td>
                         <td><img src="{{url('Frontend/assets/images/product').'/'.$pimg['file_name']}}" width="150px"></td>
                         
                         <td>@if($pimg['uploaded_by'] == '1') Admin @else  <a href="{{url('admin/view-vendor-details').'/'.$pimg['admin_id']}}">Vendor {{ '('.$pimg['Adminname'].')'}}</a>@endif</td>                            
                         
                         <td><a class="btn btn-sm btn-primary" href="{{url('admin/edit-product-gallery-image').'/'.$pimg['id']}}">Update</a> | <a class="btn btn-sm btn-danger deleteproduct" title="Product" href="{{url('admin/delete-product-gallery-image')}}/{{ $pimg['id']}}">Delete</a></td>
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





            </div>
            <!-- / Content -->

         </div>
          <!-- Content wrapper -->

@endsection