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

                                	<!-- update service-->

                                  	@isset($service)
                                  		<form method="POST" action="{{route('services.update', $service->id)}}" id="update-form">
	                                    	@csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" id="status_val">
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group pb-1">
                                                        @if($service->status == 'published')
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
	                                                        <label>Service Name</label>
	                                                        <input type="text" class="form-control" placeholder="Service name" name="name" value="{{$service->name}}" required data-validation-required-message="This service Name field is required">
	                                                    </div>
	                                                </div>

	                                                <div class="form-group">
	                                                	<div class="controls">
	                                                		<input type="hidden" id="depart_id" value="{{$service->department_id}}">
	                                                		<input type="hidden" id="doctor_id" value="{{$service->doctor_id}}">
	                                                        <label>Department</label>
	                                                        <select class="form-control" name="department_id" required id="depart">
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
	                                                        <label>Price</label>
	                                                        <input type="number" class="form-control" placeholder="Price" value="{{$service->price}}" name="price" required
                                                            step="0.01" data-validation-required-message="This price field is required">
	                                                    </div>
	                                                </div>


	                                                <div class="form-group">
	                                                	<div class="controls">
	                                                        <label>Doctor</label>
	                                                        <select class="form-control" name="doctor_id" required="required" id='doctor' required data-validation-required-message="Service name is required">
	                                                        	@foreach($doctors as $doctor)
	                                                            	<option value="{{$doctor->id}}">{{$doctor->name}}</option>
	                                                        	@endforeach
	                                                        </select>
	                                                    </div>

	                                                </div>

	                                            </div>

	                                            <div class="col-12">
	                                                <div class="form-actions clearfix">
                                                    <div class="buttons-group float-left">
                                                        <a href="{{route('services.index')}}" class="btn btn-warning mr-1">
                                                            Back
                                                        </a>
                                                    </div>
                                                    <div class="buttons-group float-right">
                                                        <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1" onclick="event.preventDefault();confirm_update()">Update</button>
                                                        <button type="reset" class="btn btn-danger glow mb-1 mb-sm-0 mr-0 mr-sm-1">Reset</button>
                                                    </div>
                                                </div>
	                                            </div>

                                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                                            <script type="text/javascript">
                                            	$(document).ready(function(){
                                            		depart_id=$("#depart_id").val();
                                            		doctor_id=$("#doctor_id").val();
                                            		$("#depart").val(depart_id);
                                            		$("#doctor").val(doctor_id);
                                            	})
                                            </script>
                                        </div>
	                                    </form>
                                  	@endisset
                                  	<!-- end update service -->

                                  	<!-- create service -->
                                  	@empty($service)
                                    <form method="POST" action="{{route('services.store')}}" id="create-form">
                                    	@csrf
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>Service Name</label>
                                                        <input type="text" class="form-control" placeholder="Service name" name="name" value="" required data-validation-required-message="Service name is required">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                	<div class="controls">
                                                        <label>Department</label>
                                                        <select class="form-control" name="department_id" required id="department" required onchange="departChange()" data-validation-required-message="Department is required">
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
                                                        <label>Price</label>
                                                        <input type="number" class="form-control" placeholder="Price" value="" step="0.1" name="price" required data-validation-required-message="Price is required">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                	<div class="controls">
                                                        <label>Doctor</label>
                                                        <select class="form-control" name="doctor_id" required  data-validation-required-message="Service name is required" id="doctor">
                                                        	
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-actions clearfix">
                                                    <div class="buttons-group float-left">
                                                        <a href="{{route('services.index')}}" class="btn btn-warning mr-1">
                                                            Back
                                                        </a>
                                                    </div>
                                                    <div class="buttons-group float-right">
                                                        <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1" onclick="event.preventDefault();createService()">Create</button>
                                                        <button type="reset" class="btn btn-danger glow mb-1 mb-sm-0 mr-0 mr-sm-1">Reset</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    @endempty

                                    <!-- end create service-->
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
        function createService() {
            console.log("34e2323");
            var doctor =  $("#doctor").val();
            if (!doctor) {
                $("#doctor").css("border-color", "#d3167f")
                $("#doctor").focus();
                return;
            }
            $("#create-form").submit();
        }
        function confirm_update(){
            var doctor =  $("#doctor").val();
            if (!doctor) {
                $("#doctor").css("border-color", "#d3167f")
                $("#doctor").focus();
                return;
            }
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
        function departChange() {
            var depart = $("#department").val();
            $.post("{{route('doct.get_doctor_by_department')}}", {id: depart, _token:"{{csrf_token()}}"}, function(data) {
                console.log(data);
                var data = JSON.parse(data);
                if (data) {
                    // console.log(data);
                    var options = "<option value=''>--Select Doctor--</option>";
                    data.forEach(ele => {
                        var option = "<option value='" + ele.id + "'>" + ele.name + "</option>";
                        options += option;
                    });
                    // console.log(options);
                    $("#doctor").html(options);
                }
            })
        }
        $(function(){
            set_status();
            $("#switchery1").change(function(){
                set_status();
            })
        })
    </script>
@endsection
