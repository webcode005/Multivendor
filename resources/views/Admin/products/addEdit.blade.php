@extends('Admin.layouts.layouts')
@section('content')

  <!-- Content wrapper -->
  <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              
              <div class="row">
                <div class="col-md-12">
                  
                  <div class="card mb-4">
                    <h5 class="card-header">Product Details</h5>
                    <form id="formAccountSettings" enctype="multipart/form-data" method="POST" @if(empty($product['id'])) action="{{url('admin/add-edit-product')}}" @else action="{{url('admin/add-edit-product/'.$product['id'])}}" @endif>
                    @csrf
                    <!-- Account -->
                    <div class="card-body">                                             
                  
                        <div class="row">

                         <div class="mb-3 col-md-12">
                            <label for="pname" class="form-label">Product Name</label>
                            <input class="form-control" type="text" name="prod_name" id="pname"  @if(!empty($product['product_name']))  value="{{$product->product_name}}" @else value="" @endif />
                          </div>

                          <div class="mb-3 col-md-12">
                            <label for="image" class="form-label"> Product Image</label>
                            <input class="form-control1" type="file" name="product_image" id="image" accept="image/*">
                             @if(!empty($product['product_image'])) 
                               <input class="form-control" type="hidden" name="dbimage" value="{{$product->product_image}}">
                               <br>
                               <img src="{{url(asset('Frontend/assets/images/product')).'/'.$product->product_image}}" width="160px"> 
                               <br>
                               <a href="{{url('admin/remove-product-image').'/'.$product->id}}">Delete Image</a>
                             @endif
                          </div>
                          
                          <div class="mb-3 col-md-4">
                            <label for="cname" class="form-label">Product Category</label>
                            
                            <select class="form-control" name="category_id" id="category_id">
                                <option value="">Choose Category</option>
                                @foreach($getCategories as $categories)
                                      <option value="{{$categories['id']}}" @if(!empty($product['category_id']) && $categories['id'] == $product['category_id'])  selected @else  @endif>{{$categories['category_name']}}</option>
                                @endforeach
                            </select>                            
                            
                          </div>

                          
                          <div class="mb-3 col-md-4">
                            <label for="name" class="form-label">SubCategory Name</label>
                            
                            <select class="form-control" name="subcategory_id" id="appendCategoryLevel">
                                <option value="">Choose SubCategory</option>

                                @foreach($getSubCategories as $scategories)
                                      <option value="{{$scategories['id']}}" @if(!empty($product['subcategory_id']) && $scategories['id'] == $product['subcategory_id'])  selected @else  @endif>{{$scategories['name']}}</option>
                                @endforeach
                            </select>                            
                            
                          </div>

                          
                          <div class="mb-3 col-md-4">
                            <label for="ssname" class="form-label">Sub SubCategory Name</label>
                            
                            <select class="form-control" name="subcat_id"  id="appendSubCat">
                                <option value="">Choose Sub SubCategory</option>
                                @foreach($getSubCats as $scats)
                                      <option value="{{$scats['id']}}" @if(!empty($product['subcat_id']) && $scats['id'] == $product['subcat_id'])  selected @else  @endif>{{$scats['name']}}</option>
                                @endforeach
                            </select>                            
                            
                          </div>
                        
                          <div class="mb-3 col-md-6">
                            <label for="bname" class="form-label">Brand</label>
                            
                            <select class="form-control"  name="brand_id" id="bname">
                                <option value="">Choose Brand</option>
                                @foreach($getBrands as $brands)
                                      <option value="{{$brands['id']}}" @if(!empty($product['brand_id']) && $brands['id'] == $product['brand_id'])  selected @else  @endif>{{$brands['name']}}</option>
                                @endforeach
                            </select>                            
                            
                          </div>


                          <div class="mb-3 col-md-6">
                            <label for="pcname" class="form-label">Product Code(SKU)</label>
                            <input class="form-control" type="text" name="product_code" id="pcname"  @if(!empty($product['product_code']))  value="{{$product->product_code}}" @else value="" @endif />
                          </div>

                          <div class="mb-3 col-md-6">
                            <label for="pname" class="form-label">Product Color</label>
                            <input class="form-control" type="text" name="product_color" id="pname"  @if(!empty($product['product_color']))  value="{{$product->product_color}}" @else value="" @endif />
                          </div>

                          <div class="mb-3 col-md-6">
                            <label for="pname" class="form-label">Product Price</label>
                            <input class="form-control" type="text" name="product_price" id="pname"  @if(!empty($product['product_price']))  value="{{$product->product_price}}" @else value="" @endif />
                          </div>                         
                        
                          <div class="mb-3 col-md-6">
                            <label for="product_discount" class="form-label"> Product Discount</label>
                            <input class="form-control" type="text" name="product_discount" id="product_discount" @if(!empty($product['product_discount']))  value="{{$product->product_discount}}" @else value="" @endif />
                          </div>

                          <div class="mb-3 col-md-6">
                            <label for="product_weight" class="form-label">Product Weight</label>
                            <input class="form-control" type="text" name="product_weight" id="product_weight"  @if(!empty($product['product_weight']))  value="{{$product->product_weight}}" @else value="" @endif />
                          </div>
                          

                          <div class="mb-3 col-md-12">
                            <label for="description" class="form-label">Product Description</label>
                            <textarea class="form-control" type="text" name="description" id="description">@if(!empty($product['description'])) {{$product->description}} @else  @endif </textarea>
                          </div>
                          

                          <div class="mb-3 col-md-12"><h4>Seo Related</h4></div>

                          <div class="mb-3 col-md-12">
                            <label for="meta_title" class="form-label">Product Meta Title</label>
                            <input class="form-control" type="text" name="meta_title" id="meta_title"  @if(!empty($product['meta_title']))  value="{{$product->meta_title}}" @else value="" @endif />
                          </div>

                          
                          <div class="mb-3 col-md-12">
                            <label for="meta_keywords" class="form-label">Product Keywords</label>
                            <input class="form-control" type="text" name="meta_keywords" id="meta_keywords"  @if(!empty($product['meta_keywords']))  value="{{$product->meta_keywords}}" @else value="" @endif />
                          </div>
                          
                          <div class="mb-3 col-md-12">
                            <label for="meta_description" class="form-label">Product Meta Description</label>
                            <textarea class="form-control" name="meta_description" id="meta_description">@if(!empty($product['meta_description'])){{$product->meta_description}} @else  @endif </textarea>
                          </div>

                          
                          <div class="mb-3 col-md-4">
                            <label for="product_video" class="form-label">Product Video</label>
                            
                            <input class="form-control1" type="file" name="product_video" id="video" accept="video/mp4,video/x-m4v,video/*">
                             @if(!empty($product['product_image'])) 
                               <input class="form-control" type="hidden" name="dbvideo" value="{{$product->product_video}}">
                               <br><br>
                               <video width="100%" controls="">
                                 <source src="{{url(asset('Frontend/assets/images/product')).'/'.$product->product_video}}"> 
                              </video>
                              <br>
                             <a href="{{url('admin/remove-product-video').'/'.$product->id}}">Delete Video</a>
                             @endif
                          </div>

                          <div class="mb-3 col-md-4">
                            <label for="feature" class="form-label">Product Featured</label>
                            
                            <select class="form-control" name="is_featured" id="feature">
                                <option value="">Choose Product Featured</option>
                                <option value="Yes" @if(!empty($product['is_featured']) && $product['is_featured']=='Yes')  selected @else  @endif>Yes</option>
                                <option value="No" @if(!empty($product['is_featured']) && $product['is_featured']=='No')  selected @else  @endif>No</option>
                                
                            </select>                            
                            
                          </div>

                          <div class="mb-3 col-md-4">
                            <label for="gst" class="form-label">GST on Product</label>
                            
                            <select class="form-control" name="gst" id="gst">
                                <option value="">Choose GST on Product</option>
                                <option @if(!empty($product['gst']) && $product['gst']=='GST_28')  selected @else  @endif  value="GST_28">GST_28</option>              
                                <option @if(!empty($product['gst']) && $product['gst']=='GST_18')  selected @else  @endif value="GST_18">GST_18</option>
                                <option @if(!empty($product['gst']) && $product['gst']=='GST_12')  selected @else  @endif value="GST_12">GST_12</option>
                                <option @if(!empty($product['gst']) && $product['gst']=='GST_5')  selected @else  @endif value="GST_5">GST_5</option>
                                <option @if(!empty($product['gst']) && $product['gst']=='GST_3')  selected @else  @endif value="GST_3">GST_3</option>
                                <option @if(!empty($product['gst']) && $product['gst']=='GST_0')  selected @else  @endif value="GST_0">GST_0</option>
                            </select>                            
                            
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