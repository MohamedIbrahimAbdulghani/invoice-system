@extends('layouts.master')
@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('title')
الصفحة الرئيسية
@stop
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <div>
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">مرحبا بك !</h2>
        </div>
    </div>
    <div class="main-dashboard-header-right">
        <div>
            <label class="tx-13">Customer Ratings</label>
            <div class="main-star">
                <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i
                    class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i
                    class="typcn typcn-star"></i> <span>(14,873)</span>
            </div>
        </div>
        <div>
            <label class="tx-13">Online Sales</label>
            <h5>563,275</h5>
        </div>
        <div>
            <label class="tx-13">Offline Sales</label>
            <h5>783,675</h5>
        </div>
    </div>
</div>
<!-- /breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row row-sm">
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="overflow-hidden card sales-card bg-primary-gradient">
            <div class="pt-0 pt-3 pb-2 pl-3 pr-3">
                <div class="">
                    <h6 class="mb-3 text-white tx-12">اجمالي الفواتير</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="mb-1 text-white tx-20 font-weight-bold">
                                {{-- {{ $invoice_count }} --}}
                                {{ number_format(App\Models\invoices::sum('total'), 2) }} <!-- To Get Total Sum For Invoices -->
                            </h4>
                            <p class="mb-0 text-white tx-12 op-7">عدد الفواتير : {{ App\Models\invoices::count() }}</p> <!--  To Get Count Invoices -->
                        </div>
                        <span class="float-right my-auto mr-auto">
                            <i class="text-white fas fa-arrow-circle-up"></i>
                            <span class="text-white op-7">100%</span>
                        </span>
                    </div>
                </div>
            </div>
            <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="overflow-hidden card sales-card bg-danger-gradient">
            <div class="pt-0 pt-3 pb-2 pl-3 pr-3">
                <div class="">
                    <h6 class="mb-3 text-white tx-12">الفواتير الغير مدفوعة</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="mb-1 text-white tx-20 font-weight-bold">
                                {{ number_format(App\Models\invoices::where('value_status','2')->sum('total'), 2) }} <!-- To Get Total Sum For Invoices -->
                            </h4>
                            <p class="mb-0 text-white tx-12 op-7">
                                عدد الفواتير الغير مدفوعة : {{ App\Models\invoices::where('value_status','2')->count() }}
                            </p>
                        </div>

                        <span class="float-right my-auto mr-auto">
                            @if( App\Models\invoices::count() > 0 )
                                @php
                                    $percentage = round((App\Models\invoices::where('value_status','2')->count() / App\Models\invoices::count()) * 100, 2);
                                @endphp
                                @if($percentage > 50)
                                    <i class="text-white fas fa-arrow-circle-up"></i>
                                @elseif($percentage < 50)
                                    <i class="text-white fas fa-arrow-circle-down"></i>
                                @endif

                            <span class="text-white op-7">
                                <!-- Implement percentage calculation for invoices in dashboard -->
                                {{ round((App\Models\invoices::where('value_status','2')->count() / App\Models\invoices::count()) * 100, 2) }}%</span>

                            @endif
                        </span>
                    </div>
                </div>
            </div>
            <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="overflow-hidden card sales-card bg-success-gradient">
            <div class="pt-0 pt-3 pb-2 pl-3 pr-3">
                <div class="">
                    <h6 class="mb-3 text-white tx-12">الفواتير المدفوعة</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="mb-1 text-white tx-20 font-weight-bold">
                                {{ number_format(App\Models\invoices::where('value_status','1')->sum('total'), 2) }} <!-- To Get Total Sum For Invoices -->
                            </h4>
                            <p class="mb-0 text-white tx-12 op-7">
                                عدد الفواتير مدفوعة : {{ App\Models\invoices::where('value_status','1')->count() }}
                            </p>
                        </div>
                        <span class="float-right my-auto mr-auto">

                            @if( App\Models\invoices::count() > 0 )
                            @php
                                $percentage = round((App\Models\invoices::where('value_status','1')->count() / App\Models\invoices::count()) * 100, 2);
                            @endphp
                            @if($percentage > 50)
                                <i class="text-white fas fa-arrow-circle-up"></i>
                            @elseif($percentage < 50)
                                <i class="text-white fas fa-arrow-circle-down"></i>
                            @endif

                            <span class="text-white op-7">
                                <!-- Implement percentage calculation for invoices in dashboard -->
                                {{ round( (App\Models\invoices::where('value_status', '1')->count() / App\Models\invoices::count() * 100),2 )}}%
                            </span>
                            @endif


                        </span>
                    </div>
                </div>
            </div>
            <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="overflow-hidden card sales-card bg-warning-gradient">
            <div class="pt-0 pt-3 pb-2 pl-3 pr-3">
                <div class="">
                    <h6 class="mb-3 text-white tx-12">الفواتير المدفوعة جزئيا</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="mb-1 text-white tx-20 font-weight-bold">
                                {{ number_format(App\Models\invoices::where('value_status','3')->sum('total'), 2) }} <!-- To Get Total Sum For Invoices -->
                            </h4>
                            <p class="mb-0 text-white tx-12 op-7">
                                عدد الفواتير المدفوعة جزئيا : {{ App\Models\invoices::where('value_status','3')->count() }}
                            </p>
                        </div>
                        <span class="float-right my-auto mr-auto">

                            @if( App\Models\invoices::count() > 0 )
                            @php
                                $percentage = round((App\Models\invoices::where('value_status','3')->count() / App\Models\invoices::count()) * 100, 2);
                            @endphp

                            @if($percentage > 50)
                                <i class="text-white fas fa-arrow-circle-up"></i>
                            @elseif($percentage < 50)
                                <i class="text-white fas fa-arrow-circle-down"></i>
                            @endif

                            <span class="text-white op-7">
                                <!-- Implement percentage calculation for invoices in dashboard -->
                                {{ round((App\Models\invoices::where('value_status','3')->count() / App\Models\invoices::count() * 100), 2) }}%
                            </span>
                            @endif

                        </span>
                    </div>
                </div>
            </div>
            <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
        </div>
    </div>
</div>
<!-- row closed -->

<!-- row opened -->
<div class="row row-sm">
    <div class="col-md-12 col-lg-12 col-xl-7">
        <div class="card">
            <div class="bg-transparent card-header pd-b-0 pd-t-20 bd-b-0">
                <div class="d-flex justify-content-between">
                    <h4 class="mb-0 card-title">Order status</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <p class="mb-0 tx-12 text-muted">Order Status and Tracking. Track your order from ship date to arrival.
                    To begin, enter your order number.</p>
            </div>
            <div class="card-body" style="width: 75%">
                {!! $chartjs->render() !!}
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-xl-5">
        <div class="card card-dashboard-map-one">
            <label class="main-content-label">Sales Revenue by Customers in USA</label>
            <span class="d-block mg-b-20 text-muted tx-12">Sales Performance of all states in the United States</span>
            <div class="">
                {{-- <div class="vmap-wrapper ht-180" id="vmap2"></div> --}}
                {!! $chartjs_2->render() !!}
            </div>
        </div>
    </div>
</div>
<!-- row closed -->




</div>
</div>
<!-- Container closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
<!-- Internal Map -->
<script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{URL::asset('assets/js/index.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>

@endsection
