@extends('Admin.layouts.layouts')
@section('content')

  <!-- Content wrapper -->
  <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              
              <div class="row">
                <div class="col-md-12">
                  
                  <div class="card mb-4">
                    <h5 class="card-header">Category Details</h5>
                    <form id="formAccountSettings" enctype="multipart/form-data" method="POST" @if(empty($category['id'])) action="{{url('admin/add-edit-category')}}" @else action="{{url('admin/add-edit-category/'.$category['id'])}}" @endif>
                    @csrf
                    <!-- Account -->
                    <div class="card-body">                                             
                  
                        <div class="row">
                          
                          <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Category Name</label>
                            <input class="form-control" type="text" name="name" id="name"  @if(!empty($category['category_name']))  value="{{$category->category_name}}" @else value="" @endif />
                          </div>
                        

                          <div class="mb-3 col-md-6">
                            <label for="discount" class="form-label"> Category Discount</label>
                            <input class="form-control" type="text" name="discount" id="discount" @if(!empty($category['category_discount']))  value="{{$category->category_discount}}" @else value="" @endif />
                          </div>

                          <div class="mb-3 col-md-6">
                            <label for="image" class="form-label"> Category Image</label>
                            <input class="form-control" type="file" name="image" id="image" />
                             @if(!empty($category['category_image'])) 
                               <input class="form-control" type="hidden" name="dbimage" value="{{$category->category_image}}">
                               <br>
                               <img src="{{url(asset('Frontend/assets/images/category')).'/'.$category->category_image}}" width="160px"> 
                             
                             @endif
                          </div>
                          
                          <div class="mb-3 col-md-6">
                            <label for="description" class="form-label">Category Description</label>
                            <input class="form-control" type="text" name="description" id="description" @if(!empty($category['description']))  value="{{$category->description}}" @else value="" @endif />
                          </div>

                          <div class="mb-3 col-md-12"><h4>Seo Related</h4></div>

                          <div class="mb-3 col-md-6">
                            <label for="meta_title" class="form-label">Category Meta Title</label>
                            <input class="form-control" type="text" name="meta_title" id="meta_title"  @if(!empty($category['meta_title']))  value="{{$category->meta_title}}" @else value="" @endif />
                          </div>

                          
                          <div class="mb-3 col-md-6">
                            <label for="meta_keywords" class="form-label">Category Keywords</label>
                            <input class="form-control" type="text" name="meta_keywords" id="meta_keywords"  @if(!empty($category['meta_keywords']))  value="{{$category->meta_keywords}}" @else value="" @endif />
                          </div>
                          
                          <div class="mb-3 col-md-12">
                            <label for="meta_description" class="form-label">Category Meta Description</label>
                            <textarea class="form-control" name="meta_description" id="meta_description">@if(!empty($category['meta_description'])){{$category->meta_description}} @else  @endif </textarea>
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