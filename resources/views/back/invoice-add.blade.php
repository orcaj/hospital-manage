@extends('layouts.app')
@section('content')
    <!-- BEGIN: Content-->
<div class="app-content content" id="invoiceForm">
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
                                    <div class="col-sm-3 col-12">
                                        <h4 class="invoice-title text-primary">Civil Id</h4>
                                        <select class="form-control select2" id="patient_id" onchange="onPatientChange()">
                                            <option value="">Input Civil Id</option>
                                            @foreach($patients as $patient)
                                                <option value="{{$patient->id}}">{{$patient->civil_id}}</option>
                                            @endforeach
                                        </select>
                                       <!--  <ul role="alert"><li>This email field is required</li></ul> -->
                                        
                                    </div>
                                    <div class="col-sm-5 col-12" style="display: flex; align-items: baseline">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#add-patient-modal" style="margin-top: 28px;">Add Patient</button>
                                        <!-- <input type="" name="" > -->
                                        
                                    </div>
                                    <div class="issue-date col-md-4 col-12" style="display: flex;align-items: flex-end;">
                                        <h6 class="invoice-text font-weight-bold">Date Issue</h6>
                                        <input type="text" name="date" class="pick-a-date bg-white form-control" placeholder="Select Date" id="date_issue" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 d-flex justify-content-start align-items-lg-start align-items-sm-start align-items-start  align-items-center flex-wrap px-0 pt-xl-0 pt-1" style="margin-top: 20px">
                                        <div class="due-date d-flex align-items-center justify-content-start col-md-6 col-12">
                                            <h6 class="invoice-text font-weight-bold">Date Due</h6>
                                            <input type="text" name="date" class="pick-a-date bg-white form-control" placeholder="Select Date" id="due_date">
                                        </div>
                                        <div class="due-date d-flex align-items-center justify-content-start col-md-6 col-12">
                                            <h6 class="invoice-text font-weight-bold">Appointment Date</h6>
                                            <input type="text" name="date" class="pick-a-date bg-white form-control" placeholder="Select Date" id="appointment_date">
                                        </div>
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
                                                                <select class="form-control" onchange="changeDepart(this)">
                                                                    <option value="">--Select department--</option>
                                                                    @foreach($departments as $department)
                                                                        <option value="{{$department->id}}">{{$department->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-12 col-md-6 form-group item-cost">
                                                                <label>Doctor</label>
                                                                <select class="form-control"  onchange="changeDoctor(this)">
                                                                </select>
                                                            </div>
                                                            <div class="col-12 col-md-6 form-group item-description mb-0">
                                                                <!-- <input type="text" class="form-control description-input" value="The most developer friendly & highly customisable HTML5 Admin"> -->
                                                                <select class="form-control service_id" style="width: 100%;" onchange="changeService(this)">
                                                                </select>
                                                            </div>
                                                            <div class="col-12 col-md-4 form-group discounts mb-0">
                                                                <input type="text" class="form-control service_price" disabled>
                                                            </div>
                                                            <div class="col-12 col-md-2 form-group discounts mb-0">
                                                                    <div class='discount-element'>
                                                                        <span class="title-text">Discount:</span>
                                                                        <span class="discount-value">0</span><span>%</span>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        <div class="delete-and-discount-config h-100 ml-50 d-flex flex-column justify-content-between">
                                                    <span class="cursor-pointer d-flex justify-content-center align-items-center" onclick="removePanel(this)" >
                                                                <i class="fa fa-times-circle-o font-size-increase" data-repeater-delete></i>
                                                            </span>
                                                            <div class="dropdown d-flex justify-content-center align-items-center">
                                                                <span role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fa fa-cog font-size-increase m-0"></i>
                                                                </span>
                                                                <div class="dropdown-menu p-1 dropdown-sizing" aria-labelledby="dropdownMenuButton">
                                                                    <div class="row invoice-taxes-controls">
                                                                        <div class="col-12 form-group">
                                                                            <label for="discount">Discount(%)</label>
                                                                            <input type="number" class="form-control" id="applicable-discount" placeholder="0">
                                                                        </div>
                                                                        <hr>
                                                                        <div class="col-12 buttons d-flex justify-content-between mt-1">
                                                                            <button type="button" class="btn btn-primary discount-apply-btn">Apply</button>
                                                                            <button type="button" class="btn btn-light cancel-btn">Cancel</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
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
                                                <input type="text" class="form-control" value="" placeholder="Add payment terms" id="payment_terms">
                                            </div>
                                            <div class="regarding-discount form-group">
                                                <input type="text" class="form-control" value="" placeholder="Add client note" id="client_notes">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-lg-6 col-xl-5 offset-xl-2">
                                            <ul class="list-group cost-list">
                                                <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                                    <span class="cost-title mr-2">Subtotal </span>
                                                    <span class="cost-value">KWD <span id="subtotal">00.00</span></span>
                                                </li>
                                                <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                                    <span class="cost-title mr-2">Discount </span>
                                                    <span class="cost-value">-KWD <span id="total_discount">0.00</span></span>
                                                </li>
                                                <li class="dropdown-divider"></li>
                                                <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                                    <span class="cost-title mr-2">Invoice Total </span>
                                                    <span class="cost-value">KWD <span id="invoice_total">00.00</span></span>
                                                </li>
                                                <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                                    <span class="cost-title mr-2">Total Paid </span>
                                                    <span class="cost-value" >KWD <sapn id="total_paid">00.00</sapn></span>
                                                </li>
                                                <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                                    <span class="cost-title mr-2">Total Due (USD) </span>
                                                    <span class="cost-value">KWD <span id="total_due">0.00</span></span>
                                                </li>
                                            </ul>
                                            <button class="btn btn-primary mt-1 btn-block" onclick="saveInvoice(0)">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-4 col-12">
                        <div class="action-buttons card">
                            <div class="card-body">
                                <button class="btn btn-block btn-primary mb-1" onclick="saveInvoice(1)"><i class="fa fa-share common-size"></i> Send
                                    Invoice</button>
                                <!-- <button class="btn btn-block btn-primary mb-1">Download Invoice</button> -->
                                <!-- <div class="inline-btns w-100 d-flex justify-content-between">
                                    <div class="btn-save w-50 mr-50">
                                        <button class="btn btn-light mb-1 btn-block">Preview</button>
                                    </div>
                                    <div class="btn-preview w-50 ml-50">
                                        <button class="btn btn-light mb-1 btn-block" onclick="saveInvoice()">Save</button>
                                    </div>
                                </div> -->
                                <div class="form-group mb-25">
                                    <div class="float-right">
                                        <input type="checkbox" name="switchery5" id="receivedPayment" class="switchery" onchange="changeReceivePayment()" />
                                    </div>
                                    <label for="switchery5" class="font-medium-2">Payment Received</label>
                                </div>
                                <div class="input-group input-group-sm payment_received_section">
                                    <label for="received_amount" class="font-medium-2" style="display: flex;align-items: center;">Payment &nbsp;</label>
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" aria-label="Checkbox for following text input" id="is_full" onchange="changeIsFull()">&nbsp; In Full
                                        </div>
                                    </div>
                                    <input type="number" class="form-control" name="received_amount" id="received_amount" min="0" aria-label="Text input with checkbox" onblur="setTotalPaid()">
                                </div>
                                <div class="form-group mb-25 payment_received_section
                                " style="margin-top:5px">
                                    <label class="font-medium-2">Payment Type</label>
                                    <div class="float-right">
                                        <select class="form-control form-control-sm" id="payment_type">
                                            <option value="knet">KNET</option>
                                            <option value="credit_card">Credit Card</option>
                                            <option value="cash">CASH</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="payment-options border rounded m-0 py-2 row">
                            <div class="col-12 mt-1">
                                <div class="form-group mb-25">
                                    <div class="float-right">
                                        <input type="checkbox"  name="switchery" id="show_payment_terms" class="switchery" checked />
                                    </div>
                                    <label for="switchery0" class="font-medium-2">Payment Terms</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-25">
                                    <div class="float-right">
                                        <input type="checkbox" name="switchery" id="show_client_notes" class="switchery" checked />
                                    </div>
                                    <label for="switchery0" class="font-medium-2">Client Notes</label>
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
<script type="text/javascript" src="{{asset('app-assets/js/scripts/invoice-init1.js')}}"></script>
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
    function changeDepart(obj) {
        // console.log(obj);
        var doctorId = $(obj).val();
        var doctELe = $(obj).parent().siblings().first().children().next().first();
        var serviceEle = $(obj).parent().siblings().first().next().children().first();
        var priceEle = $(obj).parent().next().next().next().children().first();
        var discountEle = $(obj).parent().next().next().next().next().children().first().find(':nth-child(2)');
        serviceEle.html("<option value=''>--Select Service--</option>");
        console.log("priceEle", priceEle);
        $.post("{{route('doct.get_doctor_by_department')}}", {id: doctorId, _token:"{{csrf_token()}}"}, function(data) {
            var data = JSON.parse(data);
            if (data) {
                // console.log(data);
                var options = "<option value=''>--Select Doctor--</option>";
                data.forEach(ele => {
                    var option = "<option value='" + ele.id + "'>" + ele.name + "</option>";
                    options += option;
                });
                // console.log(options);
                doctELe.html(options);
                priceEle.val(0);
                discountEle.html(0);
                resetDiscount();
                setInvoicePreview();
            }
        })
    }
    function changeDoctor(obj) {
        var doctorId = $(obj).val();
        var departId = $(obj).parent().prev().children().next().first().val();
        var doctELe = $(obj).parent().next().children().first();
        var priceEle = $(obj).parent().next().next().children().first();
        var discountEle = $(obj).parent().next().next().next().children().first().find(':nth-child(2)');
        console.log("discountEle: ", discountEle);
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
                priceEle.val(0);
                discountEle.html(0);
                resetDiscount();
                setInvoicePreview();
            }
            doctELe.html(services);
        });
    }
    function changeService(obj) {
        var serviceId = $(obj).val();
        var docEle = $(obj).parent().next().children().first();
        var discountEle = $(obj).parent().next().next().children().first().find(':nth-child(2)');
        console.log(discountEle);
        // console.log(docEle);
        $.post("{{route('servi.get_service_detail_on_invoice')}}", {id: serviceId, _token:"{{csrf_token()}}"}, function(data) {
            var data = JSON.parse(data);
            if (data) {
                docEle.val(data.price);
                discountEle.html(0);
                resetDiscount();
                setInvoicePreview();
            }
        });
    }
    function resetDiscount() {
        var discounts = $(".discount-value");
        var discountTotal = 0;
        for(var i = 0 ; i < discounts.length; i ++) {
            var ele = $(discounts[i]);
            var discount = Number(ele.html());
            // console.log("ggg", discount);
            var priceEle = ele.parent().parent().prev().children().first();
            // console.log(priceEle);
            var price = priceEle.val();
            // console.log(price);
            var discountPrice = price * (discount/100);
            discountPrice = discountPrice.toFixed(2);
            console.log(discountPrice);
            discountTotal += Number(discountPrice);
        }
        $("#total_discount").html(discountTotal);
    }
    function setInvoicePreview(){
        //calculate sub total
        var prices = $(".service_price");
        var subTotal = 0;
        for(var i = 0 ; i < prices.length; i ++ ){
            var ele = $(prices[i]);
            subTotal += Number(ele.val());
        }
        $("#subtotal").html(subTotal);
        var total_discount = Number($("#total_discount").html());
        var invoice_total = subTotal - total_discount;
        $("#invoice_total").html(invoice_total);
        $("#total_due").html(invoice_total - $("#received_amount").val());
        var isFull = $("#is_full").is(":checked");
        if (isFull) {
            $("#received_amount").val(invoice_total);
            $("#total_paid").html(invoice_total);
        }
    }

    function removePanel(obj) {
        console.log("removed...");
        console.log($(obj));
        var priceEle = $(obj).parent().prev().find(':nth-child(4)').children().first();
        var discountEle = $(obj).parent().prev().find(':nth-child(5)').children().find(':nth-child(2)');
        var deletedPrice = Number(priceEle.val());
        var deletedDiscount = Number(discountEle.html());
        var discountPrice = deletedPrice * (deletedDiscount/100);
        var totalDeleted = deletedPrice - discountPrice;

        var changedSubTotal = Number(Number($("#subtotal").html()) - deletedPrice);
        $("#subtotal").html(changedSubTotal);
        $("#total_discount").html(Number(Number($("#total_discount").html()) - discountPrice));
        $("#invoice_total").html(Number(Number($("#invoice_total").html()) - totalDeleted));
        $("#total_due").html(Number(Number($("#invoice_total").html()) - $("#received_amount").val()));
        console.log("changed sbu total", changedSubTotal);
        console.log(discountPrice, totalDeleted);
    }
    function changeReceivePayment() {
        var isPaid = $("#receivedPayment").is(":checked");
        if (isPaid) {
            $(".payment_received_section").show();
        } else {
            $(".payment_received_section").hide();
        }
    }
    $(document).on('click', '.discount-apply-btn', function (e) {
        discount_value = $(this).parents().eq(2).find('#applicable-discount').val();
        tax_one_val = $(this).parents().eq(2).find('#applicable-tax1').val();
        tax_two_val = $(this).parents().eq(2).find('#applicable-tax2').val();
        valArr = [discount_value, tax_one_val, tax_two_val]

        if (discount_value || tax_one_val || tax_two_val) {
            var elems = $(this)
                .parents()
                .eq(4)
                .prev()
                .find(".discount-value, .tax-1-value, .tax-2-value").toArray();

            for (var i = 0; i < elems.length; i++) {
                elems[i].textContent = valArr[i] ? valArr[i] : '0';
            }

            var discounts = $(".discount-value");
            var discountTotal = 0;
            for(var i = 0 ; i < discounts.length; i ++) {
                var ele = $(discounts[i]);
                var discount = Number(ele.html());
                // console.log("ggg", discount);
                var priceEle = ele.parent().parent().prev().children().first();
                // console.log(priceEle);
                var price = priceEle.val();
                // console.log(price);
                var discountPrice = price * (discount/100);
                discountPrice = discountPrice.toFixed(2);
                console.log(discountPrice);
                discountTotal += Number(discountPrice);
            }
            $("#total_discount").html(discountTotal);
            var invoice_total = Number($("#subtotal").html()) - discountTotal;
            // console.log("aaaaa", invoice_total);
            $("#invoice_total").html(invoice_total);
            $("#total_due").html(invoice_total - $("#received_amount").val());
            var isFull = $("#is_full").is(":checked");
            if (isFull) {
                $("#received_amount").val(invoice_total);
                $("#total_paid").html(invoice_total);
            }
        }
    })

    function changeIsFull(){
        var isFull = $("#is_full").is(":checked");
        // console.log(isFull);
        if (isFull) {
            // console.log(Number($("#total_due").html().toFixed(2));
            var total_due = $("#total_due").html();
            console.log(total_due);
            $("#received_amount").val(total_due);
            $("#total_paid").html(total_due);
            $("#total_due").html(0);
        } else {
            $("#received_amount").val(0);
            $("#total_paid").html(0);
        }
    }

    function saveInvoice(is_sent) {
        console.log($("#patient_id").val())
        if(!$("#patient_id").val()) {
            toastr.error('Please select Civil Id', 'Error!', {"showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000, positionClass: 'toast-top-center', containerId: 'toast-top-center'});
            $("#patient_id").focus();
            return;
        }
        if(!$("#due_date").val()) {
            toastr.error('Please select Due date', 'Error!', {"showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000, positionClass: 'toast-top-center', containerId: 'toast-top-center'});
            // $("#due_date").focus();
            return;
        }
        if(!$("#appointment_date").val()) {
            toastr.error('Please select appointment date', 'Error!', {"showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000, positionClass: 'toast-top-center', containerId: 'toast-top-center'});
            // $("#appointment_date").focus();
            return;
        }

        if (Number($("#subtotal").html())==0){
            toastr.error('Please select at least 1 service.', 'Error!', {"showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000, positionClass: 'toast-top-center', containerId: 'toast-top-center'});
             return;
        }

        if(Number($("#total_due").html()) < 0 ) {
            toastr.error('You are going to pay for no service.', 'Error!', {"showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000, positionClass: 'toast-top-center', containerId: 'toast-top-center'});
             return;
        }
        
        var obj = new Object();
        obj.civil_id = $("#patient_id").val();
        obj.due_date = $("#due_date").val();
        obj.appointment_date = $("#appointment_date").val();
        var service_ids = [];
        var services = $(".service_id");
        for(var i = 0; i < services.length; i ++ ) {
            service_ids.push($(services[i]).val());
        }
        var discount_percents = [];
        var discount_arr = $(".discount-value");
        for ( var i = 0; i < discount_arr.length ; i ++) {
            var ele = $(discount_arr[i]);
            var discount = Number(ele.html());
            discount_percents.push(discount);
        }
        // services.forEach(ele => {
            
        // })
        // forEach
        console.log(service_ids);
        obj.service_ids = service_ids.toString();
        obj.sub_total = Number($("#subtotal").html());
        obj.total_discount = Number($("#total_discount").html());
        obj.invoice_total = Number($("#invoice_total").html());
        obj.total_paid = Number($("#total_paid").html());
        obj.total_due = Number($("#total_due").html());
        obj.payment_terms = $("#payment_terms").val();
        obj.client_notes = $("#client_notes").val();
        obj.received_payment = $("#receivedPayment").is(":checked") == true ? 1 : 0;
        obj.payment_type = $("#payment_type").val();
        obj.show_client_notes = $("#show_client_notes").is(":checked") == true ? 1 : 0;
        obj.show_payment_terms = $("#show_payment_terms").is(":checked") == true ? 1 : 0;
        obj.is_sent = is_sent;
        obj.discount_percents = discount_percents.toString();
        obj.invoice_id = `CMC-ON-${Number(new Date())}${generateInvoice(3)}`;
        console.log(obj);
        $.post("{{route('invoi.add_invoice')}}", {data: obj, _token:"{{csrf_token()}}"}, function(data) {
            console.log(data);
            var obj = JSON.parse(data);
            console.log(obj);
            if(obj.status =='success') {
                toastr.options.onHidden = function() {
                    window.location.href = "{{route('invoice.index')}}";
                }
                toastr.success('Invoice successfully added.', 'Success', {"showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 1000, positionClass: 'toast-top-center', containerId: 'toast-top-center'});
            }
            // 
        });
        // console.log($(".service").val())
    }

    function setTotalPaid() {
        $("#total_paid").html($("#received_amount").val());
        var total_due = Number($("#invoice_total").html()) - $("#received_amount").val();
        $("#total_due").html(total_due);
    }

    function generateInvoice(count) {
        let randomText = "";
        let possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        for (var i = 0; i < count; i++)
          randomText += possible.charAt(Math.floor(Math.random() * possible.length));
        return randomText;
    }

    $(function() {
        // $(".select2").select2();
        $(".payment_received_section").hide();
        var today = new Date();
        var year = today.getFullYear();
        var month = today.getMonth() + 1;
        if (month < 10) {
            month = '0' + month;
        }
        var date = today.getDate();
        var formattedDate = month + '/' + date + '/' + year;
        // console.log(formattedDate);
        $("#date_issue").val(formattedDate);
    })
</script>
@endsection
