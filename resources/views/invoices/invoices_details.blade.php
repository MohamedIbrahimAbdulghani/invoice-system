@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
@endsection

@section('title')
الفواتير
@stop
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">قائمة الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                تفاصيل الفاتورة</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')

<div class="col-xl-12">
    <!-- div -->
    <div class="card" id="tabs-style4">
        <div class="text-wrap">
            <div class="example">
                <div class="d-md-flex">
                    <div class="">
                        <div class="panel panel-primary tabs-style-4">
                            <div class="tab-menu-heading">
                                <div class="tabs-menu ">
                                    <!-- Tabs -->
                                    <ul class="nav panel-tabs ml-3">
                                        <li class=""><a href="#tab1" class="active" data-toggle="tab"><i
                                                    class="fa fa-laptop"></i> تفاصيل الفاتورة</a></li>
                                        <li><a href="#tab2" data-toggle="tab"><i class="fa fa-cube"></i> حالات
                                                الدفع</a></li>
                                        <li><a href="#tab3" data-toggle="tab"><i class="fa fa-cogs"></i>
                                                المرفقات</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tabs-style-4 ">
                        <div class="panel-body tabs-menu-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>رقم الفاتورة</th>
                                                <th>تاريخ الفاتورة</th>
                                                <th>تاريخ الاستحقاق</th>
                                                <th>القسم</th>
                                                <th>المنتج</th>
                                                <th>مبلغ التحصيل</th>
                                                <th>مبلغ العمولة</th>
                                                <th>الخصم</th>
                                                <th>نسبة الضريبة</th>
                                                <th>قيمة الضريبة</th>
                                                <th>الاجمالي</th>
                                                <th> الحالة الحالية</th>
                                                <th>الملاحظات</th>
                                                <th>المستخدم</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$invoices->invoice_number}}</td>
                                                <td>{{$invoices->invoice_date}}</td>
                                                <td>{{$invoices->due_date}}</td>
                                                <td>{{$invoices->sections->section_name }}</td>
                                                <td>{{$invoices->product}}</td>
                                                <td>{{$invoices->Amount_collection}}</td>
                                                <td>{{$invoices->Amount_commission}}</td>
                                                <td>{{$invoices->discount}}</td>
                                                <td>{{$invoices->rate_vat}}</td>
                                                <td>{{$invoices->value_vat}}</td>
                                                <td>{{$invoices->Total}}</td>
                                                <td>
                                                    @if($invoices->value_status == 1)
                                                    <span
                                                        class="badge badge-pill badge-success ">{{$invoices->Status}}</span>
                                                    @elseif($invoices->value_status == 2)
                                                    <span
                                                        class="badge badge-pill badge-danger ">{{$invoices->Status}}</span>
                                                    @else
                                                    <span
                                                        class="badge badge-pill badge-warning ">{{$invoices->Status}}</span>
                                                    @endif
                                                </td>
                                                <td>{{$invoices->note}}</td>
                                                <td>{{$invoices->user}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                                @foreach($invoices_details as $invoices_details )
                                <div class="tab-pane" id="tab2">
                                    <table class="table table-striped">
                                        <thead>
                                            <?php $counter = 1; ?>
                                            <tr>
                                                <th>#</th>
                                                <th>رقم الفاتورة</th>
                                                <th>نوع المنتج</th>
                                                <th>القسم</th>
                                                <th>حالة الدفع</th>
                                                <th>تاريخ الدفع</th>
                                                <th>ملاحظات</th>
                                                <th>تاريخ الاضافة</th>
                                                <th>المستخدم</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $counter; ?></td>
                                                <td>{{$invoices_details->invoice_number}}</td>
                                                <td>{{$invoices_details->product}}</td>
                                                <td>{{$invoices->sections->section_name}}</td>
                                                <td>
                                                    @if($invoices->value_status == 1)
                                                    <span
                                                        class="badge badge-pill badge-success ">{{$invoices->Status}}</span>
                                                    @elseif($invoices->value_status == 2)
                                                    <span
                                                        class="badge badge-pill badge-danger ">{{$invoices->Status}}</span>
                                                    @else
                                                    <span
                                                        class="badge badge-pill badge-warning ">{{$invoices->Status}}</span>
                                                    @endif
                                                </td>
                                                <td>{{$invoices_details->Payment_Date}}</td>
                                                <td>{{$invoices_details->note}}</td>
                                                <td>{{$invoices_details->created_at}}</td>
                                                <td>{{$invoices_details->user}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                @endforeach

                                @foreach($invoices_attachment as $invoices_attachment)
                                <div class="tab-pane" id="tab3">
                                    <table class="table table-striped">
                                        <thead>
                                            <?php $counter = 1; ?>
                                            <tr>
                                                <th>#</th>
                                                <th>رقم الملف</th>
                                                <th>قم بالاضافة</th>
                                                <th>تاريخ الاضافة</th>
                                                <th>العمليات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php  echo $counter++; ?></td>
                                                <td>{{ $invoices_attachment->file_name }}</td>
                                                <td>{{ $invoices_attachment->created_by }}</td>
                                                <td>{{ $invoices_attachment->created_at }}</td>
                                                <td>
                                                    <a href="{{url('view_file')}}/{{$invoices->invoice_number}}/{{$invoices_attachment->file_name}}" role="button" class="btn btn-outline-success btn-sm"><i
                                                            class="fas fa-eye ml-2"></i>عرض</a>

                                                    <a href="" class="btn btn-outline-info btn-sm" role="button"><i
                                                            class="fas fa-download ml-2"></i>تحميل</a>

                                                    <a href="" class="btn btn-outline-info btn-sm" role="button"><i
                                                            class="fas fa-download ml-2"></i>حذف</a>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!---Prism Pre code-->
    </div>
</div>
<!-- /div -->

@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
@endsection