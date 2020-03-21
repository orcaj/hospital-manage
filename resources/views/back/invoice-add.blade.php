@extends('layouts.app')
@section('content')
    <!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
    	<div class="content-body">
            <!-- invoice add wrapper -->
            <div class="invoice-add-wrapper">
                <!-- defining a Bootstrap row -->
                <div class="row">
                    <!-- defining Bootstrap columns for diffrent screen sizes -->
                    <div class="col-xl-9 col-md-8 col-12">
                        <!-- Bootstrap card component -->
                        <div class="card">
                            <div class="card-body">
                                <!-- logo and invoice title -->
                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <h4 class="invoice-title text-primary">Civil Id</h4>
                                        <select class="form-control select2" id="patient_id" onchange="onPatientChange()">
                                            <option value="">Input Civil Id</option>
                                            @foreach($patients as $patient)
                                                <option value="{{$patient->id}}">{{$patient->civil_id}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-12" style="display: flex;align-items: flex-end;">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#add-patient-modal">Add Patient</button>
                                    </div>
                                </div>
                                <hr>


                                <!-- bill address section -->
                                <div class="row">
                                    <div class="col-lg-6 col-xl-6 col-xs-12 col-sm-12">
                                        <div class="title-text">Bill To</div>
                                        <div class="row">
                                            <div class="col-12 col-xs-12 mb-1">
                                                <input type="text" class="form-control" value="" placeholder="Patient name" id="patient_name">
                                            </div>
                                            <div class="col-12 col-xs-12 mb-1">
                                                <textarea class="form-control" rows="3" placeholder="Phone number" id="patient_phone"></textarea>
                                            </div>
                                            <div class="col-12 col-xs-12 mb-1">
                                                <input type="text" class="form-control" value="" placeholder="E-mail" id="patient_email">
                                            </div>
                                            <div class="col-12 col-xs-12 mb-2">
                                                <input type="text" class="form-control" value="" placeholder="Address" id="patient_address">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <!-- invoice product details -->
                                <div class="invoice-product-details">
                                    <form class="repeater-form">
                                        <div data-repeater-list="group-a">
                                            <div data-repeater-item class="mb-1">
                                                <div class="repeater-controls d-flex">
                                                    <div class="input-fields border border-light rounded p-1 d-flex" style="width: 100%;">
                                                        <div class="row invoice-item-controls d-flex" style="width: 100%;">
                                                            <div class="col-12 col-md-6 form-group item-name">
                                                                <label>Department</label>
                                                                <select class="form-control select2" id="department" onchange="changeDepart()">
                                                                    <option value="">--Select department--</option>
                                                                    @foreach($departments as $department)
                                                                        <option value="{{$department->id}}">{{$department->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-12 col-md-6 form-group item-cost">
                                                                <label>Doctor</label>
                                                                <select class="form-control select2" id="doctor" onchange="changeDoctor()">
                                                                </select>
                                                            </div>
                                                            <div class="col-12 col-md-6 form-group item-description mb-0">
                                                                <!-- <input type="text" class="form-control description-input" value="The most developer friendly & highly customisable HTML5 Admin"> -->
                                                                <select class="form-control select2" style="width: 100%;" onchange="changeService()" id="service">
                                                                </select>
                                                            </div>
                                                            <div class="col-12 col-md-6 form-group discounts mb-0">
                                                                <input type="text" class="form-control" id="service_price" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button data-repeater-create class="btn btn-primary mt-1" type="button">
                                                <i class="fa fa-plus"></i> Add Service
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <hr>

                                <!-- invoice bill total -->
                                <div class="invoice-total">
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-6 col-xl-5">
                                            <div class="regarding-payment form-group">
                                                <input type="text" class="form-control" value="" placeholder="Add payment terms">
                                            </div>
                                            <div class="regarding-discount form-group">
                                                <input type="text" class="form-control" value="" placeholder="Add client note">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6 col-xl-5 offset-xl-2">
                                            <ul class="list-group cost-list">
                                                <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                                    <span class="cost-title mr-2">Subtotal </span>
                                                    <span class="cost-value">$ 00.00</span>
                                                </li>
                                                <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                                    <span class="cost-title mr-2">Discount </span>
                                                    <span class="cost-value">-$ 00.00</span>
                                                </li>
                                                <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                                    <span class="cost-title mr-2">Tax </span>
                                                    <span class="cost-value">0%</span>
                                                </li>
                                                <li class="dropdown-divider"></li>
                                                <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                                    <span class="cost-title mr-2">Invoice Total </span>
                                                    <span class="cost-value">$ 00.00</span>
                                                </li>
                                                <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                                    <span class="cost-title mr-2">Paid To Date </span>
                                                    <span class="cost-value">-$ 00.00</span>
                                                </li>
                                                <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                                    <span class="cost-title mr-2">Balance (USD) </span>
                                                    <span class="cost-value">$ 00.00</span>
                                                </li>
                                            </ul>
                                            <button class="btn btn-primary mt-1 btn-block">Preview</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-4 col-12">
                        <div class="action-buttons card">
                            <div class="card-body">
                                <button class="btn btn-block btn-primary mb-1"><i class="fa fa-share common-size"></i> Send
                                    Invoice</button>
                                <button class="btn btn-block btn-primary mb-1">Download Invoice</button>
                                <div class="inline-btns w-100 d-flex justify-content-between">
                                    <div class="btn-save w-50 mr-50">
                                        <button class="btn btn-light mb-1 btn-block">Preview</button>
                                    </div>
                                    <div class="btn-preview w-50 ml-50">
                                        <button class="btn btn-light mb-1 btn-block">Save</button>
                                    </div>
                                </div>
                                <button class="btn btn-block btn-success"><i class="fa fa-usd common-size"></i>
                                    Payment</button>
                            </div>
                        </div>
                        <div class="payment-options border rounded m-0 py-2 row">
                            <div class="col-12">
                                <h6 class="title">Accept Payment Via</h6>
                            </div>
                            <div class="col-12 mt-75">
                                <select name="payment" id="paymentOption" class="form-control bg-transparent mb-1">
                                    <option value="DebitCard">Debit Card</option>
                                    <option value="DebitCard">Credit Card</option>
                                    <option value="DebitCard">Paypal</option>
                                    <option value="DebitCard">Internet Banking</option>
                                    <option value="DebitCard">UPI Transfer</option>
                                </select>
                            </div>
                            <div class="col-12 mt-1">
                                <div class="form-group mb-25">
                                    <div class="float-right">
                                        <input type="checkbox" name="switchery" id="switchery0" class="switchery" checked />
                                    </div>
                                    <label for="switchery0" class="font-medium-2">Payment Terms</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-25">
                                    <div class="float-right">
                                        <input type="checkbox" name="switchery" id="switchery1" class="switchery" checked />
                                    </div>
                                    <label for="switchery0" class="font-medium-2">Client Notes</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-25">
                                    <div class="float-right">
                                        <input type="checkbox" name="switchery" id="switchery2" class="switchery" />
                                    </div>
                                    <label for="switchery0" class="font-medium-2">Payment Stub</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade text-left" id="add-patient-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel35">Add Patient</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <form action="" id='add-patient'>
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <div class="controls">

                                        <label>Patient Name</label>
                                        <input type="text" class="form-control" placeholder="Patient Name" id="add_patient_name" name="name" value="" required data-validation-required-message="Patient name is required" pattern="[a-zA-Z ]+" data-validation-pattern-message="Only characters allowed">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="controls">
                                        <label>E-mail</label>
                                        <input type="email" class="form-control" placeholder="Email" id="add_patient_email" name="email" value="" required data-validation-required-message="Email is required">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">

                                <div class="form-group">
                                    <div class="controls">
                                        <label>Civil Id</label>
                                        <input type="text" name="civil_id" class="form-control" placeholder="Civil ID" id="add_patient_civil_id" value="" required data-validation-required-message="Civil Id is required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="controls">
                                        <label>Contact Phone</label>
                                        <input type="text" name="phone" class="form-control" placeholder="Contact Phone" value="" required  id="add_patient_phone" pattern="[0-9]+" data-validation-pattern-message="Only numbers allowed" data-validation-required-message="Phone number is required">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">

                                <div class="form-group">
                                <div class="controls">
                                    <label>Address</label>
                                    <input type="text" id="address" name="address" class="form-control" required id="add_patient_address" data-validation-required-message="Address is required" placeholder="Address">
                                </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="form-actions clearfix">
                                    <div class="buttons-group float-left">
                                        <a href="{{route('patients.index')}}" class="btn btn-warning mr-1">
                                            Close
                                        </a>
                                    </div>
                                    <div class="buttons-group float-right">
                                        <button type="submit" class="btn btn-info mr-1"  onclick="event.preventDefault(); addPatient();">Create</button>
                                        <button type="reset" class="btn btn-danger mr-1">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function onPatientChange() {
        // console.log("chnagd");
        $.post("{{route('pat.get_patient_detail')}}", {id: $("#patient_id").val(), _token:"{{csrf_token()}}"}, function(data) {
            var data = JSON.parse(data);
            console.log(data);
            if (!data) {
                $("#patient_name").val("");
                $("#patient_phone").val("");
                $("#patient_email").val("");
                $("#patient_address").val("");
            } else {
                $("#patient_name").val(data.name);
                $("#patient_phone").val(data.phone);
                $("#patient_email").val(data.email);
                $("#patient_address").val(data.address);
            }
        })
    }
    function addPatient() {
        // $('#add-patient-modal').modal('hide');
        // $("#add-patient").submit();
        // console.log($("#add-patient")[0].checkValidity(), $("#add-patient")[0]);
        if (!$("#add-patient")[0].checkValidity()) {
            $("#add-patient").submit();
        } else {
            var data = new Object();
            data.name = $("#add_patient_name").val();
            data.civil_id = $("#add_patient_civil_id").val();
            data.email = $("#add_patient_email").val();
            data.phone = $("#add_patient_phone").val();
            data.address = $("#add_patient_phone").val();
            $.post("{{route('pat.add_patient_on_invoice')}}", {data:data, _token:"{{csrf_token()}}"}, function(data){
                var data = JSON.parse(data);
                console.log(data);
                if (data.status == 'success') {
                    $('#add-patient-modal').modal('hide');
                    toastr.success(data.msg, data.status, {"showMethod": "slideDown", "hideMethod": "slideUp", timeOut: 1500});
                    $("#patient_id").append("<option value='" + data.data.id + "'>" + data.data.civil_id + "</option>");
                    $("#patient_id").val(data.data.id);
                    $("#patient_name").val(data.data.name);
                    $("#patient_phone").val(data.data.phone);
                    $("#patient_email").val(data.data.email);
                    $("#patient_address").val(data.data.address);
                } else {
                    toastr.error(data.msg, data.status, {"showMethod": "slideDown", "hideMethod": "slideUp", timeOut: 1500});
                    $("#add_patient_civil_id").css('border-color', 'red');
                    $("#add_patient_civil_id").focus();
                }
            })
            // console.log(data);
        }
    }
    function changeDepart() {
        var doctorId = $("#department").val();
        $.post("{{route('doct.get_doctor_by_department')}}", {id: doctorId, _token:"{{csrf_token()}}"}, function(data) {
            var data = JSON.parse(data);
            if (data) {
                console.log(data);
                var options = "<option value=''>--Select Doctor--</option>";
                data.forEach(ele => {
                    var option = "<option value='" + ele.id + "'>" + ele.name + "</option>";
                    options += option;
                });
                console.log(options);
                $("#doctor").html(options);
            }
        })
    }
    function changeDoctor() {
        var doctorId = $("#doctor").val();
        var departId = $("#department").val();
        console.log("doctor: ", doctorId);
        $.post("{{route('servi.get_service_by_doctor_depart')}}", {doctorId: doctorId, departId: departId, _token:"{{csrf_token()}}"}, function(data) {
            // console.log(data);
            var data = JSON.parse(data);
            var services = "<option value=''>--Select Service--</option>";
            if (data) {
                // var service = "<option value='" + ele.id + "'>" + ele.name + "</option>";
                data.forEach(ele => {
                    var service = "<option value='" + ele.id + "'>" + ele.name + "</option>";
                    services += service;
                });

            }
            $("#service").html(services);
        });
    }
    function changeService() {
        var serviceId = $("#service").val();
        console.log("sss", serviceId);
        $.post("{{route('servi.get_service_detail_on_invoice')}}", {id: serviceId, _token:"{{csrf_token()}}"}, function(data) {
            var data = JSON.parse(data);
            if (data) {
                $("#service_price").val(data.price);
            }
        })
    }
    $(function(){
        // var civil_id = $("#patient_id").val();

    })
</script>
@endsection
