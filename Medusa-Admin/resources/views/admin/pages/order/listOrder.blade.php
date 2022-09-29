@extends('admin.layouts.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.content-header', ['name' => 'Order', 'key' => 'List'])
        <!-- /.content-header -->
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card col-12 ">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tên khách hàng</th>
                                        <th scope="col">Shipping</th>
                                        <th scope="col">Tổng tiền</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Ngày tạo</th>
                                        <th scope="col">Add New
                                            @can('add-product')
                                            {{-- <a href="{{ Url('admin/product/add-product') }}"
                                            type="button" data-func="dt-add" class="btn btn-success btn-xs dt-add">
                                                <i class="fa fa-plus"></i>
                                            </a> --}}
                                            @endcan

                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order as $key => $data)
                                        <tr>
                                            <th scope="row">{{ $data->id }}</th>
                                            <td class="col-3">{{ $data->name }}</td>
                                            <td>{{ number_format($data->shipping ) }}đ</td>

                                            <td>{{ number_format($data->total ) }}</td>
                                            <td>@php switch ($data->status) {
                                                case '1':
                                                    echo('<button class="btn btn-block bg-gradient-warning btn-xs">Chờ xác nhận</button>');
                                                    break;
                                                case '2':
                                                    echo('<button class="btn btn-block bg-gradient-warning btn-xs">Chờ lấy hàng</button>');
                                                    break;
                                                case '3':
                                                    echo('<button class="btn btn-block bg-gradient-info btn-xs">Đang giao</button>');
                                                    break;
                                                case '4':
                                                    echo('<button class="btn btn-block bg-gradient-success  btn-xs">Đã giao</button>');
                                                    break;
                                                case '5':
                                                echo('<button class="btn btn-block bg-gradient-danger btn-xs">Đã hủy</button>');
                                                    break;
                                                default:
                                                    # code...
                                                    break;
                                            }@endphp</td>
                                            <td>{{ date_format($data->created_at,"H:i ,d/m/Y") }}</td>
                                            <td class="project-actions">
                                                {{-- <a class="btn btn-primary btn-sm" href="#">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a> --}}
                                                @can('edit-order')
                                                <a class="btn btn-info btn-sm" href="{{ Url('admin/order/view-order/'.$data->id) }}">
                                                    <i class="fas fa-folder"></i>
                                                </a>
                                                @endcan
                                                {{-- <a class="btn btn-danger btn-sm action_Delete" data-url="{{ Url('admin/product/delete-product/'.$data->id) }}">
                                                    <i class="fas fa-trash"></i>

                                                </a> --}}


                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        {{-- {{ $product->links('pagination::bootstrap-4') }} --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- /.table --}}

    </div>
    <!-- /.content-wrapper -->
@endsection
@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('AdminBE/Product/list.js') }}"></script>

@endsection
