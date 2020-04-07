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
      .history_user {
        color: blue;
      }
      .history_payment_method {
        color: blue;
      }
      .patient-detail-row {
        margin-top: 4px;
      }
      a.disabled {
          cursor: not-allowed !important;
          pointer-events: none;
      }
      .modal-dialog {
        overflow-y: initial !important;
      }
      .modal-body {
        height: 400px;
        overflow-y: auto;
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
                                <div class="form-inline">
                                    <a href="{{route('invoice.create')}}" class="btn btn-primary"><i class="feather icon-plus"></i>&nbspCreate</a>
                                <a href="{{ route('invoi.download_invoice', 'xlsx') }}" class="btn btn-success" style="margin-left: 10px" ><i class="feather icon-download"></i>Download Excel</a>

                                </div>
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
                                                    <th style="display: none">Civil Id</th>
                                                    <th style="display: none">Phone number</th>
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
                                                    <td style="display: none">{{$invoice->getPatient->civil_id}}</td>
                                                    <td style="display: none">{{$invoice->getPatient->phone}}</td>
                                                    <td>$ {{$invoice->total_due}} </td>
                                                    <td> {{date('j F, Y', strtotime($invoice->created_at))}} </td>
                                                    <td><button class="btn btn-success btn-sm" onclick="showPatientDetail({{$invoice->civil_id}})">{{$invoice->getPatient->name}}</button></td>
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
                                                        <a href="#" id="send_link" class="primary edit mr-1" onclick="sendInvoice({{$invoice->id}}, this)">
                                                            <i class="feather icon-navigation" id="before_icon"></i>
                                                            <i class="fa fa-circle-o-notch fa-spin fa-fw spinner_icon" id="spinner_icon" style="display: none;"></i>
                                                        </a>
                                                        <a href="{{route('invoice.view_invoice', $invoice->id )}}" class="primary edit mr-1">
                                                            <i class="feather icon-eye"></i>
                                                        </a>
                                                        <a href="{{route('invoice.edit', $invoice->id )}}" class="primary edit mr-1">
                                                            <i class="feather icon-edit-1"></i>
                                                        </a>
                                                        <a href="#" onclick="openInvoiceHistoryModal('{{$invoice->invoice_id}}')"  class="primary edit mr-1">
                                                          <i class="fa fa-history"></i>
                                                        </a>
                                                        <a href="#" onclick="openPaymentHistoryModal('{{$invoice->invoice_id}}')" class="primary edit mr-1">
                                                            <i class="fa fa-money"></i>
                                                        </a>
                                                        @if(auth()->user()->type != 'staff')
                                                        <a href="{{route('home')}}" onclick="event.preventDefault(); confirm_delete({{$invoice->id}})"
                                                         class="danger delete mr-1"><i class="feather icon-trash"></i></a>
                                                        <form id="delete-form{{$invoice->id}}" action="{{route('invoice.destroy', $invoice->id)}}" method="post">
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

<div class="modal fade text-left" id="invoice_history_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
  <div class="modal-dialog"  role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="myModalLabel35">Invoice History</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <div class="modal-body">
                <div class="widget-timeline">
                  <ul id="history_content">
                      No data to display.
                  </ul>
              </div>
            </div>
    </div>
  </div>
</div>

<div class="modal fade text-left" id="patient_detail_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="myModalLabel35">Patient Detail</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <div class="modal-body">
                <div class="row patient-detail-row">
                  <div class="col-2"></div>
                  <div class="col-5">
                    Civil Id
                  </div>
                  <div class="col-4" id="pat_civil_id">

                  </div>
                </div>
                <div class="row patient-detail-row">
                  <div class="col-2"></div>
                  <div class="col-5">
                    Name
                  </div>
                  <div class="col-4" id="pat_name">

                  </div>
                </div>
                <div class="row patient-detail-row">
                  <div class="col-2"></div>
                  <div class="col-5">
                    Phone number
                  </div>
                  <div class="col-4" id="pat_phone">

                  </div>
                </div>
                <div class="row patient-detail-row">
                  <div class="col-2"></div>
                  <div class="col-5">
                    Email
                  </div>
                  <div class="col-5" id="pat_email">

                  </div>
                </div>
                <div class="row patient-detail-row">
                  <div class="col-2"></div>
                  <div class="col-5">
                    Address
                  </div>
                  <div class="col-5" id="pat_address">

                  </div>
                </div>
            </div>
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

    function sendInvoice(id, obj) {
        event.preventDefault();
        console.log("12345")
        if ($("#send_link").hasClass("disabled")) {
            console.log("Disabled....");
            return;
        }
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
            $('#send_link').addClass("disabled");
            $("#spinner_icon").show();
            $("#before_icon").hide();
            $.post("{{route('invoi.send_invoice')}}", {id: id, _token:"{{csrf_token()}}"}, function(data) {
                console.log(data)
                var object = JSON.parse(data);
                if (object.status=='success') {
                    $('#send_link').removeClass("disabled");
                    $("#spinner_icon").hide();
                    $("#before_icon").show();
                    toastr.success(object.status, object.msg, {"showMethod": "slideDown", "hideMethod": "slideUp", timeOut: 1500});
                }
            })
          }
        });
    }

    function openInvoiceHistoryModal(invoice_id) {
      console.log(invoice_id);
      $("#invoice_history_modal").modal();
      $("#history_content").html('No data to display');
      $.post("{{route('invoi.get_invoice_history')}}", {invoice_id: invoice_id, _token:"{{csrf_token()}}"}, function(data) {
        var obj = JSON.parse(data);
        if (obj.status === 'success') {
          var content = '';
          for (var i = 0 ; i < obj.data.length; i ++) {
            var his = obj.data[i];
            // console.log(his);
            switch(his.action_type) {
              case 'created':
                var item = `<li class="timeline-items timeline-icon-success">
                                <p class="timeline-time">` + his.created_at + `</p>
                                <div class="timeline-title">` + his.action_type.toUpperCase() + `</div>
                                <div class="timeline-subtitle">Invoice ` + his.action_type + " by " + his.user_name + `</div>
                            </li>`;
                content += item;
                break;
              case 'published':
                var item = `<li class="timeline-items timeline-icon-info">
                                <p class="timeline-time">` + his.created_at + `</p>
                                <div class="timeline-title">` + his.action_type.toUpperCase() + `</div>
                                <div class="timeline-subtitle">Invoice ` + his.action_type + " by " + his.user_name + `</div>
                            </li>`;
                content += item;
                break;
              case 'unpublished':
                var item = `<li class="timeline-items timeline-icon-danger">
                                <p class="timeline-time">` + his.created_at + `</p>
                                <div class="timeline-title">` + his.action_type.toUpperCase() + `</div>
                                <div class="timeline-subtitle">Invoice ` + his.action_type + " by " + his.user_name + `</div>
                            </li>`;
                content += item;
                break;
              case 'sent':
                var item = `<li class="timeline-items timeline-icon-info">
                                <p class="timeline-time">` + his.created_at + `</p>
                                <div class="timeline-title">` + his.action_type.toUpperCase() + `</div>
                                <div class="timeline-subtitle">Invoice ` + his.action_type + " by " + his.user_name + `</div>
                            </li>`;
                content += item;
                break;
              default:
                var item = `<li class="timeline-items timeline-icon-info">
                                <p class="timeline-time">` + his.created_at + `</p>
                                <div class="timeline-title">` + his.action_type.toUpperCase() + `</div>
                                <div class="timeline-subtitle">Invoice ` + his.action_type + " by " + his.user_name + `</div>
                            </li>`;
                content += item;
                break;

            }
            // console.log(content);
            $("#history_content").html(content);
          }
        }
      })
    }

    function openPaymentHistoryModal(invoice_id) {
      // console.log(invoice_id);
      $("#invoice_history_modal").modal();
      $("#history_content").html('No data to display');
      $.post("{{route('invoi.get_payment_history')}}", {invoice_id: invoice_id, _token:"{{csrf_token()}}"}, function(data) {
        var obj = JSON.parse(data);
        // console.log(obj)
        if (obj.status === 'success') {
          var content = '';
          for (var i = 0 ; i < obj.data.length; i ++) {
            var his = obj.data[i];
            console.log(his);
            switch(his.status) {
              case 'success':
                var item = `<li class="timeline-items timeline-icon-success">
                                <p class="timeline-time">` + his.created_at + `</p>
                                <div class="timeline-title">Payment  Successed.</div>
                                <div class="timeline-subtitle">Paid by <label class="history_user">` + his.user_name + `,&nbsp </label>
                                  <label>Type: </label><label class="history_payment_method" style='padding-top: 8px;'>&nbsp` + his.payment_method.toUpperCase() + `, </label> &nbsp &nbsp
                                  <label>Amount: </label><label>&nbspKWD <b style="color: black">` + his.amount + `</b></label>
                                </div>
                            </li>`;
                content += item;
                break;
              case 'published':
                var item = `<li class="timeline-items timeline-icon-info">
                                <p class="timeline-time">` + his.created_at + `</p>
                                <div class="timeline-title">` + his.action_type.toUpperCase() + `</div>
                                <div class="timeline-subtitle">Invoice ` + his.action_type + " by " + his.user_name + `</div>
                            </li>`;
                content += item;
                break;
            }
            // console.log(content);
            $("#history_content").html(content);
          }
        }
      })
    }

    function showPatientDetail(patient_id) {
      // console.log(patient_id);
      $("#patient_detail_modal").modal();
      $.post("{{route('pat.get_patient_detail')}}", {id: patient_id, _token:"{{csrf_token()}}"}, function(data) {
        console.log(data);
        var obj = JSON.parse(data);
        if (obj) {
          $("#pat_civil_id").html(obj.civil_id);
          $("#pat_name").html(obj.name);
          $("#pat_phone").html(obj.phone);
          $("#pat_email").html(obj.email);
          $("#pat_address").html(obj.address);
        }
      })
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
