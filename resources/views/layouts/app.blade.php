<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Stack admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, stack admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Users List - Stack Responsive Bootstrap 4 Admin Template</title>
    <link rel="apple-touch-icon" href="{{asset('app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('app-assets/images/ico/favicon.ico ')}} ">
    <link
        href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/datatables.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/validation/form-validation.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/components.css')}}">
    <!-- END: Theme CSS-->

    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/selects/select2.min.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/vertical-menu-modern.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/page-users.css')}}">
     <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/style.css')}}">
    <!-- END: Page CSS-->

    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/sweetalert2.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/toggle/switchery.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/switch.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="{{asset('app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <!-- END: Page Vendor JS-->


    <!-- BEGIN: Custom CSS-->
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/style.css')}}"> -->
    <!-- END: Custom CSS-->


 

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">

    @include('layouts.components.head')

    @include('layouts.components.sidebar')

    @yield('content')

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    @include('layouts.components.foot')


    <!-- side bar select function -->

    <input type="hidden" id="star" value="{{$star}}">
    <script type="text/javascript">
        $(function(){
            star=$("#star").val();
            $("."+star).addClass('active');
        })
    </script>

   <!-- BEGIN: Vendor JS-->

    <script src="{{asset('app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
    <!-- BEGIN Vendor JS-->




    <!-- BEGIN: Theme JS-->
    <script src="{{asset('app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{asset('app-assets/js/core/app.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{asset('app-assets/js/scripts/pages/page-users.js')}}"></script>
    <!-- END: Page JS-->

    <!-- BEGIN: Page JS-->
    <!-- <script src="{{asset('app-assets/js/scripts/pages/account-setting.js')}} "></script> -->
    <!-- END: Page JS-->

    <script src="{{asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>

    <script src="{{asset('app-assets/js/scripts/forms/select/form-select2.js')}} "></script>


        <!-- BEGIN: Page JS-->
    <script src="{{asset('app-assets/js/scripts/extensions/sweet-alerts.js')}} "></script>
    <script src="{{asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js')}} "></script>
    <!-- END: Page JS-->

    <script src="{{asset('app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/extensions/toastr.js')}}"></script>

    <script src="{{asset('app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/forms/toggle/switchery.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/forms/switch.js')}}"></script>


    <script type="text/javascript">
        $(document).ready(function(){
          var row = $("#users-list-datatable_wrapper").children().first();
            console.log(row);

            var html = `<div class="col-sm-12 col-md-4">
                            <div class="dataTables_length" id="users-list-datatable_length"><label>Show <select
                                        name="users-list-datatable_length" aria-controls="users-list-datatable"
                                        class="custom-select custom-select-sm form-control form-control-sm">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select> entries</label>
                            </div>
                        </div>
                        <div class="col-md-4" style="justify-content: center; display: flex">
                            <div class="form-group" style="display: flex;">
                            <select class="custom-select custom-select-sm form-control form-control-sm" onchange="multi_status()"
                                    id="status_sel">
                                    <option value="">--Select Action--</option>
                                    <option value="Publish" class="text-primary">Publish</option>
                                    <option value="Unpublish" class="text-danger">Unpublish</option>
                                </select></div><button onclick="multi_delete()" class="btn btn-sm btn-danger btn-min-width mr-1 mb-1"
                                id="multi-del" style="margin-left: 8px; visibility: hidden;">Delete</button>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div id="users-list-datatable_filter" class="dataTables_filter"><label>Search:<input type="search"
                                        class="form-control form-control-sm" placeholder="" aria-controls="users-list-datatable"></label></div>
                        </div>`
            $(row).html(html)
        })
    </script>






</body>
<!-- END: Body-->

</html>