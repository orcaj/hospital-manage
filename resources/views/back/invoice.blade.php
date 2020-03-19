@extends('layouts.app')
@section('content')


    <style type="text/css">
      .space-bet{
        display: flex;
        justify-content: space-between;
      }
      .space-center{
        display: flex;
      }
    </style>
    <!-- BEGIN: Content-->
    <div class="app-content content">

    	<!-- alert section -->

    	@if(session('status'))
    	<div class="alert alert-success alert-dismissible mb-2" role="alert">
            {{session('status')}}
        </div>
        @endif
        <!-- alert section end -->
        
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- users list start -->
                <section class="users-list-wrapper">
                    <div class="users-list-table">
                        <div class="card">
                            <div class="card-content">
                              <div class="card-header space-bet">
                                <h3 class="card-title" id="emailCompose">Invoice List</h3>
                                <a href="{{route('invoice.create')}}" class="btn btn-primary btn-min-width mr-1 mb-1"><i class="feather icon-user-plus"></i>&nbspCreate</a>
                            </div>
                                <div class="card-body">
                                    <!-- datatable start -->
                                    <div class="table-responsive">
                                        <table id="users-list-datatable" class="table center-table">
                                            <thead>
                                            	  
                                                <tr>
                                                    <th>No</th>
                                                    <th>Patient Civil ID</th>
                                                    <th>Patient Name</th>
                                                    <th>Service Name</th>
                                                    <th>Department</th>
                                                    <th>Doctor</th>
                                                    <th>Price</th>
                                                    <th style="width: 20%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              @foreach($invoices as $key => $invoice)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td> {{$invoice->civil_id}} </td>
                                                    <td> {{$invoice->getPatient->name}} </td>
                                                    <td> {{$invoice->getService->name}} </td>
                                                    <td> {{$invoice->getService->getDepartment->name}} </td>
                                                    <td> {{$invoice->getService->getDoctor->name}} </td>
                                                    <td> {{$invoice->getService->price}} </td>
                                                    <td class="text-center"> 
                                                        <a href="{{route('invoice.edit', $invoice->id )}}" class="primary edit mr-1">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <a href="{{route('home')}}" onclick="event.preventDefault(); document.getElementById('delete-form').submit();"
                                                         class="danger delete mr-1"><i class="fa fa-trash-o"></i></a>
                                                        <form id="delete-form" action="{{route('invoice.destroy',  $invoice->id  )}}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- datatable ends -->
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- users list ends -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection