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
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body text-left w-100">
                                            <h3 class="primary">78%</h3>
                                            <span>Total Amount</span>
                                        </div>
                                        <div class="media-right media-middle">
                                            <i class="fa fa-bar-chart primary font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body text-left w-100">
                                            <h3 class="danger">423</h3>
                                            <span>Total Paid</span>
                                        </div>
                                        <div class="media-right media-middle">
                                            <i class="fa fa-money danger font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 40%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body text-left w-100">
                                            <h3 class="success">64.89 %</h3>
                                            <span>Total Invoices</span>
                                        </div>
                                        <div class="media-right media-middle">
                                            <i class="fa fa-envelope-square success font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 60%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body text-left w-100">
                                            <h3 class="warning">02.12</h3>
                                            <span>Completed Invoices</span>
                                        </div>
                                        <div class="media-right media-middle">
                                            <i class="fa fa-check warning font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 35%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row match-height">
                    <div class="col-xl-8 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Recent Orders</h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p>Total paid invoices 240, unpaid 150. <span class="float-right"><a href="project-summary.html" target="_blank">Invoice Summary <i class="feather icon-arrow-right"></i></a></span></p>
                                </div>
                                <div class="table-responsive">
                                    <table id="recent-orders" class="table table-hover mb-0 ps-container ps-theme-default">
                                        <thead>
                                            <tr>
                                                <th>SKU</th>
                                                <th>Invoice#</th>
                                                <th>Customer Name</th>
                                                <th>Status</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-truncate">PO-10521</td>
                                                <td class="text-truncate"><a href="#">INV-001001</a></td>
                                                <td class="text-truncate">Elizabeth W.</td>
                                                <td class="text-truncate"><span class="badge badge-success">Paid</span></td>
                                                <td class="text-truncate">$ 1200.00</td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate">PO-532521</td>
                                                <td class="text-truncate"><a href="#">INV-01112</a></td>
                                                <td class="text-truncate">Doris R.</td>
                                                <td class="text-truncate"><span class="badge badge-warning">Overdue</span></td>
                                                <td class="text-truncate">$ 5685.00</td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate">PO-05521</td>
                                                <td class="text-truncate"><a href="#">INV-001012</a></td>
                                                <td class="text-truncate">Andrew D.</td>
                                                <td class="text-truncate"><span class="badge badge-success">Paid</span></td>
                                                <td class="text-truncate">$ 152.00</td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate">PO-15521</td>
                                                <td class="text-truncate"><a href="#">INV-001401</a></td>
                                                <td class="text-truncate">Megan S.</td>
                                                <td class="text-truncate"><span class="badge badge-success">Paid</span></td>
                                                <td class="text-truncate">$ 1450.00</td>
                                            </tr>
                                            <tr>
                                                <td class="text-truncate">PO-32521</td>
                                                <td class="text-truncate"><a href="#">INV-008101</a></td>
                                                <td class="text-truncate">Walter R.</td>
                                                <td class="text-truncate"><span class="badge badge-warning">Overdue</span></td>
                                                <td class="text-truncate">$ 685.00</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body sales-growth-chart">
                                    <div id="monthly-sales" class="height-250"></div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="chart-title mb-1 text-center">
                                    <h6>Total monthly Sales.</h6>
                                </div>
                                <div class="chart-stats text-center">
                                    <a href="#" class="btn btn-sm btn-primary mr-1">Statistics <i class="feather icon-bar-chart"></i></a> <span class="text-muted">for the last year.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
    <script type="text/javascript">
        $(window).on("load", function(){
            Morris.Bar({
                element: 'monthly-sales',
                data: [{month: 'Jan', sales: 1835 }, {month: 'Feb', sales: 2356 }, {month: 'Mar', sales: 1459 }, {month: 'Apr', sales: 1289 }, {month: 'May', sales: 1647 }, {month: 'Jun', sales: 2156 }, {month: 'Jul', sales: 1835 }, {month: 'Aug', sales: 2356 }, {month: 'Sep', sales: 1459 }, {month: 'Oct', sales: 1289 }, {month: 'Nov', sales: 1647 }, {month: 'Dec', sales: 2156 }],
                xkey: 'month',
                ykeys: ['sales'],
                labels: ['Sales'],
                barGap: 4,
                barSizeRatio: 0.3,
                gridTextColor: '#bfbfbf',
                gridLineColor: '#E4E7ED',
                numLines: 5,
                gridtextSize: 14,
                resize: true,
                barColors: ['#00B5B8'],
                hideHover: 'auto',
            });  
        });
    </script>
        
@endsection