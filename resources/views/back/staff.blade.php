@extends('layouts.app')
@section('content')


    <style type="text/css">
      .space-bet{
        display: flex;
        justify-content: space-between;
      }
      .space-center{
        display: flex;
      }
      .pime-grid-button{
    float:left !important;

  }
.pime-grid-filter{
    float:left !important;
    margin-left:10px !important
}
    </style>
    <!-- BEGIN: Content-->
    <div class="app-content content">

    	<!-- alert section -->

    	@if(session('status'))
    	<div class="alert alert-success alert-dismissible mb-2" role="alert">
            {{session('status')}}
        </div>
        @endif
        <!-- alert section end -->
        
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- users list start -->
                <section class="users-list-wrapper">
                    <div class="users-list-table">
                        <div class="card">
                            <div class="card-content">
                              <div class="card-header space-bet">
                                <h3 class="card-title" id="emailCompose">Staff List</h3>
                                <a href="{{route('staff.create')}}" class="btn btn-primary btn-min-width mr-1 mb-1"><i class="feather icon-user-plus"></i>&nbspCreate</a>
                            </div>
                                <div class="card-body">
                                    <!-- datatable start -->
                                    <div class="table-responsive">
                                        <table id="users-list-datatable" class="table center-table">
                                            <thead>
                                            	  
                                                <tr>
                                                    <th class="text-center"><input type="checkbox" id="selectAll" data-size="sm" ></th>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>E-mail</th>
                                                    <th>Publish Date</th>
                                                    <th>Status</th>
                                                    <th style="width: 20%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              @foreach($staffs as $key => $staff)
                                                <tr>
                                                    <td class="text-center">
                                                        <input type="checkbox" class="check_item" unikey="{{$staff->id}}" id="test-{{$key}}" name="test-{{$key}}" data-size="sm">
                                                    </td>
                                                    <td>{{$key+1}}</td>
                                                    <td> {{$staff->name}} </td>
                                                    <td> {{$staff->email}} </td>
                                                    <td>{{ date('j F, Y', strtotime($staff->status_date)) }} </td>
                                                    <td>
                                                        @if($staff->status == "published")
                                                            <span class="badge badge-primary">Published</span>
                                                         
                                                        @else
                                                        <span class="badge badge-danger">Unpublished</span>
                                                        @endif
                                                     </td>
                                                    <td class="text-center"> 
                                                        <a href="{{route('staff.edit', $staff->id )}}" class="primary edit mr-1">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <a href="{{route('home')}}" onclick="event.preventDefault(); document.getElementById('delete-form').submit();"
                                                         class="danger delete mr-1"><i class="fa fa-trash-o"></i></a>
                                                        <form id="delete-form" action="{{route('staff.destroy',  $staff->id  )}}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- datatable ends -->
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- users list ends -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

<script type="text/javascript">
    function multi_status(){
        var items=$(".check_item:checked");
        var msg = '';
        status=$("#status_sel").val();
        if (status == 'Publish')
          msg = 'Are you sure you want to publish these records?';
        else msg = 'Are you sure you want to unpublish these records?';
        if(status != ""){
            if(items.length == 0){
                Swal.fire({
                  title: "warning",
                  text: "Please select record(s).",
                  type: "error",
                  confirmButtonClass: "btn btn-danger",
                  buttonsStyling: false
                });
                $("#status_sel").val("");
            }else{
                sel_ids=[];
                for (var i = items.length - 1; i >= 0; i--) {
                    sel_id=$(items[i]).attr('unikey');
                    sel_ids.push(sel_id);
                }
                $("#status_ids").val(sel_ids);
                  var title = '';
                  if (status === 'published'){
                    title = 'Publish';
                  } else {
                    title = 'UnPublish';
                  }
                    Swal.fire({
                      title: title,
                      text: msg,
                      type: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#3085d6",
                      cancelButtonColor: "#d33",
                      confirmButtonText: "Yes",
                      confirmButtonClass: "btn btn-primary",
                      cancelButtonClass: "btn btn-danger ml-1",
                      buttonsStyling: false
                    }).then(function(result) {
                    if (result.value) {
                      $("#status").val(status);
                      $("#multi-status").submit();
                    }
                  });
            
            }   
        }                     
    }

</script>
@endsection