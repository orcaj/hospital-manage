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
                                  	<form method="POST" action="{{route('department.update', $department->id)}}">
                                    	@csrf
                                    	@method('PUT')
                                        <div class="row">
                                            <div class="col-12 col-sm-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>Department Name</label>
                                                        <input type="text" class="form-control" placeholder="Department Name" name="name" value="{{$department->name}}" required data-validation-required-message="This Department Name field is required">
                                                    </div>
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
                                  	@empty($department)
                                    <form method="POST" action="{{route('department.store')}}">
                                    	@csrf
                                        <div class="row">
                                            <div class="col-12 col-sm-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>Deparment Name</label>
                                                        <input type="text" class="form-control" placeholder="Department Name" name="name" value="" required data-validation-required-message="This Deparment Name field is required">
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

<!-- 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript">
    	$("#create-form").on('click', function(e){
            e.preventDefault();
            pass=$("#password").val();
            pass_confirm=$("#password_confirm").val();
            if(pass == pass_confirm){
            	// $("#create-form").submit();
            	console.log("asddddddf");
            }else{
            	console.log("asdf");
            }
        })
    </script> -->

  


@endsection