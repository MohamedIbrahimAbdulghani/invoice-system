@extends('layouts.master')
@section('css')
<style>
@media print {
    #print_button {
        display: none;
    }
}
</style>
@endsection

@section('title')
معاينة طباعة الفاتورة
@stop
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">قائمة الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                معاينة طباعة الفاتورة</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')

<div class="row row-sm">
    <div class="col-md-12 col-xl-12">
        <div class=" main-content-body-invoice" id="print_invoice_by_id">
            <div class="card card-invoice">
                <div class="card-body">
                    <h1 class="invoice-title">تحصيل الفاتورة</h1>
                    <div class="row mg-t-20">
                        <div class="col-md">
                            <label class="tx-gray-600">معلومات الفاتورة</label>
                            <p class="invoice-info-row"><span>رقم الفاتورة</span>
                                <span>{{$invoice->invoice_number}}</span>
                            </p>
                            <p class="invoice-info-row"><span>تاريخ الاصدار</span>
                                <span>{{$invoice->invoice_date}}</span>
                            </p>
                            <p class="invoice-info-row"><span>تاريخ الاستحقاق</span>
                                <span>{{$invoice->due_date}}</span>
                            </p>
                            <p class="invoice-info-row"><span>القسم</span>
                                <span>{{$invoice->sections->section_name}}</span>
                            </p>
                        </div>
                    </div>
                    <div class="table-responsive mg-t-40">
                        <table class="table table-invoice border text-md-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th class="wd-20p">#</th>
                                    <th class="wd-40p">المنتج</th>
                                    <th class="tx-center">مبلغ التحصيل</th>
                                    <th class="tx-right">مبلغ العمولة</th>
                                    <th class="tx-right">الاجمالي</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php $counter = 1; ?>
                                    <td><?php echo $counter++; ?></td>
                                    <td class="tx-12">{{$invoice->product}}</td>
                                    <td class="tx-center">{{number_format($invoice->Amount_collection, 2)}}</td>
                                    <td class="tx-right">{{number_format($invoice->Amount_commission, 2)}}</td>
                                    <?php $total = $invoice->Amount_collection + $invoice->Amount_commission;?>
                                    <td class="tx-right">{{number_format($total, 2)}}</td>
                                </tr>
                                <tr>
                                    <td class="valign-middle" colspan="2" rowspan="4">
                                        <div class="invoice-notes">
                                            <label class="main-content-label tx-13"> </label>
                                        </div><!-- invoice-notes -->
                                    </td>
                                    <td class="tx-right">الاجمالي</td>
                                    <td class="tx-right" colspan="2">{{number_format($total, 2)}}</td>
                                </tr>
                                <tr>
                                    <td class="tx-right">نسبة الضريبة</td>
                                    <td class="tx-right" colspan="2">{{$invoice->rate_vat}}</td>
                                </tr>
                                <tr>
                                    <td class="tx-right">قيمة الخصم</td>
                                    <td class="tx-right" colspan="2">{{$invoice->discount}}</td>
                                </tr>
                                <tr>
                                    <td class="tx-right tx-uppercase tx-bold tx-inverse">الاجمالي شامل الضريبة </td>
                                    <td class="tx-right" colspan="2">
                                        <h4 class="tx-primary tx-bold">{{number_format($invoice->total, 2)}}</h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr class="mg-b-40">

                    <button class="btn btn-danger float-left mt-3 mr-2" id="print_button" onclick="printInvoice()"><i
                            class="mdi mdi-printer ml-1"></i>طباعة</button>

                </div>
            </div>
        </div>
    </div><!-- COL-END -->
</div>
<!-- main-content closed -->
@endsection
@section('js')

<!-- this code javascript to print invoice when onclick in button print -->
<script>
function printInvoice() {
    var printContents = document.getElementById('print_invoice_by_id').innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    // Window.print();
    setTimeout(() => {
        window.print();
        location.reload();
    }, 500); // تأخير بسيط لضمان تحميل الصفحة بالكامل قبل الطباعة
    document.body.innerHTML = printContents;
}
</script>
@endsection