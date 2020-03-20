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
                                  	
                                  	@isset($staff)
                                  	<form method="POST" action="{{route('staff.update', $staff->id)}}" id="update-form">
                                    	@csrf
                                    	@method('PUT')
                                        <input type="hidden" name="status" id="status_val">
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group pb-1">
                                                    @if($staff->status == 'published')
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
                                                        <label>Name</label>
                                                        <input type="text" class="form-control" placeholder="Name" name="name" value="{{$staff->name}}" required data-validation-required-message="This Name field is required">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>Type</label>
                                                        <select class="form-control" name="type" user-type="{{auth()->user()->type}}" id="type">
                                                           <!-- @if(auth()->user()->type == "super_admin")
                                                            <option value="super_admin">Supder admin</option>
                                                            <option value="admin">Admin</option>
                                                            <option value="staff">Staff</option>
                                                            @elseif(auth()->user()->type == "admin")
                                                            <option value="admin">Admin</option>
                                                            <option value="staff">Staff</option>
                                                            @elseif(auth()->user()->type == "staff")
                                                            <option value="staff">Staff</option>
                                                            @endif -->
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>E-mail</label>
                                                        @if(session('action')=='Error')
                                                        <input type="email" class="form-control" placeholder="Email" value="{{$staff->email}}" name="email" value="{{ session('error_email') }}"
                                                        style="border-color: red"
                                                        autofocus
                                                        required data-validation-required-message="This email field is required" id="email">
                                                        @else
                                                        <input type="email" class="form-control" placeholder="Email" value="{{$staff->email}}" name="email" required data-validation-required-message="This email field is required" id="email">
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>
                                            
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-new-password">Password</label>
                                                        <input type="password" value="" name="password" id="account-new-password" class="form-control" placeholder="New Password" required data-validation-required-message="The password field is required" minlength="6">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-retype-new-password">Confirm
                                                            Password</label>
                                                        <input type="password" value="" name="con-password" class="form-control" required id="account-retype-new-password" data-validation-match-match="password" placeholder="New Password" data-validation-required-message="The Confirm password field is required" minlength="6">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                           
                                            <div class="col-12">
                                                <div class="form-actions clearfix">
                                                    <div class="buttons-group float-left">
                                                        <a href="{{route('staff.index')}}" class="btn btn-warning mr-1">
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
                                  	@empty($staff)
                                    <form method="POST" action="{{route('staff.store')}}" id="create-form">
                                    	@csrf
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control" placeholder="Name" name="name" id="name" value="" required data-validation-required-message="This name field is required">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>Type</label>
                                                        <select class="form-control" required="" name="type" user-type="{{auth()->user()->type}}" id="type"></select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>E-mail</label>
                                                        <input type="email" class="form-control" placeholder="Email" value="" name="email" required id="email" data-validation-required-message="This email field is required">
                                                    </div>
                                                </div>    
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-new-password">Password</label>
                                                        <input type="password" name="password" id="account-new-password" value="" class="form-control" placeholder="New Password" required data-validation-required-message="The password field is required" minlength="6">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-retype-new-password">Confirm
                                                            Password</label>
                                                        <input type="password" name="con-password" class="form-control" required id="account-retype-new-password" data-validation-match-match="password" value="" placeholder="New Password" data-validation-match-message="Must match with password" minlength="6">
                                                    </div>
                                                </div>
                                            </div>  
                                            <div class="col-12">
                                                <div class="form-actions clearfix">
                                                    <div class="buttons-group float-left">
                                                        <a href="{{route('staff.index')}}" class="btn btn-warning mr-1">
                                                             Back
                                                        </a>
                                                    </div>
                                                    <div class="buttons-group float-right">
                                                         <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1" onclick="event.preventDefault(); confirm_create()">Create</button>
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
        var action = "<?php echo session('action') ?>";
        var msg = "<?php echo session('msg') ?>";
        // console.log("msg", action);
        // $("#civil_id").css("border-color", '#d3167f');
        // $("#civil_id").focus();
        toastr.error(msg, action, {"showMethod": "slideDown", "hideMethod": "slideUp", timeOut: 1500});
       })
     </script>
    @endif

    <script type="text/javascript">
    	function confirm_create() {
            var email = $("#email").val();
            $.ajax({
                url:"{{route('staf.confirm_create')}}",
                data:{
                    _token:"{{csrf_token()}}",
                    email:email
                },
                method:"post",
                success:function(result){
                    console.log(result);
                    if(result==1){
                        $("#create-form").submit();
                    }else{
                        toastr.error('Emial already exist.', 'Error', {"showMethod": "slideDown", "hideMethod": "slideUp", timeOut: 1500});
                        $("#email").css("border-color", "#d3167f");
                        $("#email").focus();
                    }
                },
                error: function(e){
                    console.log(e);
                }
            })
            // $("#create-form").submit();
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
                // console.log($("#type").val());
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
            var staff = '<?php if(isset($staff)) echo $staff;?>';
            var user_type = $("#type").attr("user-type");
            console.log(user_type);
            if(staff) var json_val = JSON.parse(staff);
            // console.log(json_val.type);

            switch(user_type) {
                case 'super_admin':
                    console.log("here");
                    var options = '<option value="super_admin">Super Admin</option><option value="admin">Admin</option><option value="staff">Staff</option>';
                    $("#type").html(options);
                    break;
                case 'admin':
                    var options = '</option><option value="admin">Admin</option><option value="staff">Staff</option>';
                    $("#type").html(options);
                    break;
                default:
                    var options = '<option value="super_admin">Super Admin</option><option value="admin">Admin</option><option value="staff">Staff</option>';
                    $("#type").html(options);
                    break;
            }
            if (json_val) {
                $("#type").val(json_val.type);
            }
            set_status();
            $("#switchery1").change(function(){
                set_status();
                console.log($("#status_val").val());
            })
        })
    </script>

  


@endsection