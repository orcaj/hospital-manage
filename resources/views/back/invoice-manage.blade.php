@extends('layouts.app')
@section('content')


<!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <!-- invoice add wrapper -->
                <div class="invoice-add-wrapper">
                    <!-- defining a Bootstrap row -->
                    <div class="row">
                        <!-- defining Bootstrap columns for diffrent screen sizes -->
                        <div class="col-xl-12 col-md-8 col-12">
                            <!-- Bootstrap card component -->
                            <div class="card">
                                <div class="card-body">

                                    <!-- bill address section -->
                                    <div class="invoice-product-details">
                                        @isset($invoice)
                                        <form class="repeater-form" method="post" action="{{route('invoice.update', $invoice->id)}}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" id="civil_value" value="{{$invoice->civil_id}}">
                                            <input type="hidden" id="service_value" value="{{$invoice->service_id}}">
                                        @endisset

                                        @empty($invoice)
                                        <form class="repeater-form" method="post" action="{{route('invoice.store')}}">
                                            @csrf
                                        @endempty
                                            <div data-repeater-list="group-a">
                                                <div data-repeater-item class="mb-1">
                                                    <div class="row item-heading-titles mb-50">
                                                        <div class="col-2 col-md-2 item-subtitle font-bold">Civil ID</div>
                                                        <div class="col-2 col-md-2 cost-subtitle font-bold">Patient Name</div>
                                                        <div class="col-2 col-md-2 qty-subtitle font-bold">Email</div>
                                                        <div class="col-2 col-md-2 price-subtitle font-bold">Phone</div>
                                                        <div class="col-4 col-md-4 price-subtitle font-bold">Address</div>
                                                    </div>
                                                    
                                                    <div class="repeater-controls">
                                                        <div class="input-fields border border-light rounded p-1">
                                                            <div class="row invoice-item-controls d-flex">
                                                                <div class="col-12 col-md-2 form-group item-name">
                                                                    <select class="select2 form-control" name="civil_id" id="civil_id">
                                                                        @foreach($patients as $patient)
                                                                        <option value="{{$patient->civil_id}}">{{$patient->civil_id}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-12 col-md-2 form-group item-cost" id="pat_name">
                                                                </div>
                                                                <div class="col-12 col-md-2 form-group item-quantity" id="pat_email">
                                                                </div>
                                                                <div class="col-12 col-md-2 form-group item-price" id="pat_phone">
                                                                   </div>
                                                                <div class="col-12 col-md-4 form-group item-description mb-0" id="pat_address">
                                                                </div>
                                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                    <hr>

                                            <div data-repeater-list="group-a">
                                                <div data-repeater-item class="mb-1">
                                                    <div class="row item-heading-titles mb-50">
                                                        <div class="col-2 col-md-2 item-subtitle font-bold">Service</div>
                                                        <div class="col-2 col-md-2 cost-subtitle font-bold">Department</div>
                                                        <div class="col-2 col-md-2 qty-subtitle font-bold">Doctor</div>
                                                        <div class="col-2 col-md-2 price-subtitle font-bold">Price</div>
                                                        <div class="col-4 col-md-4 price-subtitle font-bold">Status</div>
                                                    </div>
                                                    <div class="repeater-controls">
                                                        <div class="input-fields border border-light rounded p-1">
                                                            <div class="row invoice-item-controls d-flex">
                                                                <div class="col-12 col-md-2 form-group item-name">
                                                                    <select class="select2 form-control" name="service_id" id="service_id">
                                                                        @foreach($services as $service)
                                                                        <option value="{{$service->id}}">{{$service->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                
                                                                <div class="col-12 col-md-2 form-group item-quantity" id="service_depart">
                                                                </div>
                                                                <div class="col-12 col-md-2 form-group item-price" id="service_doctor">
                                                                   </div>
                                                                <div class="col-12 col-md-4 form-group item-description mb-0" id="service_price">
                                                                </div>

                                                                <div class="col-12 col-md-4 form-group item-description mb-0" id="service_status">
                                                                </div>
                                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            
                                            <div class="form-group">
                                                <button data-repeater-create class="btn btn-primary mt-1" type="submit">
                                                    <i class="fa fa-plus"></i> Add Button
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <hr>

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- END: Content-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
@isset($invoice)
<script type="text/javascript">
$(function(){
    civil_id=$("#civil_value").val();
    service_id=$("#service_value").val();
    $("#civil_id").val(civil_id);
    $("#civil_id").select2();
    $("#service_id").val(service_id);
    $("#service_id").select2();
    console.log("fff",civil_id, "sdf",service_id );
})
</script>
@endisset
<script type="text/javascript">
    function get_patdata(civil_id){
        $.ajax({
            url:"{{route('get_patdata')}}",
            data:{
                _token:"{{csrf_token()}}",
                civil_id:civil_id
            },
            dataType:"json",
            method:"POST",
            success: function (patient){
                console.log("patient", patient);
                $("#pat_name").html(patient.name);
                $("#pat_email").html(patient.email);
                $("#pat_phone").html(patient.phone);
                $("#pat_address").html(patient.address);

            },
            error: function (e){
                console.log(e);
            }
        })
    }

    function get_service_data(service_id){
        $.ajax({
            url:"{{route('get_service_data')}}",
            data:{
                _token:"{{csrf_token()}}",
                service_id : service_id
            },
            dataType:"json",
            method:"POST",
            success: function (service){
                console.log("service", service);
                $("#service_name").html(service.name);
                $("#service_depart").html(service.depart);
                $("#service_doctor").html(service.doctor);
                $("#service_price").html(service.price);
                $("#service_status").html(service.status);

            },
            error: function (e){
                console.log(e);
            }
        })
    }

    function patient_data(){
        civil_id=$("#civil_id").val();
        get_patdata(civil_id);
        $("#civil_id").change(function(){
            civil_id=$(this).val();
            get_patdata(civil_id);
        });
    }

    function service_date(){
        service_id=$("#service_id").val();
        get_service_data(service_id);
        $("#service_id").change(function(){
            service_id=$(this).val();
            get_service_data(service_id);
        })
    }

    $(function(){
        patient_data();
        service_date();
    })
</script>



@endsection