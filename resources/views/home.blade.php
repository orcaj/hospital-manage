@extends('layouts.app')
@section('content')


    
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay">
            
            
        </div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">


                <!-- Minimal modern charts for power consumption, region statistics and sales etc. starts here -->
                <div class="row minimal-modern-charts">



                    <!-- recent payment-->
                    <div class="col-xxl-6 col-xl-8 col-lg-8 col-md-12 col-12 latest-update-tracking">
                        <div class="card">
                            <div class="card-header latest-update-heading d-flex justify-content-between">
                                <h4 class="latest-update-heading-title text-bold-500">Latest Update</h4>
                                
                            </div>
                            <div class="card-content latest-update-tracking-list pt-0 pb-1 px-2 position-relative">
                                <ul class="list-group">
                                    <li
                                        class="list-group-item pt-0 px-0 latest-updated-item border-0 d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <span class="list-group-item-icon d-inline mr-1">
                                                <i
                                                    class="icon text-primary bg-light-primary icon-bag total-products-icon rounded-circle p-50"></i>
                                            </span>
                                            <div>
                                                <p class="mb-25 latest-update-item-name text-bold-600">Total Products
                                                </p>
                                                <small class="font-small-3">1.2k Products</small>
                                            </div>
                                        </div>
                                        <span class="update-profit text-bold-600">$10.5k</span>
                                    </li>
                                    <li
                                        class="list-group-item px-0 latest-updated-item border-0 d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <span class="list-group-item-icon d-inline mr-1">
                                                <i
                                                    class="icon icon-graph bg-light-info text-info total-sales-icon rounded-circle p-50"></i>
                                            </span>
                                            <div>
                                                <p class="mb-25 latest-update-item-name text-bold-600">Total Sales</p>
                                                <small class="font-small-3">39.2k Sales</small>
                                            </div>
                                        </div>
                                        <span class="update-profit text-bold-600">26M</span>
                                    </li>
                                    <li
                                        class="list-group-item px-0 latest-updated-item border-0 d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <span class="list-group-item-icon d-inline mr-1">
                                                <i
                                                    class="icon icon-bag bg-light-danger text-danger total-products-icon rounded-circle p-50"></i>
                                            </span>
                                            <div>
                                                <p class="mb-25 latest-update-item-name text-bold-600">Total Products
                                                </p>
                                                <small class="font-small-3">1.2k Products</small>
                                            </div>
                                        </div>
                                        <span class="update-profit text-bold-600">$10.5k</span>
                                    </li>
                                    <li
                                        class="list-group-item px-0 latest-updated-item border-0 d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="list-group-item-icon d-inline mr-1">
                                                <i
                                                    class="icon icon-credit-card bg-light-primary text-primary total-revenue-icon rounded-circle p-50"></i>
                                            </div>
                                            <div>
                                                <p class="mb-25 latest-update-item-name text-bold-600">Total Revenue</p>
                                                <small class="font-small-3">45.5k New Revenue</small>
                                            </div>
                                        </div>
                                        <span class="update-profit text-bold-600">15.6M</span>
                                    </li>
                                    <li
                                        class="list-group-item px-0 latest-updated-item border-0 d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <span class="list-group-item-icon d-inline mr-1">
                                                <i
                                                    class="icon icon-graph bg-light-info text-info total-sales-icon rounded-circle p-50"></i>
                                            </span>
                                            <div>
                                                <p class="mb-25 latest-update-item-name text-bold-600">Total Sales</p>
                                                <small class="font-small-3">39.2k Sales</small>
                                            </div>
                                        </div>
                                        <span class="update-profit text-bold-600">26M</span>
                                    </li>
                                    <li
                                        class="list-group-item px-0 latest-updated-item border-0 pb-0 d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="list-group-item-icon d-inline mr-1">
                                                <i
                                                    class="icon icon-credit-card bg-light-danger text-danger total-revenue-icon rounded-circle p-50"></i>
                                            </div>
                                            <div>
                                                <p class="mb-25 latest-update-item-name text-bold-600">Total Revenue</p>
                                                <small class="font-small-3">45.5k New Revenue</small>
                                            </div>
                                        </div>
                                        <span class="update-profit text-bold-600">15.6M</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- recent invoice -->
                    <div class="col-xxl-6 col-xl-8 col-lg-8 col-md-12 col-12 latest-update-tracking">
                        <div class="card">
                            <div class="card-header latest-update-heading d-flex justify-content-between">
                                <h4 class="latest-update-heading-title text-bold-500">
                                Recent Invoice</h4>
                                
                            </div>
                            <div class="card-content latest-update-tracking-list pt-0 pb-1 px-2 position-relative">
                                <ul class="list-group">
                                    <li
                                        class="list-group-item pt-0 px-0 latest-updated-item border-0 d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <span class="list-group-item-icon d-inline mr-1">
                                                <i
                                                    class="icon text-primary bg-light-primary icon-bag total-products-icon rounded-circle p-50"></i>
                                            </span>
                                            <div>
                                                <p class="mb-25 latest-update-item-name text-bold-600">Total Products
                                                </p>
                                                <small class="font-small-3">1.2k Products</small>
                                            </div>
                                        </div>
                                        <span class="update-profit text-bold-600">$10.5k</span>
                                    </li>
                                    <li
                                        class="list-group-item px-0 latest-updated-item border-0 d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <span class="list-group-item-icon d-inline mr-1">
                                                <i
                                                    class="icon icon-graph bg-light-info text-info total-sales-icon rounded-circle p-50"></i>
                                            </span>
                                            <div>
                                                <p class="mb-25 latest-update-item-name text-bold-600">Total Sales</p>
                                                <small class="font-small-3">39.2k Sales</small>
                                            </div>
                                        </div>
                                        <span class="update-profit text-bold-600">26M</span>
                                    </li>
                                    <li
                                        class="list-group-item px-0 latest-updated-item border-0 d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <span class="list-group-item-icon d-inline mr-1">
                                                <i
                                                    class="icon icon-bag bg-light-danger text-danger total-products-icon rounded-circle p-50"></i>
                                            </span>
                                            <div>
                                                <p class="mb-25 latest-update-item-name text-bold-600">Total Products
                                                </p>
                                                <small class="font-small-3">1.2k Products</small>
                                            </div>
                                        </div>
                                        <span class="update-profit text-bold-600">$10.5k</span>
                                    </li>
                                    <li
                                        class="list-group-item px-0 latest-updated-item border-0 d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="list-group-item-icon d-inline mr-1">
                                                <i
                                                    class="icon icon-credit-card bg-light-primary text-primary total-revenue-icon rounded-circle p-50"></i>
                                            </div>
                                            <div>
                                                <p class="mb-25 latest-update-item-name text-bold-600">Total Revenue</p>
                                                <small class="font-small-3">45.5k New Revenue</small>
                                            </div>
                                        </div>
                                        <span class="update-profit text-bold-600">15.6M</span>
                                    </li>
                                    <li
                                        class="list-group-item px-0 latest-updated-item border-0 d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <span class="list-group-item-icon d-inline mr-1">
                                                <i
                                                    class="icon icon-graph bg-light-info text-info total-sales-icon rounded-circle p-50"></i>
                                            </span>
                                            <div>
                                                <p class="mb-25 latest-update-item-name text-bold-600">Total Sales</p>
                                                <small class="font-small-3">39.2k Sales</small>
                                            </div>
                                        </div>
                                        <span class="update-profit text-bold-600">26M</span>
                                    </li>
                                    <li
                                        class="list-group-item px-0 latest-updated-item border-0 pb-0 d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="list-group-item-icon d-inline mr-1">
                                                <i
                                                    class="icon icon-credit-card bg-light-danger text-danger total-revenue-icon rounded-circle p-50"></i>
                                            </div>
                                            <div>
                                                <p class="mb-25 latest-update-item-name text-bold-600">Total Revenue</p>
                                                <small class="font-small-3">45.5k New Revenue</small>
                                            </div>
                                        </div>
                                        <span class="update-profit text-bold-600">15.6M</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                                        <!-- active users card -->
