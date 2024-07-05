@extends('layouts.master')
@section("title")
    الاقسام
@stop
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
							<h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الاقسام</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->


@endsection
@section('content')
				<!-- row opened -->
				<div class="row row-sm">


                <!-- start show message for validation -->

                    <!-- start validation success message -->
                        <!-- @if(session()->has("Add"))
                            <div class="alert alert-success alert-dismissible fade show " style="width:100%" role="alert">
                                <strong>{{session()->get("Add")}}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif -->
                    <!-- end validation success message -->

                    <!-- start validation error message -->
                    <!-- @if(session()->has("Error"))
                        <div class="alert alert-danger alert-dismissible fade show " style="width:100%" role="alert">
                            <strong>{{session()->get("Error")}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif -->
                    <!-- end validation error message -->


                    @if ($errors->any())
                        <div class="alert alert-danger"style="width:100%">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach

                            </ul>
                        </div>
                    @endif


                <!-- end show message for validation -->


                <div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">

                                <div class="col-sm-6 col-md-4 col-xl-3 d-inline">
										<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo" >إضافة قسم</a>
									</div>

                                <!-- Basic modal -->
                                <div class="modal" id="modaldemo">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">إضافة قسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <form action="{{route('section.store')}}" method="POST">
                                                <!-- @csrf -->
                                                {{csrf_field()}}
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail">اسم القسم</label>
                                                    <input type="text" class="form-control" name="section_name" id="section_name"  >
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea">ملاحظات</label>
                                                    <textarea class="form-control" rows="3" name="description"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">حفظ </button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Basic modal -->

							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table key-buttons text-md-nowrap text-center">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0">اسم القسم</th>
												<th class="border-bottom-0">الوصف</th>
												<th class="border-bottom-0">العمليات</th>
											</tr>
										</thead>
										<tbody>
                                            <?php $counter = 1 ?>
                                            @foreach($sections as $section)
											<tr>
												<td>{{$counter++}}</td>
												<td>{{$section->section_name}}</td>
												<td>{{$section->description}}</td>
												<td>
                                                    <button type="submit" class="btn btn-success">تعديل</button>
                                                    <button type="submit" class="btn btn-danger">حذف</button>
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
				<!-- /row -->
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
@endsection
