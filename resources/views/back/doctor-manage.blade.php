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

                                	<!-- update doctor-->
                                  	
                                  	@isset($doctor)
                                  		<form method="POST" action="{{route('doctors.update', $doctor->id)}}" id="update-form">
	                                    	@csrf
	                                    	@method('PUT')
                                            <input type="hidden" name="status" id="status_val">
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group pb-1">
                                                        @if($doctor->status == 'published')
                                                        <input type="checkbox" checked="checked" id="switchery1" class="switchery" />
                                                        @else
                                                        <input type="checkbox" id="switchery1" class="switchery" />
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
	                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>Doctor Name</label>
                                                        <input type="text" class="form-control" placeholder="Username" name="name" value="{{$doctor->name}}" required data-validation-required-message="This Doctor Name field is required" data-validation-pattern-message="Must be characters" pattern="[a-zA-Z ]+">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                	<div class="controls">
                                                        <label>Department</label>
                                                        <input type="hidden" id="department_val" value="{{$doctor->department_id}}">
                                                        <select class="form-control" id="department" name="department_id" required>
                                                        	@foreach($departments as $department)
                                                            	<option value="{{$department->id}}">{{$department->name}}</option>
                                                        	@endforeach
                                                        </select>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                            	<div class="form-group">
                                                    <div class="controls">
                                                        <label>E-mail</label>
                                                        @if(session('action')=='Error')
                                                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{ session('error_email') }}"
                                                        style="border-color: red"
                                                        autofocus
                                                        required data-validation-required-message="This email field is required" id="email">
                                                        @else
                                                        <input type="email" class="form-control" placeholder="Email" value="{{$doctor->email}}" name="email" required data-validation-required-message="This email field is required">
                                                        @endif
                                                    </div>
                                                </div>

                                                
                                                <div class="form-group">
                                                    <label>Telephone</label>
                                                    <div class="controls">
                                                        <input type="text" name="tel" class="form-control" placeholder="Contact Phone" value="{{$doctor->tel}}" required data-validation-required-message="This tel field is required" data-validation-pattern-message="Must be numbers" pattern="[0-9]+">
                                                    </div>
                                                </div>

                                            </div>
                                           
                                            <div class="col-12 ">
                                                <div class="buttons-group float-left">
                                                    <a href="{{route('doctors.index')}}" class="btn btn-warning mr-1">
                                                         Back
                                                    </a>
                                                </div>

                                                <div class="buttons-group float-right">
                                                    <button type="submit" class="btn btn-info mr-1" onclick="event.preventDefault(); confirm_update();">Update</button>
                                                    <button type="reset" class="btn btn-danger mr-1">Reset</button>
                                                </div>
                                            </div>

                                            
                                        </div>
	                                    </form>
                                  	@endisset
                                  	<!-- end update doctor -->

                                  	<!-- create doctor -->
                                  	@empty($doctor)
                                    <form method="POST" action="{{route('doctors.store')}}" id="create-doct">
                                    	@csrf
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>Doctor Name</label>
                                                        <input type="text" class="form-control" placeholder="Doctor name" name="name" value="" required id="doctor" data-validation-required-message="This Doctor Name field is required" pattern="[a-zA-Z ]+">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                	<div class="controls">
                                                        <label>Department</label>

                                                        <select class="select2 form-control" required name="department_id" required>
                                                        	@foreach($departments as $department)
                                                            	<option value="{{$department->id}}">{{$department->name}}</option>
                                                        	@endforeach
                                                        </select>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                            	<div class="form-group">
                                                    <div class="controls">
                                                        <label>E-mail</label>
                                                        <input type="email" class="form-control" placeholder="Email" value="" name="email" id="email" required data-validation-required-message="This email field is required">
                                                    </div>
                                                </div>

                                                
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>Telephone</label>
                                                        <input type="text" name="tel" class="form-control" placeholder="Contact Phone" value="" required data-validation-required-message="This tel field is required"pattern="[0-9]+">
                                                    </div>
                                                </div>

                                            </div>
                                           
                                            <div class="col-12 ">
                                                <div class="buttons-group float-left">
                                                    <a href="{{route('doctors.index')}}" class="btn btn-warning mr-1">
                                                         Back
                                                    </a>
                                                </div>

                                                <div class="buttons-group float-right">
                                                    <button type="submit" class="btn btn-info mr-1" onclick="event.preventDefault(); createDoctor();">Update</button>
                                                    <button type="reset" class="btn btn-danger mr-1">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    @endempty

                                    <!-- end create doctor-->
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
    @isset($patient)
    <script type="text/javascript">
        $(function(){
            first_status="<?php  echo $patient->status  ?>";
            $("#status").val(first_status);
        })
    </script>
    @endisset

    @if(session('action'))
     <script type="text/javascript">
       $(function(){
        var action = "<?php echo session('action') ?>";
        var msg = "<?php echo session('msg') ?>";
        toastr.error(msg, action, {"showMethod": "slideDown", "hideMethod": "slideUp", timeOut: 1500});
       })
     </script>
    @endif

    <script type="text/javascript">
        
        function createDoctor() {
            var email = $("#email").val();
            // console.log("name", name);
            $.ajax({
                url:"{{route('doct.check_duplication')}}",
                data:{
                    _token:"{{csrf_token()}}",
                    email: email
                },
                method:"post",
                success:function(result){
                    console.log(result);
                    if(result==1){
                        $("#create-doct").submit();
                    }else{
                        toastr.error('Doctor email already exist.', 'Error', {"showMethod": "slideDown", "hideMethod": "slideUp", timeOut: 1500});
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