@extends('admin.layouts.layout')

@section('css')

@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.content-header', ['name' => 'Brand', 'key' => 'List'])
        <!-- /.content-header -->
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4 ">
                        <div class="card-body">
                            @if (!isset($brandById))
                                <form method="POST" action="{{ Url('admin/brand/save-brand/') }}">

                            @else
                                <form method="POST" action="{{ Url('admin/brand/update-brand/'.$brandById->id) }}">
                                    {{-- <input type="hidden" name="_method" value="PUT"> --}}
                                    @method('GET')

                            @endif
                                @csrf
                                <div class="form-group">
                                    <label for="name">Tên Thương Hiệu</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                         name="name" id="name" placeholder="Nhập Thương Hiệu" value="{{isset($brandById)? $brandById->name : old('name')}}" onkeyup="ChangeToSlug()">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" name="slug" id="slug" value="{{isset($brandById)? $brandById->name : old('name')}}" placeholder="Slug" readonly>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>

                            </form>


                        </div>
                    </div>
                    <div class="card col-8 ">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Tên Thương hiệu</th>
                                        <th scope="col">Slug</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                        @foreach ($brand as $key => $data)
                                        <tr>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->slug }}</td>


                                            <td>
                                                @can('edit-role')
                                                <a class="btn btn-info btn-sm" href="{{ Url('admin/brand/edit-brand/'.$data->id) }}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                @endcan

                                                @can('delete-role')
                                                <a class="btn btn-danger btn-sm action_Delete" data-url="{{ Url('admin/brand/delete-brand/'.$data->id) }}">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                @endcan

                                            </td>
                                        </tr>
                                    @endforeach



                                </tbody>
                            </table>
                        </div>
                        {{-- <div class="col-sm-12"> --}}
                            {{ $brand->links('pagination::bootstrap-4') }}
                        {{-- </div> --}}
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

    {{-- ---------------------------Color Picker-------------------------------- --}}

@endsection
