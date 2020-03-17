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
                                <h3 class="card-title" id="emailCompose">Doctor List</h3>
                                <a href="{{route('doctors.create')}}" class="btn btn-primary btn-min-width mr-1 mb-1"><i class="feather icon-user-plus"></i>&nbspCreate</a>
                            </div>
                                <div class="card-body">
                                    <!-- datatable start -->
                                    <div class="table-responsive">
                                        <table id="users-list-datatable" class="table">
                                            <thead>
                                            	  
                                                <tr>
                                                    <th>No</th>
                                                    <th>name</th>
                                                    <th>email</th>
                                                    <th>Department</th>
                                                    <th>Tel</th>
                                                    <th style="width: 20%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              @foreach($doctors as $key => $doctor)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td> {{$doctor->name}} </td>
                                                    <td> {{$doctor->email}} </td>
                                                    <td> {{$doctor->getDepartment->name}} </td>
                                                    <td> {{$doctor->tel}} </td>
                                                    <td class="text-center"> 
                                                        <a href="{{route('doctors.edit', $doctor->id )}}" class="primary edit mr-1">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <a href="{{route('home')}}" onclick="event.preventDefault(); document.getElementById('delete-form').submit();"
                                                         class="danger delete mr-1"><i class="fa fa-trash-o"></i></a>
                                                        <form id="delete-form" action="{{route('doctors.destroy',  $doctor->id  )}}" method="post">
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