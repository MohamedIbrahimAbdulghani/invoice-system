@extends('layouts.master')

@section('title')
الاقسام
@stop
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<!---Internal Owl Carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<!---Internal  Multislider css-->
<link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
<!--- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> /
                المنتجات</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')

<!-- start messages validation -->
@if(session()->has('Add'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('Add') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session()->has('Edit'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('Edit') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session()->has('Delete'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('Delete') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<!-- end messages validation -->

<!-- row -->
<div class="row row-sm">
    <!--div-->
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <button class="modal-effect btn btn btn-primary  " data-effect="effect-scale" data-toggle="modal"
                        href="#AddModal">إضافة
                        منتج</button>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table key-buttons text-md-nowrap">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">اسم المنتج</th>
                                <th class="border-bottom-0">اسم القسم</th>
                                <th class="border-bottom-0">الملاحظات</th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter = 1; ?>
                            @foreach($products as $product)
                            <tr>
                                <td><?php echo $counter++; ?></td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{$product->sections->section_name}}</td>
                                <td>{{ $product->description }}</td>
                                <td>
                                    <a href="#EditModal" class="modal-effect btn btn-sm btn-info"
                                        data-effect="effect-scale" data-product_id="{{ $product->id }}"
                                        data-product_name="{{ $product->product_name }}"
                                        data-section_id="{{ $product->section_id }}"
                                        data-section_name="{{ $product->sections->section_name }}"
                                        data-description="{{ $product->description }}" data-toggle="modal"
                                        title="تعديل"><i class="las la-pen"></i></a>

                                    <a href="#DeleteModal" class="modal-effect btn btn-sm btn-danger"
                                        data-effect="effect-scale" data-product_id="{{ $product->id }}"
                                        data-product_name="{{ $product->product_name }}"
                                        data-description="{{ $product->description }}" data-toggle="modal"
                                        title="حذف"><i class="las la-trash"></i></a>
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

<!-- Basic modal -->
<div class="modal" id="AddModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title"> إضافة منتج</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label>اسم المنتج</label>
                        <input type="text" class="form-control" id="product_name" name="product_name">
                    </div>
                    <div class="form-group">
                        <label>اسم القسم</label>
                        <select name="section_id" id="section_id" class="form-control">
                            <option value="" disabled selected>--حدد القسم--</option>
                            @foreach($sections as $section)
                            <option value="{{$section->id}}">{{$section->section_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>ملاحظات</label>
                        <textarea class="form-control" name="description" id="description"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-success" type="submit" name="add">إضافة</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إغلاق</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Basic modal -->

<!-- edit -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تعديل القسم</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{route('products.update', $product->id)}}" method="post" autocomplete="off">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <input type="hidden" name="product_id" id="product_id" value="">
                        <label for="recipient-name" class="col-form-label">اسم المنتج:</label>
                        <input class="form-control" name="product_name" id="product_name" type="text"
                            value="{{ $product->product_name }}">
                    </div>

                    <div class="form-group">
                        <label>اسم القسم</label>
                        <select name="section_id" id="section_id" class="form-control">
                            @foreach($sections as $section)
                            <option value="{{$section->id}}">{{$section->section_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="col-form-label">ملاحظات:</label>
                        <textarea class="form-control" id="description" name="description" value=" "></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">تاكيد</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- end edit -->


<!-- delete -->
<div class="modal" id="DeleteModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('products.destroy', $product->id)}}" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>هل انت متاكد من عملية الحذف ؟</p><br>
                    <input type="hidden" name="product_id" id="product_id" value="">
                    <input class="form-control" name="product_name" id="product_name" type="text" readonly>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-danger">تاكيد</button>
                </div>
        </div>
        </form>
    </div>
</div>

<!-- end delete -->
</div>
<!-- Container closed -->
</div>

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
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>


<script>
$('#EditModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var product_id = button.data('product_id')
    var product_name = button.data('product_name')
    var section_name = button.data('section_name')
    var section_id = button.data('section_id')
    var description = button.data('description')
    var modal = $(this)
    modal.find('.modal-body #product_id').val(product_id);
    modal.find('.modal-body #product_name').val(product_name);
    modal.find('.modal-body #section_id').val(section_id);
    modal.find('.modal-body #section_name').val(section_name);
    modal.find('.modal-body #description').val(description);
})
</script>

<script>
$('#DeleteModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var product_id = button.data('product_id')
    var product_name = button.data('product_name')
    var modal = $(this)
    modal.find('.modal-body #product_id').val(product_id);
    modal.find('.modal-body #product_name').val(product_name);
})
</script>

@endsection