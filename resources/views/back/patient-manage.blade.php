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
                                  	
                                  	@isset($patient)
                                  		<form method="POST" action="{{route('patients.update', $patient->id)}}">
	                                    	@csrf
	                                    	@method('PUT')
	                                        <div class="row">
	                                            <div class="col-12 col-sm-6">
	                                                <div class="form-group">
	                                                    <div class="controls">
	                                                        <label>Username</label>
	                                                        <input type="text" class="form-control" placeholder="Username" name="name" value="{{$patient->name}}" required data-validation-required-message="This username field is required">
	                                                    </div>
	                                                </div>
	                                                <div class="form-group">
	                                                    <div class="controls">
	                                                        <label>E-mail</label>
	                                                        <input type="email" class="form-control" placeholder="Email" value="{{$patient->email}}" name="email" required data-validation-required-message="This email field is required">
	                                                    </div>
	                                                </div>
	                                                
	                                                
	                                            </div>
	                                            <div class="col-12 col-sm-6">

	                                                <div class="form-group">
	                                                	<div class="controls">
	                                                        <label>Civil ID</label>
	                                                        <input type="text" name="civil_id" class="form-control" placeholder="Civil ID" value="{{$patient->civil_id}}" required data-validation-required-message="This name field is required">
	                                                    </div>
	                                                    
	                                                </div>
	                                                <div class="form-group">
	                                                    <label>Contact Phone</label>
	                                                    <input type="text" name="phone" class="form-control" placeholder="Contact Phone" value="{{$patient->phone}}" required data-validation-required-message="This name field is required">
	                                                </div>

	                                            </div>
	                                            <div class="col-12 col-sm-6">
	                                               
	                                                <div class="form-group">
	                                                    <label>Address</label>
	                                                    <input type="text" name="address" class="form-control" placeholder="Address" value="{{$patient->address}}">
	                                                </div>
	                                            </div>
	                                           
	                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
	                                                <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Update</button>
	                                                <button type="reset" class="btn btn-light">Cancel</button>
	                                            </div>
	                                        </div>
	                                    </form>
                                  	@endisset
                                  	<!-- end update patient -->

                                  	<!-- create patient -->
                                  	@empty($patient)
                                    <form method="POST" action="{{route('patients.store')}}">
                                    	@csrf
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>Username</label>
                                                        <input type="text" class="form-control" placeholder="Username" name="name" value="" required data-validation-required-message="This username field is required">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>E-mail</label>
                                                        <input type="email" class="form-control" placeholder="Email" value="" name="email" required data-validation-required-message="This email field is required">
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>
                                            <div class="col-12 col-sm-6">

                                                <div class="form-group">
                                                	<div class="controls">
                                                        <label>Civil ID</label>
                                                        <input type="text" name="civil_id" class="form-control" placeholder="Civil ID" value="" required data-validation-required-message="This name field is required">
                                                    </div>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label>Contact Phone</label>
                                                    <input type="text" name="phone" class="form-control" placeholder="Contact Phone" value="" required data-validation-required-message="This name field is required">
                                                </div>

                                            </div>
                                            <div class="col-12 col-sm-6">
                                               
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" name="address" class="form-control" placeholder="Address">
                                                </div>
                                            </div>
                                           
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Create</button>
                                                <button type="reset" class="btn btn-light">Cancel</button>
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


@endsection