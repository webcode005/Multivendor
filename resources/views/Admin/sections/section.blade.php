@extends('admin.layouts.layouts')
@section('content')


          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row" style="margin-top:40px;">
                                <br><br>
                            
                                @if ($message = Session::get('success-message'))
                                <div class="col-md-12">                                                       
                                    <div class="alert alert-dark alert-dismissible" role="alert">
                                      {{ $message }}
                                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>                                        
                                    </div>
                                </div>
                                        
                                    @endif
                                    @if ($errors->any())
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
                <h5 class="card-header">{{$title}} Tables <a href="/admin/add-edit-section" class="btn btn-success btn-md" style="float: right;">Add Section</a></h5>
                <div class="card-datatable table-responsive">
                  <table class="dt-responsive table border-top">
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
                        @foreach($sections as $section)
                            <tr>
                                <td>{{ $ik++;}}</td>
                                <td>{{ $section['name']}}</td>
                                
                                <td>@if($section['status'] == '1')
                                  <a href="javascript:void(0)" class="updateSectionStatus" id="section-{{$section['id']}}" section_id="{{$section['id']}}"> <span class="badge bg-success"  id="status" status="Active"> Active </span></a> 
                                  @else <a class="updateSectionStatus" id="section-{{$section['id']}}" section_id="{{$section['id']}}" href="javascript:void(0)"> <span class="badge bg-danger" id="status" status="InActive"> InActive </span> </a> @endif </td>
                                
                                <td><a class="btn btn-sm btn-primary" href="{{url('admin/add-edit-section')}}/{{ $section['id']}}">Edit</a> | <a class="btn btn-sm btn-danger deletesection" title="Sections" href="{{url('admin/delete-section')}}/{{ $section['id']}}">Delete</a></td>
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