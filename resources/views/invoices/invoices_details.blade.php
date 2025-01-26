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

@if (session()->has('Add'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('Add') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session()->has('Delete'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('Delete') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

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
                    <div class="tabs-style-4 table-responsive">
                        <div class="panel-body tabs-menu-body">
                            <div class="tab-content ">
                                <div class="tab-pane active " id="tab1">

                                    <table class="table table-striped table-responsive">
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


                                <div class="tab-pane" id="tab2">
                                    @foreach($invoices_details as $invoices_details )
                                    <table class="table table-striped  table-responsive">
                                        <thead>
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
                                            <?php $counter = 1; ?>
                                            <tr>
                                                <td><?php echo $counter++; ?></td>
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
                                    @endforeach
                                </div>
                                <div class="tab-pane" id="tab3">
                                </form>
                                    <table class="table table-striped  table-responsive">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>رقم الملف</th>
                                                <th>قم بالاضافة</th>
                                                <th>تاريخ الاضافة</th>
                                                <th>العمليات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $counter = 1; ?>
                                            @foreach($invoices_attachment as $invoices_attachment)
                                            <tr>
                                                <td><?php  echo $counter++; ?></td>
                                                <td>{{ $invoices_attachment->file_name }}</td>
                                                <td>{{ $invoices_attachment->created_by }}</td>
                                                <td>{{ $invoices_attachment->created_at }}</td>
                                                <td>
                                                    <a href="{{url('view_file')}}/{{$invoices->invoice_number}}/{{$invoices_attachment->file_name}}" role="button" class="btn btn-outline-success btn-sm mb-1"><i
                                                            class="fas fa-eye ml-2"></i>عرض</a>

                                                    <a href="{{url('download_file')}}/{{$invoices->invoice_number}}/{{$invoices_attachment->file_name}}" class="btn btn-outline-info btn-sm mb-1" role="button"><i
                                                            class="fas fa-download ml-2"></i>تحميل</a>

                                                    <button class="btn btn-outline-danger btn-sm mb-1" data-toggle="modal" data-file_name="{{$invoices_attachment->file_name}}" data-invoice_number="{{$invoices_attachment->invoice_number}}" data-id="{{$invoices_attachment->id}}" data-target="#delete_file" role="button">حذف</button>

                                                </td>
                                            </tr>

                                    @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <!-- delete -->
    <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

                <form action="{{url('delete_file')}}" method="post">
                {{ csrf_field() }}
                <div class="modal-body">
                    <p class="text-center">
                    <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                    </p>

                    <input type="hidden" name="id" id="id" value="">
                    <input type="hidden" name="file_name" id="file_name" value="">
                    <input type="hidden" name="invoice_number" id="invoice_number" value="">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-danger">تاكيد</button>
                </div>
            </form>
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
{{-- this script to make modal use it in delete invoice --}}
<script>
    $('#delete_file').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data("id")
        var file_name = button.data("file_name")
        var invoice_number = button.data("invoice_number")
        var modal = $(this)

        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #file_name').val(file_name);
        modal.find('.modal-body #invoice_number').val(invoice_number);
    })
</script>
@endsection
