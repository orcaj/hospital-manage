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
      .pime-grid-button{
        float:left;

      }
      .pime-grid-filter{float:left;margin-left:10px}
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
                                                    @if(auth()->user()->type !='staff')
                                                    <th class="text-center"><input type="checkbox" id="selectAll" data-size="sm" ></th>
                                                    @endif
                                                    <th>Invoice #</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
                                                    <th>Patient</th>
                                                    <th>Payment Status</th>
                                                    <th>Status</th>
                                                    <!-- <th>Price</th> -->
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              @foreach($invoices as $key => $invoice)
                                                <tr>
                                                    @if(auth()->user()->type !='staff')
                                                    <td class="text-center">
                                                        <input type="checkbox" class="check_item" unikey="{{$invoice->id}}" id="test-{{$key}}" name="test-{{$key}}" data-size="sm">
                                                    </td>
                                                    @endif
                                                    <td>{{$invoice->invoice_id}}</td>
                                                    <td>$ {{$invoice->total_due}} </td>
                                                    <td> {{date('j F, Y', strtotime($invoice->created_at))}} </td>
                                                    <td>{{$invoice->getPatient->name}}</td>
                                                    <td>
                                                        @if($invoice->total_due == 0)
                                                            <span class="badge badge-success badge-pill">PAID</span>
                                                        @elseif($invoice->total_paid != 0 && $invoice->total_due != 0)
                                                            <span class="badge badge-warning badge-pill">Partially Paid</span>
                                                        @elseif($invoice->total_due > $invoice->total_paid)
                                                            <span class="badge badge-danger badge-pill">UNPAID</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($invoice->status == "published")
                                                            <span class="badge badge-primary">Published</span>

                                                        @else
                                                        <span class="badge badge-danger">Unpublished</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if($invoice->is_sent=='1')
                                                        <a href="#" class="primary edit mr-1" style="pointer-events: none;cursor: no-drop">
                                                            <i class="feather icon-check-circle"></i>
                                                        </a>
                                                        @else
                                                        <a href="#" class="primary edit mr-1" onclick="sendInvoice({{$invoice->id}})">
                                                            <i class="feather icon-navigation"></i>
                                                        </a>
                                                        @endif
                                                        <a href="{{route('invoice.edit', $invoice->id )}}" class="primary edit mr-1">
                                                            <i class="feather icon-eye"></i>
                                                        </a>
                                                        <a href="{{route('invoice.edit', $invoice->id )}}" class="primary edit mr-1">
                                                            <i class="feather icon-edit-1"></i>
                                                        </a>
                                                        @if(auth()->user()->type != 'staff')
                                                        <a href="{{route('home')}}" onclick="event.preventDefault(); confirm_delete({{$invoice->id}})"
                                                         class="danger delete mr-1"><i class="feather icon-trash"></i></a>
                                                        <form id="delete-form{{$invoice->id}}" action="{{route('invoice.destroy',  $invoice->id  )}}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                        @endif
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
     <form id="multi-delete" action="{{route('invoi.multi_delete')}}" method="post">
        @csrf
        <input type="hidden" name="sel_ids" id="del_ids">
    </form>
    <!-- END: Content-->

    <!-- status multi -->
    <form id="multi-status" action="{{route('invoi.multi_status')}}" method="post">
        @csrf
        <input type="hidden" name="sel_ids" id="status_ids">
        <input type="hidden" name="status" id="status">
    </form>
     @if(session('action'))
     <script type="text/javascript">
        $(function(){
            var action = "<?php echo session('action') ?>";
            var msg = "<?php echo session('msg') ?>";
            console.log("sadf", msg);
            toastr.success(msg, action, {"showMethod": "slideDown", "hideMethod": "slideUp", timeOut: 1500});
        })
    </script>
    @endif
