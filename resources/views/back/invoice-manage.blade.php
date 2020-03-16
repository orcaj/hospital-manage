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

                                    <!-- card header -->
                                 <!--    <div class="card-header">
                                        <div class="row">
                                            <div class="col-xl-3 col-md-12 d-flex justify-content-start align-items-center pl-0">
                                                <h6 class="invoice-text mr-1 font-weight-bold">Invoice# </h6>
                                                <input type="text" name="invoice" class="form-control w-50" value="#000">
                                            </div>
                                            <div class="col-xl-9 col-md-12 d-flex justify-content-xl-end align-items-lg-start align-items-sm-start align-items-xs-start  align-items-center flex-wrap px-0 pt-xl-0 pt-1">
                                                <div class="issue-date d-flex align-items-center justify-content-start mr-2 mb-75 mb-xl-0">
                                                    <h6 class="invoice-text mr-1 font-weight-bold">Date Issue</h6>
                                                    <input type="text" name="date" class="pick-a-date bg-white form-control" value="Select Date">
                                                </div>
                                                <div class="due-date d-flex align-items-center justify-content-start">
                                                    <h6 class="invoice-text mr-1 font-weight-bold">Date Due</h6>
                                                    <input type="text" name="date" class="pick-a-date bg-white form-control" value="Select Date">
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                   

                                    <!-- bill address section -->
                                    <div class="invoice-product-details">
                                        <form class="repeater-form">
                                            <div data-repeater-list="group-a">
                                                <div data-repeater-item class="mb-1">
                                                    <div class="row item-heading-titles mb-50">
                                                        <div class="col-3 col-md-4 item-subtitle font-bold">Item</div>
                                                        <div class="col-3 cost-subtitle font-bold">Cost</div>
                                                        <div class="col-3 qty-subtitle font-bold">Qty</div>
                                                        <div class="col-3 col-md-2 price-subtitle font-bold">Price</div>
                                                    </div>
                                                    
                                                    <div class="repeater-controls d-flex">
                                                        <div class="input-fields border border-light rounded p-1 d-flex">
                                                            <div class="row invoice-item-controls d-flex">
                                                                <div class="col-12 col-md-4 form-group item-name">
                                                                    <select class="form-control" id="item-options">
                                                                        <option value="stack">Stack Admin template</option>
                                                                        <option value="modern">Modern Admin template</option>
                                                                        <option value="apex">Apex Admin template</option>
                                                                        <option value="robust">Robust Admin template</option>
                                                                        <option value="frest">Frest Admin template</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-12 col-md-3 form-group item-cost">
                                                                    <input type="text" class="form-control" value="24">
                                                                </div>
                                                                <div class="col-12 col-md-3 form-group item-quantity">
                                                                    <input type="text" class="form-control" value="1">
                                                                </div>
                                                                <div class="col-12 col-md-2 form-group item-price">
                                                                    $24.00</div>
                                                                <div class="col-12 col-md-4 form-group item-description mb-0">
                                                                    <input type="text" class="form-control description-input" value="The most developer friendly & highly customisable HTML5 Admin">
                                                                </div>
                                                                <div class="col-12 col-md-8 form-group discounts mb-0">
                                                                    <div class='discount-element'>
                                                                        <span class="title-text">Discount:</span>
                                                                        <span class="discount-value">0%</span>
                                                                        <span class="tax-1-value mx-1">0%</span>
                                                                        <span class="tax-2-value mx-1">0%</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <hr>

                                    <!-- invoice product details -->
                                    <div class="invoice-product-details">
                                        <form class="repeater-form">
                                            <div data-repeater-list="group-a">
                                                <div data-repeater-item class="mb-1">
                                                    <div class="row item-heading-titles mb-50">
                                                        <div class="col-3 col-md-4 item-subtitle font-bold">Item</div>
                                                        <div class="col-3 cost-subtitle font-bold">Cost</div>
                                                        <div class="col-3 qty-subtitle font-bold">Qty</div>
                                                        <div class="col-3 col-md-2 price-subtitle font-bold">Price</div>
                                                    </div>
                                                    <div class="repeater-controls d-flex">
                                                        <div class="input-fields border border-light rounded p-1 d-flex">
                                                            <div class="row invoice-item-controls d-flex">
                                                                <div class="col-12 col-md-4 form-group item-name">
                                                                    <select class="form-control" id="item-options">
                                                                        <option value="stack">Stack Admin template</option>
                                                                        <option value="modern">Modern Admin template</option>
                                                                        <option value="apex">Apex Admin template</option>
                                                                        <option value="robust">Robust Admin template</option>
                                                                        <option value="frest">Frest Admin template</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-12 col-md-3 form-group item-cost">
                                                                    <input type="text" class="form-control" value="24">
                                                                </div>
                                                                <div class="col-12 col-md-3 form-group item-quantity">
                                                                    <input type="text" class="form-control" value="1">
                                                                </div>
                                                                <div class="col-12 col-md-2 form-group item-price">
                                                                    $24.00</div>
                                                                <div class="col-12 col-md-4 form-group item-description mb-0">
                                                                    <input type="text" class="form-control description-input" value="The most developer friendly & highly customisable HTML5 Admin">
                                                                </div>
                                                                <div class="col-12 col-md-8 form-group discounts mb-0">
                                                                    <div class='discount-element'>
                                                                        <span class="title-text">Discount:</span>
                                                                        <span class="discount-value">0%</span>
                                                                        <span class="tax-1-value mx-1">0%</span>
                                                                        <span class="tax-2-value mx-1">0%</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button data-repeater-create class="btn btn-primary mt-1" type="button">
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

@endsection