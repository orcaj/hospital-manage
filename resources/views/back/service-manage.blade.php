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
                                  		<form method="POST" action="{{route('services.update', $service->id)}}">
	                                    	@csrf
	                                    	@method('PUT')
	                                        <div class="row">
	                                            <div class="col-12 col-sm-6">
	                                                <div class="form-group">
	                                                    <div class="controls">
	                                                        <label>Service Name</label>
	                                                        <input type="text" class="form-control" placeholder="Username" name="name" value="{{$service->name}}" required data-validation-required-message="This service Name field is required">
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
	                                                        <input type="number" class="form-control" placeholder="Price" value="{{$service->price}}" name="price" required data-validation-required-message="This price field is required">
	                                                    </div>
	                                                </div>

	                                                
	                                                <div class="form-group">
	                                                	<div class="controls">
	                                                        <label>Doctor</label>
	                                                        <select class="form-control" name="doctor_id" required id='doctor'>
	                                                        	@foreach($doctors as $doctor)
	                                                            	<option value="{{$doctor->id}}">{{$doctor->name}}</option>
	                                                        	@endforeach
	                                                        </select>
	                                                    </div>
	                                                    
	                                                </div>

	                                            </div>
                                           
	                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
	                                                <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Update</button>
	                                                <button type="reset" class="btn btn-light">Cancel</button>
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
                                    <form method="POST" action="{{route('services.store')}}">
                                    	@csrf
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>Service Name</label>
                                                        <input type="text" class="form-control" placeholder="Username" name="name" value="" required data-validation-required-message="This service Name field is required">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                	<div class="controls">
                                                        <label>Department</label>
                                                        <select class="form-control" name="department_id" required>
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
                                                        <input type="number" class="form-control" placeholder="Price" value="" name="price" required data-validation-required-message="This price field is required">
                                                    </div>
                                                </div>

                                                
                                                <div class="form-group">
                                                	<div class="controls">
                                                        <label>Doctor</label>
                                                        <select class="form-control" name="doctor_id" required>
                                                        	@foreach($doctors as $doctor)
                                                            	<option value="{{$doctor->id}}">{{$doctor->name}}</option>
                                                        	@endforeach
                                                        </select>
                                                    </div>
                                                    
                                                </div>

                                            </div>
                                           
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Create</button>
                                                <button type="reset" class="btn btn-light">Cancel</button>
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


@endsection