<script type="text/javascript">
    function confirm_delete(id){
        Swal.fire({

          title: "Delete",
          text: "Are you sure that you want to delete this record?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",

          confirmButtonText: "Yes",
          confirmButtonClass: "btn btn-primary",
          cancelButtonClass: "btn btn-danger ml-1",
          buttonsStyling: false
        }).then(function(result) {
          if (result.value) {
            $("#delete-form" + id).submit();
            Swal.fire({
              type: "success",
              title: "Deleted!",
              text: "Your file has been deleted."
              // confirmButtonClass: "btn btn-success"
            });
          }
        });
    }
    function multi_delete(){
        var items=$(".check_item:checked");
        sel_ids=[];
        for (var i = items.length - 1; i >= 0; i--) {
            del_id=$(items[i]).attr('unikey');
            sel_ids.push(del_id);
        }
        $("#del_ids").val(sel_ids);

        Swal.fire({
          title: "Delete",
          text: "Are you sure that you want to delete these records?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes",
          confirmButtonClass: "btn btn-primary",
          cancelButtonClass: "btn btn-danger ml-1",
          buttonsStyling: false
        }).then(function(result) {
          if (result.value) {
            $("#multi-delete").submit();
          }
        });
    }
    function multi_status(){
        var items=$(".check_item:checked");
        var msg = '';
        status=$("#status_sel").val();
        if (status == 'Publish')
          msg = 'Are you sure you want to publish these records?';
        else msg = 'Are you sure you want to unpublish these records?';
        if(status != ""){
            if(items.length == 0){
                Swal.fire({
                  title: "warning",
                  text: "Please select record(s).",
                  type: "error",
                  confirmButtonClass: "btn btn-danger",
                  buttonsStyling: false
                });
                $("#status_sel").val("");
            }else{
                sel_ids=[];
                for (var i = items.length - 1; i >= 0; i--) {
                    sel_id=$(items[i]).attr('unikey');
                    sel_ids.push(sel_id);
                }
                $("#status_ids").val(sel_ids);
                  var title = '';
                  if (status === 'published'){
                    title = 'Publish';
                  } else {
                    title = 'UnPublish';
                  }
                    Swal.fire({
                      title: title,
                      text: msg,
                      type: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#3085d6",
                      cancelButtonColor: "#d33",
                      confirmButtonText: "Yes",
                      confirmButtonClass: "btn btn-primary",
                      cancelButtonClass: "btn btn-danger ml-1",
                      buttonsStyling: false
                    }).then(function(result) {
                    if (result.value) {
                      $("#status").val(status);
                      $("#multi-status").submit();
                    }
                  });

            }
        }
    }
    function del_btn(){
        sel_item=$("input[type=checkbox]:checked");
        sel_count=sel_item.length;

        if(sel_count > 0){

            $("#multi-del").css('visibility', 'visible');
        }else{

            $("#multi-del").css('visibility', 'hidden');
        }

        total_count=$(".check_item").length;
        if(total_count == sel_count){
            $("#selectAll").prop("checked", true);
        }
    }

    function sendInvoice(id) {
        event.preventDefault();
        Swal.fire({
          title: "Send Invoice",
          text: "Are you sure that you want to send this invoice?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes",
          confirmButtonClass: "btn btn-primary",
          cancelButtonClass: "btn btn-danger ml-1",
          buttonsStyling: false
        }).then(function(result) {
          if (result.value) {
            $.post("{{route('invoi.send_invoice')}}", {id: id, _token:"{{csrf_token()}}"}, function(data) {
                console.log(data)
            })
            toastr.success("sent", "Invoice sent", {"showMethod": "slideDown", "hideMethod": "slideUp", timeOut: 1500});
          }
        });
    }
    $(function(){
        $("#selectAll").click(function() {
            console.log($(this).prop("checked"))
            $(".check_item").prop("checked", $(this).prop("checked"));
        });

        $("input[type=checkbox]").click(function() {
            if (!$(this).prop("checked")) {
                $("#selectAll").prop("checked", false);
            }
            del_btn();
        });

    })
</script>
@endsection