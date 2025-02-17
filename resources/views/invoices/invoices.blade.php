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
                الفواتير</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')


<!-- row -->
<div class="row row-sm">

    <!--div-->
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <a href="{{route('invoices.create')}}"><button class="btn btn-primary">إضافة فاتورة</button></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped key-buttons text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
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
                                <th>الحالة</th>
                                <th>الملاحظات</th>
                                <th>المستخدم</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter = 1; ?>
                            @foreach($invoices as $invoice)
                            <tr style="text-wrap: auto !important; ">
                                <td><?php echo $counter++; ?></td>
                                <td>{{$invoice->invoice_number}}</td>
                                <td>{{$invoice->invoice_date}}</td>
                                <td>{{$invoice->due_date}}</td>
                                <td style="">
                                    <a href="{{ url('invoices_details', $invoice->id) }}"
                                        style="color: #22252f; font-weight: bolder;">{{$invoice->sections->section_name}}
                                    </a>
                                </td>
                                <td>{{$invoice->product}}</td>
                                <td>{{$invoice->Amount_collection}}</td>
                                <td>{{$invoice->Amount_commission}}</td>
                                <td>{{$invoice->discount}}</td>
                                <td>{{$invoice->rate_vat}}</td>
                                <td>{{$invoice->value_vat}}</td>
                                <td>{{$invoice->Total}}</td>
                                <td>
                                    @if($invoice->value_status == 1)
                                    <span class="badge badge-pill badge-success ">{{$invoice->Status}}</span>
                                    @elseif($invoice->value_status == 2)
                                    <span class="badge badge-pill badge-danger">{{$invoice->Status}}</span>
                                    @else
                                    <span class="badge badge-pill badge-warning">{{$invoice->Status}}</span>
                                    @endif
                                </td>
                                <td>{{ $invoice->note }}</td>
                                <td>{{ $invoice->user }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button aria-expanded="true" aria-haspopup="true" class="btn ripple btn-primary btn-sm" data-toggle="dropdown"  type="button">العمليات <i class="fas fa-caret-down ml-1"></i></button>
                                        <div class="dropdown-menu tx-13 " >
                                            <a class="dropdown-item" href="{{url('edit_invoice')}}/{{ $invoice->id }}">تعديل الفاتورة</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/div-->

</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
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
