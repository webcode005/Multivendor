@extends('Admin.layouts.layouts')
@section('content')

  <!-- Content wrapper -->
  <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              
              <div class="row">
                <div class="col-md-12">
                  
                  <div class="card mb-4">
                    <h5 class="card-header">{{$title}} Details</h5>
                    <form id="formAccountSettings" method="POST" @if(empty($category['id'])) action="{{url('admin/add-edit-subcategory')}}" @else action="{{url('admin/add-edit-subcategory/'.$category['id'])}}" @endif>
                    @csrf
                    <!-- Account -->
                    <div class="card-body">                                             
                  
                        <div class="row">
                         
                          <div class="mb-3 col-md-6">
                            <label for="discount" class="form-label"> Category </label>
                           
                            <select class="form-control"  name="category_id" id="category_idd" required>
                              <option value="">Choose Category</option>
                              @foreach($getCategories as $main_category)
                                  <option value="{{$main_category['id']}}" @if(isset($main_category['id']) && $main_category['id']== $category['category_id'])  selected="" @else   @endif >{{$main_category['category_name']}}</option>
                              @endforeach
                            </select>
                          
                          </div>    
                          
                          <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">SubCategory </label>
                            <input class="form-control" type="text" name="name" id="name"  @if(!empty($category['name']))  value="{{$category->name}}" @else value="" @endif />
                          </div>                     
                          
                          
                        </div>
                        <div class="mt-2 offset-md-5">
                          <button type="submit" class="btn btn-primary me-2">Save changes</button>
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