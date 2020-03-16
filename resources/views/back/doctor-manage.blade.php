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
                                  		<form method="POST" action="{{route('doctors.update', $doctor->id)}}">
	                                    	@csrf
	                                    	@method('PUT')
	                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>Doctor Name</label>
                                                        <input type="text" class="form-control" placeholder="Username" name="name" value="{{$doctor->name}}" required data-validation-required-message="This Doctor Name field is required">
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
                                                        <input type="email" class="form-control" placeholder="Email" value="{{$doctor->email}}" name="email" required data-validation-required-message="This email field is required">
                                                    </div>
                                                </div>

                                                
                                                <div class="form-group">
                                                    <label>Tel</label>
                                                    <input type="text" name="tel" class="form-control" placeholder="Contact Phone" value="{{$doctor->tel}}" required data-validation-required-message="This tel field is required">
                                                </div>

                                            </div>
                                           
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Update</button>
                                                <button type="reset" class="btn btn-light">Cancel</button>
                                            </div>

                                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                                            <script type="text/javascript">
                                            	$(document).ready(function(){
                                            		department_id=$("#department_val").val();
                                            		$("#department").val(department_id);
                                            	})
                                            </script>
                                        </div>
	                                    </form>
                                  	@endisset
                                  	<!-- end update doctor -->

                                  	<!-- create doctor -->
                                  	@empty($doctor)
                                    <form method="POST" action="{{route('doctors.store')}}">
                                    	@csrf
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>Doctor Name</label>
                                                        <input type="text" class="form-control" placeholder="Username" name="name" value="" required data-validation-required-message="This Doctor Name field is required">
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
                                                        <label>E-mail</label>
                                                        <input type="email" class="form-control" placeholder="Email" value="" name="email" required data-validation-required-message="This email field is required">
                                                    </div>
                                                </div>

                                                
                                                <div class="form-group">
                                                    <label>Tel</label>
                                                    <input type="text" name="tel" class="form-control" placeholder="Contact Phone" value="" required data-validation-required-message="This tel field is required">
                                                </div>

                                            </div>
                                           
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Create</button>
                                                <button type="reset" class="btn btn-light">Cancel</button>
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


@endsection