@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet" />
@endsection

@section('title')
الفواتير المدفوعة جزئيا
@stop
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">قائمة الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                الفواتير المدفوعة جزئيا</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')

<!-- this code to show message when delete invoice -->
@if(session()->has('delete_invoice'))
<script>
window.onload = function() {
    notif({
        msg: "تم حذف الفاتورة بنجاح",
        type: "success"
    })
}
</script>
@endif
<!-- this code to show message when delete invoice -->

<!-- this code to show message when update invoice -->
@if(session()->has('update_invoice'))
<script>
window.onload = function() {
    notif({
        msg: "تم تحديث الفاتورة بنجاح",
        type: "success"
    })
}
</script>
@endif
<!-- this code to show message when update invoice -->

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
                                <td>{{$invoice->total}}</td>
                                <td>
                                    @if($invoice->value_status == 1)
                                    <span class="badge badge-pill badge-success ">{{$invoice->status}}</span>
                                    @elseif($invoice->value_status == 2)
                                    <span class="badge badge-pill badge-danger">{{$invoice->status}}</span>
                                    @else
                                    <span class="badge badge-pill badge-warning">{{$invoice->status}}</span>
                                    @endif
                                </td>
                                <td>{{ $invoice->note }}</td>
                                <td>{{ $invoice->user }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button aria-expanded="true" aria-haspopup="true"
                                            class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                            type="button">العمليات <i class="fas fa-caret-down ml-1"></i></button>
                                        <div class="dropdown-menu tx-13 ">
                                            <a class="dropdown-item"
                                                href="{{url('edit_invoice')}}/{{ $invoice->id }}"><i
                                                    class="text-primary fas fa-pen-alt"></i>&nbsp;&nbsp;تعديل
                                                الفاتورة</a>
                                            <a class="dropdown-item" href="#" data-invoice_id="{{ $invoice->id }}"
                                                data-toggle="modal" data-target="#delete_invoice"><i
                                                    class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
                                                الفاتورة</a>
                                            <a class="dropdown-item" href="{{url('status_show')}}/{{ $invoice->id }}"><i
                                                    class="text-success fas fa-money-bill"></i>&nbsp;&nbsp;تغير حالة
                                                الدفع</a>
                                            <a class="dropdown-item" href="#" data-invoice_id="{{ $invoice->id }}"
                                                data-toggle="modal" data-target="#archive_invoice"><i
                                                    class="text-warning fa fa-exchange-alt"></i>&nbsp;&nbsp;
                                                نقل الي الارشيف</a>
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


    <!-- حذف الفاتورة -->
    <div class="modal fade" id="delete_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">حذف الفاتورة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('invoices.destroy', 'test') }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                </div>
                <div class="modal-body">
                    هل انت متاكد من عملية الحذف ؟
                    <input type="hidden" name="invoice_id" id="invoice_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-danger">تاكيد</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- حذف الفاتورة -->

    <!-- ارشفت الفاتورة -->
    <div class="modal fade" id="archive_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ارشفت الفاتورة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{route('invoices.destroy', 'test')}}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                </div>
                <div class="modal-body">
                    هل انت متاكد من الارشفة ؟
                    <input type="hidden" name="invoice_id" id="invoice_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-success">تاكيد</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ارشفت الفاتورة -->


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

<!-- Delete Invoice Script -->
<script>
$('#delete_invoice').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var invoice_id = button.data('invoice_id')
    var modal = $(this)
    modal.find('.modal-body #invoice_id').val(invoice_id);
})
</script>
<!-- Delete Invoice Script -->

<!-- Archive Invoice Script -->
<script>
$('#archive_invoice').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var invoice_id = button.data('invoice_id')
    var modal = $(this)
    modal.find('.modal-body #invoice_id').val(invoice_id);
})
</script>
<!-- Archive Invoice Script -->
<!--Internal  Notify js -->
<script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection