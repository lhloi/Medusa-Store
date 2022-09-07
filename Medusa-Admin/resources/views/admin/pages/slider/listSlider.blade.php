@extends('admin.layouts.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.content-header', ['name' => 'Slider', 'key' => 'List'])
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
                                        <th scope="col">Tên Slider</th>
                                        <th scope="col">Hình Ảnh</th>
                                        <th scope="col">Mô tả</th>
                                        <th scope="col">Trạng Thái</th>
                                        <th scope="col">Add New
                                            @can('add-slider')
                                            <a href="{{ Url('admin/slider/add-slider') }}"
                                                type="button" data-func="dt-add" class="btn btn-success btn-xs dt-add">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                            @endcan

                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($slider as $key => $data)
                                        <tr>
                                            <th scope="row">{{ $data->id }}</th>
                                            <td>{{ $data->name }}</td>
                                            <td>
                                                <img src="{{ $data->image_path }}" alt="Hình ảnh chính" width="150px">
                                            </td>
                                            <td>{{ $data->description }}</td>
                                            <td>
                                                @if ($data->status== 0)
                                                    Ẩn
                                                @elseif($data->status= 1)
                                                    Hiện
                                                @endif

                                            </td>

                                            <td>
                                                @can('edit-slider')
                                                <a href="{{ Url('admin/slider/edit-slider/'.$data->id) }}" type="button"
                                                class="btn btn-warning">
                                                    Edit
                                                </a>
                                                @endcan

                                                @can('delete-slider')
                                                    <a href=""
                                                        data-url="{{ Url('admin/slider/delete-slider/'.$data->id) }}"
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
                        {{ $slider->links('pagination::bootstrap-4') }}
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
<script src="{{ asset('AdminBE/Slider/list.js') }}"></script>

@endsection
