@extends('layouts.app')
@section('content')
 
    <!-- BEGIN: Content-->
    <style type="text/css">
      .switchery {
        background-color: red !important;
      }
      
    </style>
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
                                  		<form method="POST" action="{{route('patients.update', $patient->id)}}" id="update-form">
	                                    	@csrf
	                                    	@method('PUT')

                                        <input type="hidden" name="status" id="status_val">
                                          <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group pb-1">
                                                    @if($patient->status == 'published')
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
	                                                        <label>Patient Name</label>
	                                                        <input type="text" class="form-control" placeholder="Patient name" name="name" value="{{$patient->name}}" required data-validation-required-message="This patient name field is required">
	                                                    </div>
	                                                </div>
	                                                <div class="form-group">
	                                                    <div class="controls">
	                                                        <label>E-mail</label>
	                                                        <input type="email" class="form-control" placeholder="Email" value="{{$patient->email}}" name="email" required data-validation-required-message="This email field is required">
	                                                    </div>
	                                                </div> 
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <input type="text" name="address" class="form-control" placeholder="Address" value="{{$patient->address}}">
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

                                                <div class="col-12 col-sm-12">
                                                    <div class="form-actions clearfix">
                                                        <div class="buttons-group float-left">
                                                            <a href="{{route('patients.index')}}" class="btn btn-warning mr-1">
                                                                 Back
                                                            </a>
                                                        </div>

                                                        <div class="buttons-group float-right">
                                                            <button type="submit" class="btn btn-info mr-1" onclick="event.preventDefault(); confirm_update();">Update</button>
                                                            <button type="reset" class="btn btn-danger mr-1">Reset</button>
                                                        </div>
                                                    </div>
                                                </div>

	                                        </div>
	                                    </form>
                                  	@endisset
                                  	<!-- end update patient -->

                                  	<!-- create patient -->
                                  	@empty($patient)
                                    <form method="POST" action="{{route('patients.store')}}" id='create-form'>
                                    	@csrf
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <div class="controls">

                                                        <label>Patient Name</label>
                                                        <input type="text" class="form-control" placeholder="Patient Name" name="name" value="" required data-validation-required-message="This username field is required">

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>E-mail</label>
                                                        <input type="email" class="form-control" placeholder="Email" id="email" name="email" value="" required data-validation-required-message="This email field is required">
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>
                                            <div class="col-12 col-sm-6">

                                                <div class="form-group">
                                                	<div class="controls">
                                                        <label>Civil Id</label>
                                                        <input type="text" id="civil_id" name="civil_id" class="form-control" placeholder="Civil ID" value="" required data-validation-required-message="This name field is required">
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

                                            <div class="col-12 col-sm-12">
                                                <div class="form-actions clearfix">
                                                    <div class="buttons-group float-left">
                                                        <a href="{{route('patients.index')}}" class="btn btn-warning mr-1">
                                                             Back
                                                        </a>
                                                    </div>

                                                    <div class="buttons-group float-right">
                                                        <button type="submit" class="btn btn-info mr-1"  onclick="event.preventDefault(); confirm_create();">Create</button>
                                                        <button type="reset" class="btn btn-danger mr-1">Reset</button>
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
        console.log("sadf", msg);
        toastr.error(msg, action, {"showMethod": "slideDown", "hideMethod": "slideUp", timeOut: 1500});
       })
     </script>
    @endif


    <script type="text/javascript">
        function confirm_create(){
            civil_id=$("#civil_id").val();
            $.ajax({
                url:"{{route('confirm_create')}}",
                data:{
                    _token:"{{csrf_token()}}",
                    civil_id:civil_id
                },
                method:"post",
                success:function(result){
                    if(result==1){
                        $("#create-form").submit();
                    }else{
                        toastr.error('Civil ID already exist.', 'Error', {"showMethod": "slideDown", "hideMethod": "slideUp", timeOut: 1500});
                    }
                },
                error: function(e){
                    console.log(e);
                }
            })
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