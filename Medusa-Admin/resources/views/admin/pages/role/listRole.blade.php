@extends('admin.layouts.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.content-header', ['name' => 'Role', 'key' => 'List'])
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
                                        <th scope="col">Tên Vai Trò</th>
                                        <th scope="col">Mô Tả</th>
                                        <th scope="col">Add New
                                            @can('update')

                                            @endcan
                                            <a href="{{ Url('admin/role/add-role') }}"
                                                type="button" data-func="dt-add" class="btn btn-success btn-xs dt-add">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($role as $key => $data)
                                        <tr>
                                            <th scope="row">{{ $data->id }}</th>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->display_name }}</td>

                                            <td>
                                                @can('edit-role')
                                                <a href="{{ Url('admin/role/edit-role/'.$data->id) }}" type="button"
                                                    class="btn btn-warning">
                                                        Edit
                                                    </a>
                                                @endcan

                                                @can('delete-role')
                                                <a href=""
                                                data-url="{{ Url('admin/role/delete-role/'.$data->id) }}"
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
                        {{ $role->links('pagination::bootstrap-4') }}
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
<script src="{{ asset('AdminBE/product/list.js') }}"></script>

@endsection
