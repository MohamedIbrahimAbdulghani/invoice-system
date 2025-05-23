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
تغير حالة الدفع
@stop
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                تغير حالة الدفع</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')



<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('invoices.status_update', $invoices->id)}}" method="post"
                    enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    {{-- 1 --}}

                    <div class="row">
                        <div class="col">
                            <label for="inputName" class="control-label">رقم الفاتورة</label>
                            <input type="hidden" name="invoice_id" id="invoice_id" value="{{$invoices->id}}">
                            <input type="text" class="form-control" id="inputName" name="invoice_number"
                                value="{{$invoices->invoice_number}}" title="يرجي ادخال رقم الفاتورة" required readonly>
                        </div>

                        <div class="col">
                            <label>تاريخ الفاتورة</label>
                            <input class="form-control fc-datepicker" name="invoice_Date" placeholder="YYYY-MM-DD"
                                type="text" value="{{$invoices->invoice_date}}" required readonly>
                        </div>


                        <div class="col">
                            <label>تاريخ الاستحقاق</label>
                            <input class="form-control fc-datepicker" name="Due_date" placeholder="YYYY-MM-DD"
                                type="text" required value="{{$invoices->due_date}}" readonly>
                        </div>


                    </div>

                    {{-- 2 --}}
                    <div class="row">
                        <div class="col">
                            <label for="inputName" class="control-label">القسم</label>
                            <select name="section" class="form-control SelectBox" onclick="console.log($(this).val())"
                                onchange="console.log('change is firing')" readonly>
                                <!--placeholder-->
                                <option value=" {{ $invoices->sections->id }}">
                                    {{ $invoices->sections->section_name }}
                                </option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="inputName" class="control-label">المنتج</label>
                            <select id="product" class="form-control" name="product" readonly>
                                <option value="{{$invoices->product}}">{{$invoices->product}}
                                </option>
                            </select>
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">مبلغ التحصيل</label>
                            <input type="text" class="form-control" id="inputName" name="Amount_collection"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                value="{{$invoices->Amount_collection}}" readonly>
                        </div>
                    </div>


                    {{-- 3 --}}

                    <div class="row">

                        <div class="col">
                            <label for="inputName" class="control-label">مبلغ العمولة</label>
                            <input type="text" class="form-control form-control-lg" id="Commission" name="Commission"
                                title="يرجي ادخال مبلغ العمولة "
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                required value="{{$invoices->Amount_commission}}" readonly>
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">الخصم</label>
                            <input type="text" class="form-control form-control-lg" id="Discount" name="Discount"
                                title="يرجي ادخال مبلغ الخصم "
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                value={{$invoices->discount}} required readonly>
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">نسبة ضريبة القيمة المضافة</label>
                            <select name="Percentage_Rate_Value_Added" id="Percentage_Rate_Value_Added"
                                class="form-control" onchange="myFunction()" readonly>
                                <!--placeholder-->
                                <option value="" selected readonly>{{$invoices->rate_vat}}</option>
                            </select>
                        </div>

                    </div>

                    {{-- 4 --}}

                    <div class="row">
                        <div class="col">
                            <label for="inputName" class="control-label">قيمة ضريبة القيمة المضافة</label>
                            <input type="text" class="form-control" id="Rate_Value_Added" name="Rate_Value_Added"
                                readonly value="{{$invoices->value_vat}}" readonly>
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">الاجمالي شامل الضريبة</label>
                            <input type="text" class="form-control" id="Total" name="total" readonly
                                value="{{$invoices->total}}" readonly>
                        </div>
                    </div>

                    {{-- 5 --}}
                    <div class="row">
                        <div class="col">
                            <label for="exampleTextarea">ملاحظات</label>
                            <textarea class="form-control" id="exampleTextarea" name="note" rows="3"
                                readonly>{{$invoices->note}}</textarea>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col">
                            <label for="exampleTextarea">حالة الدفع</label>
                            <select class="form-control" id="status" name="status" required>
                                <option selected="true" disabled="disabled">-- حدد حالة الدفع --</option>
                                <option value="مدفوعة">مدفوعة</option>
                                <option value="مدفوعة جزئيا">مدفوعة جزئيا</option>
                            </select>
                        </div>

                        <div class="col">
                            <label>تاريخ الدفع</label>
                            <input class="form-control fc-datepicker" name="payment_date" placeholder="YYYY-MM-DD"
                                type="text" required>
                        </div>


                    </div><br>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">تحديث حالة الدفع</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Select2 js-->
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!--Internal  Form-elements js-->
<script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
<script src="{{ URL::asset('assets/js/select2.js') }}"></script>
<!--Internal Sumoselect js-->
<script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
<!-- Internal form-elements js -->
<script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
<script>
var date = $('.fc-datepicker').datepicker({
    dateFormat: 'yy-mm-dd'
}).val();
</script>
@endsection