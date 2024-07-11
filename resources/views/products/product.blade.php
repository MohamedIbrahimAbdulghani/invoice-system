@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ المنتجات</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">


                <!--div-->
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                    <button class="modal-effect btn btn-primary " data-effect="effect-scale" data-toggle="modal" href="#modaldemo" > <a><i class="fas fa-plus" >إضافة منتج</i></a></button>



                                    <!-- start validation -->

                                    @if(session()->has("Add"))
                                        <div class="alert alert-success alert-dismissible fade show " style="width:100%" role="alert">
                                            <strong>{{session()->get("Add")}}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    @if(session()->has("Edit"))
                                        <div class="alert alert-success alert-dismissible fade show " style="width:100%" role="alert">
                                            <strong>{{session()->get("Edit")}}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    @if(session()->has("Delete"))
                                        <div class="alert alert-success alert-dismissible fade show " style="width:100%" role="alert">
                                            <strong>{{session()->get("Delete")}}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif


                                    <!-- end validation -->
                                <!-- Basic modal -->
                                <div class="modal" id="modaldemo">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">إضافة منتج</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <form action="{{route('products.store')}}" method="POST">
                                                <!-- @csrf -->
                                                {{csrf_field()}}
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail">اسم المنتج</label>
                                                    <input type="text" class="form-control" name="product_name" id="product_name" autocomplete="off" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail">اسم القسم</label>
                                                    <select name="section_id" id="section_id" class="form-control">
                                                    <option value="" selected disabled>__ حدد القسم __</option>
                                                        @foreach($sections as $section)
                                                            <option value="{{$section->id}}">{{$section->section_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea">ملاحظات</label>
                                                    <textarea class="form-control" rows="3" name="description"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">تأكيد </button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Basic modal -->



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
												<th class="border-bottom-0">ملاحظات</th>
												<th class="border-bottom-0">العمليات</th>
											</tr>
										</thead>
										<tbody>
                                            <?php $counter = 1 ?>
                                        @foreach($products as $product)
											<tr>
                                                <td>{{$counter++}}</td>
												<td>{{$product->product_name}}</td>
												<td>{{$product->section->section_name}}</td>
												<td>{{$product->description}}</td>
												<td>
                                                    <button class="btn btn-outline-success btn-sm" data-effect="effect-scale" data-id="{{ $product->id }}" data-product_name="{{ $product->product_name }}" data-section_name = "{{$product->section->section_name}}" data-description="{{ $product->description }}" data-toggle="modal" data-target="#EditModal">تعديل</button>

                                                    <button class="btn btn-outline-danger btn-sm" data-effect="effect-scale" data-id="{{ $product->id }}" data-product_name="{{ $product->product_name }}" data-description="{{ $product->description }}" data-toggle="modal" data-target="#DeleteModal">حذف</button>

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



                        <!-- edit -->
                        <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">تعديل القسم</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form action="{{route('products.update', $section->id)}}" method="POST">
                                            {{method_field('patch')}}
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <input type="hidden" name="id" id="id">  <!-- very important this code to get id from product and sent it with form -->
                                                <label for="recipient-name" class="col-form-label">اسم المنتج:</label>
                                                <input class="form-control" name="product_name"  id="product_name" type="text" >
                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">القسم :</label>
                                                <select name="section_name" id="section_name" class="form-control custom-select" required>
                                                        @foreach($sections as $section)
                                                        <option {{ $section->id }}> {{ $section->section_name }} </option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="col-form-label">ملاحظات:</label>
                                                <textarea class="form-control" id="description" name="description"></textarea>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">تاكيد</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    <!-- delete -->
                    <div class="modal" id="DeleteModal">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">حذف المنتج</h6>
                                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form action="{{{route('products.destroy', $section->id)}}}" method="post">
                                    {{method_field('delete')}}
                                    {{csrf_field()}}
                                    <div class="modal-body">
                                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                        <input type="hidden" name="id" id="id" value="">
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
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>


<!-- this is script by javascript to get old data in input -->
<script>
    $("#EditModal").on("show.bs.modal", function(event) {
        var button = $(event.relatedTarget)
        var id = button.data("id")
        var product_name = button.data("product_name")
        var section_name = button.data("section_name")
        var description = button.data("description")
        var modal = $(this)

        modal.find(".modal-body #id").val(id)
        modal.find(".modal-body #product_name").val(product_name)
        modal.find(".modal-body #section_name").val(section_name)
        modal.find(".modal-body #description").val(description)
    });
</script>


<!-- this is script by javascript to delete data -->
<script>
    $("#DeleteModal").on("show.bs.modal", function(event) {
        var button = $(event.relatedTarget)
        var id = button.data("id")
        var product_name = button.data("product_name")
        var modal = $(this)

        modal.find(".modal-body #id").val(id)
        modal.find(".modal-body #product_name").val(product_name)
    });
</script>

@endsection
