@extends('layouts.app')
@section('content')

 <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0">Invoice list</h3>
                </div>
                <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                            <button class="btn btn-outline-primary dropdown-toggle dropdown-menu-right" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-settings icon-left"></i> Settings</button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1"><a class="dropdown-item" href="card-bootstrap.html">Bootstrap Cards</a><a class="dropdown-item" href="component-buttons-extended.html">Buttons Extended</a></div>
                        </div><a class="btn btn-outline-primary" href="full-calender-basic.html"><i class="feather icon-mail"></i></a><a class="btn btn-outline-primary" href="timeline-center.html"><i class="feather icon-pie-chart"></i></a>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="row mb-1 mt-1 mt-md-0">
                    <div class="col-12">
                        <a href="invoice-add.html" class="btn btn-primary">Create Invoice</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <!-- datatable started -->
                        <div id="app-invoice-wrapper" class="">
                            <table id="app-invoice-table" class="table" style="width: 100%;">
                                <thead class="border-bottom border-dark">
                                    <tr>
                                        <th>
                                            <span class="align-middle">Invoice#</span>
                                        </th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Customer</th>
                                        <th>Tags</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href="invoice-view.html">INV-00956</a>
                                        </td>
                                        <td><span class="invoice-amount">$459.30</span></td>
                                        <td><span class="invoice-date">12-08-19</span></td>
                                        <td><span class="invoice-customer">Pixinvent PVT. LTD</span></td>
                                        <td>
                                            <span class="bullet bullet-success bullet-sm"></span>
                                            Technology
                                        </td>
                                        <td><span class="badge badge-danger badge-pill">UNPAID</span></td>
                                        <td>
                                            <div class="invoice-action">
                                                <a href="invoice-view.html" class="invoice-action-view mr-1">
                                                    <i class="feather icon-eye"></i>
                                                </a>
                                                <a href="invoice-edit.html" class="invoice-action-edit cursor-pointer">
                                                    <i class="feather icon-edit-1"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection