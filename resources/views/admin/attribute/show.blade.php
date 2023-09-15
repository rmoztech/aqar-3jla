@extends('admin.layouts.master')
@section('title')
    {{__('admin/pages/attributes.attribute.value')}}
@endsection
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"></h4>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
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

    <div class="row row-sm">

        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">{{$attribute->name}}</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-2">
                    <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20 mg-sm-t-0">
                        <a class="btn btn-primary-gradient btn-block" data-effect="effect-slide-in-right"
                           data-toggle="modal" href="#add-value">{{__('admin/pages/attributes.add.value')}}</a>
                    </div>
                    </p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">{{__('admin/pages/attributes.name')}}</th>
                                <th class="border-bottom-0">{{__('admin/pages/attributes.action')}}</th>
                                <th class="border-bottom-0">.</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $row = 1;
                            @endphp
                            @foreach($attribute->values as $value)
                                <tr>
                                    <td>{{$row++}}</td>
                                    <td>{{$value->name}}</td>
                                    <td>
                                        <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                           data-id="{{ $value->id }}" data-attribute_name="{{ $value->name }}"
                                           data-toggle="modal"
                                           href="#edit-attribute" title="{{__('admin/pages/attributes.edit')}}"><i
                                                class="las la-pen"></i></a>
                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                           data-id="{{ $value->id }}"
                                           data-toggle="modal" href="#delete-attribute"
                                           title="{{__('admin/pages/attributes.delete')}}"><i
                                                class="las la-trash"></i></a>
                                    </td>
                                    <td>.</td>
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
    <div class="modal" id="add-value">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">{{__('admin/pages/attributes.add.value')}}</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <h6>{{__('admin/pages/attributes.add.value.new')}}</h6>
                    <form action="{{ route('values.store') }}" method="post" autocomplete="off"
                          data-parsley-validate>
                        @csrf
                        <input type="hidden" name="attribute_id" value="{{$attribute->id}}">
                        <div class="form-group">
                            <label for="add_attribute_name"
                                   class="col-form-label">{{__('admin/pages/attributes.name')}} <span class="tx-danger">*</span></label>
                            <input class="form-control" name="name" id="add_attribute_name" type="text" required
                                   maxlength="255"
                                   data-parsley-required-message="{{__('admin/pages/attributes.name.value.invalid')}}"
                            >
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">{{__('admin/pages/attributes.add')}}</button>
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{__('admin/pages/attributes.cancel')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="edit-attribute">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <form action="../attribute/values/update" method="post" data-parsley-validate>
                    @csrf
                    @method('put')
                    <div class="modal-header">
                        <h6 class="modal-title">{{__('admin/pages/attributes.edit.value')}}</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <h6>{{__('admin/pages/attributes.edit.value')}}</h6>
                        <input type="hidden" name="id" id="id" value="">
                        <input type="hidden" name="attribute_id" value="{{$attribute->id}}">
                        <div class="form-group">
                            <label for="edit_attribute_name"
                                   class="col-form-label">{{__('admin/pages/attributes.name')}} <span class="tx-danger">*</span></label>
                            <input class="form-control" name="name" id="edit_attribute_name" type="text" required
                                   maxlength="255"
                                   data-parsley-required-message="{{__('admin/pages/attributes.name.value.invalid')}}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{__('admin/pages/attributes.edit')}}</button>
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{__('admin/pages/attributes.cancel')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="delete-attribute">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-body tx-center pd-y-20 pd-x-20">
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                    <i class="icon icon ion-ios-close-circle-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                    <h4 class="tx-danger mg-b-20">{{__('admin/pages/attributes.are.you.sure')}}</h4>
                    <p class="mg-b-20 mg-x-20">{{__('admin/pages/attributes.delete.attribute.value.confirm.message')}}</p>
                    <form action="../attribute/values/destroy" method="post" autocomplete="off">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="id" id="id" value="">
                        <button type="submit"
                                class="btn ripple btn-danger pd-x-25">{{__('admin/pages/attributes.delete')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <script>
        //Script For Display Edit attribute Modal And Put The Data
        $('#edit-attribute').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var attribute_name = button.data('attribute_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #edit_attribute_name').val(attribute_name);
        })

        //Script For Display Delete attribute Modal
        $('#delete-attribute').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
        })


        @if(\Illuminate\Support\Facades\Session::has('delete-success'))
        Swal.fire(
            '{{__('admin/pages/attributes.deleted')}}',
            '{{\Illuminate\Support\Facades\Session::get('delete-success')}}',
            'success'
        )
        @endif
        @if(\Illuminate\Support\Facades\Session::has('add-success'))
        Swal.fire(
            '{{__('admin/pages/attributes.attribute.value.add')}}',
            '{{\Illuminate\Support\Facades\Session::get('add-success')}}',
            'success'
        )
        @endif
        @if(\Illuminate\Support\Facades\Session::has('edit-success'))
        Swal.fire(
            '{{__('admin/pages/attributes.attribute.value.edit')}}',
            '{{\Illuminate\Support\Facades\Session::get('edit-success')}}',
            'success'
        )
        @endif

    </script>
    <!--Internal  Parsley.min js -->
    <script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
    <!-- Internal Form-validation js -->
    <script src="{{URL::asset('assets/js/form-validation.js')}}"></script>

@endsection
