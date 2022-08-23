@extends('admin.layouts.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.content-header', ['name' => 'product', 'key' => 'List'])
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
                                        <th scope="col">Tên Sản Phẩm</th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Hình Ảnh</th>
                                        <th scope="col">Danh Mục</th>
                                        <th scope="col">Add New
                                            @can('add-product')
                                            <a href="{{ Url('admin/product/add-product') }}"
                                            type="button" data-func="dt-add" class="btn btn-success btn-xs dt-add">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                            @endcan

                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product as $key => $data)
                                        <tr>
                                            <th scope="row">{{ $data->id }}</th>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ number_format($data->price ) }}đ</td>
                                            <td>
                                                <img src="{{ $data->feature_image_path }}" alt="Hình ảnh chính" width="150px">
                                            </td>
                                            <td>{{ $data->catename }}</td>

                                            <td>
                                                @can('edit-product',$data->id)
                                                <a href="{{ Url('admin/product/edit-product/'.$data->id) }}" type="button"
                                                    class="btn btn-warning">
                                                        Edit
                                                </a>
                                                @endcan

                                                @can('delete-product',$data->id)
                                                    <a data-url="{{ Url('admin/product/delete-product/'.$data->id) }}"
                                                    class="btn btn-danger action_Delete">
                                                        Delete
                                                    </a>
                                                @endcan

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        {{ $product->links('pagination::bootstrap-4') }}
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
