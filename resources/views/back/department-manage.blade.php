@extends('layouts.app')
@section('content')
   
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- users edit start -->
                <section class="users-edit">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">

                                	<!-- update patient -->
                                  	
                                  	@isset($department)
                                  	<form method="POST" action="{{route('department.update', $department->id)}}" id="update-form">
                                    	@csrf
                                    	@method('PUT')
                                        <input type="hidden" name="status" id="status_val">
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group pb-1">
                                                    @if($department->status == 'published')
                                                    <input type="checkbox" checked="checked" id="switchery1" class="switchery" />
                                                    @else
                                                    <input type="checkbox" id="switchery1" class="switchery" />
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>Department Name</label>
                                                        @if(session('action')=='Error')
                                                        <input type="text" name="name" class="form-control" placeholder="Department Name" value="{{ session('error_depart') }}" required 
                                                        style="border-color: red"
                                                        autofocus
                                                        data-validation-required-message="This name field is required">
                                                        @else
                                                        <input type="text" class="form-control" placeholder="Department Name" name="name" value="{{$department->name}}" required id="depart" data-validation-required-message="This Department Name field is required">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                           
                                            <div class="col-12">
                                                <div class="form-actions clearfix">
                                                    <div class="buttons-group float-left">
                                                        <a href="{{route('department.index')}}" class="btn btn-warning mr-1">
                                                             Back
                                                        </a>
                                                    </div>
                                                    <div class="buttons-group float-right">
                                                         <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1" onclick="event.preventDefault(); confirm_update()">Update</button>
                                                        <button type="reset" class="btn btn-danger glow mb-1 mb-sm-0 mr-0 mr-sm-1">Reset</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                  	@endisset
                                  	<!-- end update patient -->

                                  	<!-- create patient -->
                                  	@empty($department)
                                    <form method="POST" action="{{route('department.store')}}" id="create-depart">
                                    	@csrf
                                        <div class="row">
                                            <div class="col-12 col-sm-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>Deparment Name</label>
                                                        <input type="text" class="form-control" placeholder="Department Name" name="name" value="" required data-validation-required-message="This deparment name field is required" id="depart">
                                                    </div>
                                                </div>
                                            </div>
                                           
                                            <div class="col-12">
                                                <div class="form-actions clearfix">
                                                    <div class="buttons-group float-left">
                                                        <a href="{{route('department.index')}}" class="btn btn-warning mr-1">
                                                             Back
                                                        </a>
                                                    </div>
                                                    <div class="buttons-group float-right">
                                                         <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1" onclick="event.preventDefault(); createDepart();">Create</button>
                                                        <button type="reset" class="btn btn-danger glow mb-1 mb-sm-0 mr-0 mr-sm-1">Reset</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    @endempty

                                    <!-- end create patient -->
                                    <!-- users edit account form ends -->
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- users edit ends -->
            </div>
        </div>
    </div>


    @if(session('action'))
     <script type="text/javascript">
       $(function(){
        var action = "<?php echo session('action')?>";
        var msg = "<?php echo session('msg') ?>";
        toastr.error(msg, action, {"showMethod": "slideDown", "hideMethod": "slideUp", timeOut: 1500});
       })
     </script>
    @endif
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <script type="text/javascript">
        function createDepart() {
            var name = $("#depart").val();
            console.log("name", name);
            $.ajax({
                url:"{{route('depart.check_duplication')}}",
                data:{
                    _token:"{{csrf_token()}}",
                    name: $("#depart").val()
                },
                method:"post",
                success:function(result){
                    console.log(result);
                    if(result==1){
                        $("#create-depart").submit();
                    }else{
                        toastr.error('Department name already exist.', 'Error', {"showMethod": "slideDown", "hideMethod": "slideUp", timeOut: 1500});
                        $("#depart").css("border-color", "#d3167f");
                        $("#depart").focus();
                    }
                },
                error: function(e){
                    console.log(e);
                }
            })
            // $("#create-depart").submit();
        }

        function confirm_update(){

            Swal.fire({
              title: "Update",
              text: "Are you sure you want to update?",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Yes",
              confirmButtonClass: "btn btn-primary",
              cancelButtonClass: "btn btn-danger ml-1",
              buttonsStyling: false,
            }).then(function(result) {
              if (result.value) {
                $("#update-form").submit();
              }
            });
        }

        function set_status(){
            star=$("#switchery1").prop('checked');
            if(star){
                $("#status_val").val('published');
            }else{
                $("#status_val").val('unpublished');
            }
        }

        $(function(){
            set_status();
            $("#switchery1").change(function(){
                set_status();
            })
        })
    </script>

  


@endsection