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
                                <h3 class="card-title" id="emailCompose">Patients List</h3>

                                <a href="{{route('patients.create')}}" class="btn btn-primary btn-min-width mr-1 mb-1"><i class="feather icon-user-plus"></i>&nbspCreate</a>
                            </div>
                                <div class="card-body">
                                    <!-- datatable start -->
                                    <div class="row" style="justify-content: center;">
                                        <div class="form-group" style="display: flex;">
                                            <select class="form-control"  onchange="multi_status()" id="status_sel">
                                                <option value="">--Select Action--</option>
                                                <option value="publish" class="text-primary">Publish</option>
                                                <option value="unpublish" class="text-danger">Unpublish</option>
                                            </select>
                                        </div>

                                        <button onclick="multi_delete()" class="btn btn-danger btn-min-width mr-1 mb-1" style="display: none;" id="multi-del" style="margin-left: 5px">Delete</button>

                                    </div>
                                    <div class="table-responsive">
                                        <table id="users-list-datatable" class="table center-table">
                                            <thead>
                                            	  
                                                <tr>
                                                    <th class="text-center"><input type="checkbox" id="selectAll" data-size="sm" ></th>
                                                    <th>No</th>
                                                    <th>Username</th>
                                                    <th>Civil ID</th>
                                                    <th>E-mail</th>
                                                    <th>Contact Phone</th>
                                                    <th>Address</th>
                                                    <th>Status</th>
                                                    <th>Publish Date</th>
                                                    <th style="width: 20%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              @foreach($patients as $key => $patient)
                                                <tr>
                                                    <td class="text-center">
                                                        <input type="checkbox" unikey="{{$patient->id}}" class="switchery" id="test-{{$key}}" name="test-{{$key}}" data-size="sm">
                                                    </td>
                                                    <td>{{$key+1}}</td>
                                                    <td> {{$patient->name}} </td>
                                                    <td> {{$patient->civil_id}} </td>
                                                    <td> {{$patient->email}} </td>
                                                    <td> {{$patient->phone}} </td>
                                                    <td> {{$patient->address}} </td>
                                                    <td>
                                                        @if($patient->status == "publish")
                                                            <span class="badge badge-primary">Published</span>
                                                         
                                                        @else
                                                        <span class="badge badge-danger">Unpublished</span>
                                                        @endif
                                                     </td>
                                                    <td> {{$patient->status_date}} </td>
                                                    <td class="text-center"> 
                                                        <a href="{{route('patients.edit', $patient->id )}}" class="primary edit mr-1">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>


                                                        <a class="danger delete mr-1" 
                                                        onclick="confirm_delete({{$patient->id}})"><i class="fa fa-trash-o"></i></a>



                                                 <!--        <a href="{{route('home')}}" onclick="event.preventDefault(); document.getElementById('delete-form').submit();"
                                                         class="danger delete mr-1"><i class="fa fa-trash-o"></i></a>

                                                          -->
                                                        <form id="delete-form{{$patient->id}}" action="{{route('patients.destroy',  $patient->id  )}}" method="post">
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

    <!-- delete multi -->
    <form id="multi-delete" action="{{route('pat.multi_delete')}}" method="post">
        @csrf
        <input type="hidden" name="sel_ids" id="del_ids">
    </form>
    <!-- END: Content-->

    <!-- status multi -->
    <form id="multi-status" action="{{route('pat.multi_status')}}" method="post">
        @csrf
        <input type="hidden" name="sel_ids" id="status_ids">
        <input type="hidden" name="status" id="status">
    </form>
    <!-- end form -->

    <script type="text/javascript">
        function confirm_delete(id){
            Swal.fire({
              title: "Are you sure?",
              text: "You won't be able to revert this!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Yes, delete it!",
              confirmButtonClass: "btn btn-primary",
              cancelButtonClass: "btn btn-danger ml-1",
              buttonsStyling: false
            }).then(function(result) {
              if (result.value) {
                $("#delete-form"+id).submit();
                Swal.fire({
                  type: "success",
                  title: "Deleted!",
                  text: "Your file has been deleted."
                  // confirmButtonClass: "btn btn-success"
                });
              }
            });
        }



        function multi_delete(){
            var items=$(".switchery:checked");
            sel_ids=[];
            for (var i = items.length - 1; i >= 0; i--) {
                del_id=$(items[i]).attr('unikey');
                sel_ids.push(del_id);
            }
            $("#del_ids").val(sel_ids);

            Swal.fire({
              title: "Are you sure?",
              text: "You won't be able to revert this!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Yes, delete it!",
              confirmButtonClass: "btn btn-primary",
              cancelButtonClass: "btn btn-danger ml-1",
              buttonsStyling: false
            }).then(function(result) {
              if (result.value) {
                $("#multi-delete").submit();
              }
            });            
        }

        function multi_status(){
            var items=$(".switchery:checked");
            status=$("#status_sel").val();
            if(status != ""){
                if(items.length == 0){
                    Swal.fire({
                      title: "Error!",
                      text: " Please check!",
                      type: "error",
                      confirmButtonClass: "btn btn-danger",
                      buttonsStyling: false
                    });
                }else{
                    sel_ids=[];
                    for (var i = items.length - 1; i >= 0; i--) {
                        sel_id=$(items[i]).attr('unikey');
                        sel_ids.push(sel_id);
                    }
                    $("#status_ids").val(sel_ids);
                        Swal.fire({
                          title: "Are you sure?",
                          text: "You won't be able to revert this!",
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



        // function total_sel(){
        //     sel=$("#total-sel").is(":checked");

        //     var items=$(".switchery");

        //     if(sel){
        //         $("#multi-del").css('display', 'block');
        //         $(".switchery").attr('checked', 'checked');

        //     }else{
        //         $("#multi-del").css('display', 'none');
        //         $(".switchery:checked").removeAttr('checked');
        //         var items=$(".switchery:checked");
        //         console.log("length", items.length)
        //     }   

        // }



        // function mul_show(){
        //    var check_items=$(".switchery:checked");
        //    var total_items=$(".switchery");
        //    console.log("total",total_items.length, 'check_count',check_items.length )

        //     if(check_items.length == total_items.length){
        //         console.log("total-check")
        //          $("#total-sel").attr('checked', true);
        //     }else{
        //         console.log("total-uncheck")
        //         $("#total-sel").attr('checked', false);
        //     }

            // if (check_items.length > 0) {
            //     $("#multi-del").css('display', 'block');
            // }else{
            //     $("#multi-del").css('display', 'none');
            // }
        // } 
        function del_btn(){
             sel_item=$("input[type=checkbox]:checked");
            sel_count=sel_item.length;

            if(sel_count > 0){
                $("#multi-del").css('display', 'block');
            }else{
                $("#multi-del").css('display', 'none');
            }

            total_count=$(".switchery").length;
            if(total_count == sel_count){
                $("#selectAll").prop("checked", true);
            }
        }

        $(function(){
            $("#selectAll").click(function() {
                $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
            });

            $("input[type=checkbox]").click(function() {
                if (!$(this).prop("checked")) {
                    $("#selectAll").prop("checked", false);
                }
                del_btn();
            });

        })
    </script>

     

@endsection