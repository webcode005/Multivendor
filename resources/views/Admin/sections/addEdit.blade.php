@extends('admin.layouts.layouts')
@section('content')

  <!-- Content wrapper -->
  <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              
              <div class="row">
                <div class="col-md-12">
                  
                  <div class="card mb-4">
                    <h5 class="card-header">Section Details</h5>
                    <form id="formAccountSettings" method="POST" @if(empty($sections['id'])) action="{{url('admin/add-edit-section')}}" @else action="{{url('admin/add-edit-section/'.$sections['id'])}}" @endif>
                    @csrf
                    <!-- Account -->
                    <div class="card-body">                                             
                  
                        <div class="row">
                          
                          <div class="mb-3 col-md-6">
                            <label for="name" class="form-label"> Name</label>
                            <input class="form-control" type="text" name="name" id="name"  @if(!empty($sections['id']))  value="{{$sections->name}}" @else value="" @endif />
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
            </div>
            <!-- / Content -->

         </div>
          <!-- Content wrapper -->

@endsection