<!--                     <div class="col-xl-8 col-lg-12">
                        <div class="card active-users">
                            <div class="card-header border-0">
                                <h4 class="card-title">Active Users</h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content">
                                <div id="audience-list-scroll" class="table-responsive position-relative">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Available Data</th>
                                                <th>Downloads</th>
                                                <th>Status</th>
                                                <th>More</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-truncate">
                                                    <div class="avatar avatar-md mr-1">
                                                        <img class="rounded-circle" src="{{asset('app-assets/images/portrait/small/avatar-s-11.png')}}" alt="Generic placeholder image">
                                                    </div>
                                                    <span class="text-truncate">Shwell Flintof</span>
                                                </td>
                                                <td class="align-middle">
                                                    <span>shwellFlint@gmail.com</span>
                                                </td>
                                                <td class="align-middle">
                                                    <span>450MB</span>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="progress my-75">
                                                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-valuenow="20" aria-valuemin="20" aria-valuemax="100" style="width:55%">55%</div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <span class="badge badge-success">Active</span>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="dropdown">
                                                        <span class="feather icon-more-vertical dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        </span>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="#">Subscription</a>
                                                            <a class="dropdown-item" href="#">Extras</a>
                                                            <a class="dropdown-item" href="#">Newslatter</a>
                                                        </div>
                                                    </div>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate">
                                                    <div class="avatar avatar-md mr-1">
                                                        <img class="rounded-circle" src="{{asset('app-assets/images/portrait/small/avatar-s-14.png')}}" alt="Generic placeholder image">
                                                    </div>
                                                    <span class="text-truncate">Ogasawara Katsumi</span>
                                                </td>
                                                <td class="align-middle">
                                                    <span>ogaats@hmail.com</span>
                                                </td>
                                                <td class="align-middle">
                                                    <span>457 MB</span>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="progress my-75">
                                                        <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" aria-valuenow="20" aria-valuemin="20" aria-valuemax="100" style="width:55%">55%</div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <span class="badge badge-warning">Reported</span>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="dropdown">
                                                        <span class="feather icon-more-vertical dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        </span>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="#">Subscription</a>
                                                            <a class="dropdown-item" href="#">Extras</a>
                                                            <a class="dropdown-item" href="#">Newslatter</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate">
                                                    <div class="avatar avatar-md mr-1">
                                                        <img class="rounded-circle" src="{{asset('app-assets/images/portrait/small/avatar-s-15.png ')}}" alt="Generic placeholder image">
                                                    </div>
                                                    <span class="text-truncate">Stepan Assonov</span>
                                                </td>
                                                <td class="align-middle">
                                                    <span>stepan23@hmail.com</span>
                                                </td>
                                                <td class="align-middle">
                                                    <span>231 MB</span>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="progress my-75">
                                                        <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" aria-valuenow="20" aria-valuemin="20" aria-valuemax="100" style="width:65%">65%</div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <span class="badge badge-danger">Block</span>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="dropdown">
                                                        <span class="feather icon-more-vertical dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        </span>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="#">Subscription</a>
                                                            <a class="dropdown-item" href="#">Extras</a>
                                                            <a class="dropdown-item" href="#">Newslatter</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate">
                                                    <div class="avatar avatar-md mr-1">
                                                        <img class="rounded-circle" src="{{asset('app-assets/images/portrait/small/avatar-s-4.png ')}}" alt="Generic placeholder image">
                                                    </div>
                                                    <span class="text-truncate">Mbe Tshinguta</span>
                                                </td>
                                                <td class="align-middle">
                                                    <span>tshinguta@hmail.com</span>
                                                </td>
                                                <td class="align-middle">
                                                    <span>723 MB</span>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="progress my-75">
                                                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-valuenow="20" aria-valuemin="20" aria-valuemax="100" style="width:78%">78%</div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <span class="badge badge-success">Active</span>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="dropdown">
                                                        <span class="feather icon-more-vertical dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        </span>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="#">Subscription</a>
                                                            <a class="dropdown-item" href="#">Extras</a>
                                                            <a class="dropdown-item" href="#">Newslatter</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate">
                                                    <div class="avatar avatar-md mr-1">
                                                        <img class="rounded-circle" src="{{asset('app-assets/images/portrait/small/avatar-s-11.png ')}}" alt="Generic placeholder image">
                                                    </div>
                                                    <span class="text-truncate">Marco Alves</span>
                                                </td>
                                                <td class="align-middle">
                                                    <span>maralv@dmail.com</span>
                                                </td>
                                                <td class="align-middle">
                                                    <span>120 MB</span>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="progress my-75">
                                                        <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" aria-valuenow="20" aria-valuemin="20" aria-valuemax="100" style="width:51%">51%</div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <span class="badge badge-warning">Reported</span>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="dropdown">
                                                        <span class="feather icon-more-vertical dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        </span>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="#">Subscription</a>
                                                            <a class="dropdown-item" href="#">Extras</a>
                                                            <a class="dropdown-item" href="#">Newslatter</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate">
                                                    <div class="avatar avatar-md mr-1">
                                                        <img class="rounded-circle" src="{{asset('app-assets/images/portrait/small/avatar-s-19.png ')}}" alt="Generic placeholder image">
                                                    </div>
                                                    <span class="text-truncate">Lucas Pacheco</span>
                                                </td>
                                                <td class="align-middle">
                                                    <span>pacheco@hmail.com</span>
                                                </td>
                                                <td class="align-middle">
                                                    <span>532 MB</span>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="progress my-75">
                                                        <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" aria-valuenow="20" aria-valuemin="20" aria-valuemax="100" style="width:47%">47%</div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <span class="badge badge-danger">Blocked</span>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="dropdown">
                                                        <span class="feather icon-more-vertical dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        </span>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="#">Subscription</a>
                                                            <a class="dropdown-item" href="#">Extras</a>
                                                            <a class="dropdown-item" href="#">Newslatter</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> -->


                </div>
                <!-- Minimal modern charts for power consumption, region statistics and sales etc. starts here -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    
@endsection