@extends('admin.layouts.layout')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css" />
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.content-header', ['name' => 'Size', 'key' => 'List'])
        <!-- /.content-header -->
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class=" col-4 ">
                        <div class="card-body">
                            <form method="POST" class="" action="{{ Url('admin/product/save-product-size/') }}">
                                @csrf
                                <div class="form-group ">
                                    <label for="name">Tên</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                         name="name" id="name" value="{{ old('name') }}" onkeyup="ChangeToSlug()">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="description">Mô Tả</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                        name="description" rows="4">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>

                                <div class="form-group col-md-12">
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
                                        <th scope="col">Tên</th>
                                        <th scope="col">Mô tả</th>
                                        <th scope="col">Slug</th>
                                        <th scope="col">Active</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($size as $key => $data)
                                    <tr>
                                        <td style="font-weight: 600;" class="text-primary">{{ $data->name }}</td>
                                        <td>
                                            {{ $data->description }}
                                        </td>
                                        <td>{{ $data->slug }}</td>

                                        <td>
                                            @can('delete-role')
                                            <a data-url="{{ Url('admin/product/delete-product-size/'.$data->id) }}" class="btn btn-danger action_Delete">
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
                </div>
            </div>
        </div>
        {{-- <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-sm-12">
                        {{ $role->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- /.table --}}

    </div>
    <!-- /.content-wrapper -->
@endsection
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('AdminBE/product/list.js') }}"></script>


    {{-- ---------------------------Size-------------------------------- --}}

@endsection
