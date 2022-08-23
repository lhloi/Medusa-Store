@extends('admin.layouts.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.content-header',['name'=>'Permisson','key'=>'add'])
        <!-- /.content-header -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card col-12 ">
                        <div class="card-body col-12">
                            <form method="POST" action="{{ Url('admin/permission/save-permission/') }}">
                                @csrf
                                {{-- <div class="form-group">
                                    <label for="name">Tên Danh Mục</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nhập tên Danh mục" onkeyup="ChangeToSlug()">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug Menu</label>
                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" readonly>
                                </div> --}}
                                <div class="form-group">
                                    <label for="parent_id">Chọn Module</label>
                                    <select class="form-control" id="parent_id" name="module_parent">
                                        <option value="">Chọn Module</option>
                                        @foreach (config('permissions.module') as $key=>$data)
                                            <option value="{{ $key }}" >{{ $data }} </option>

                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        @foreach (config('permissions.module_childrent') as $key=>$data)
                                        <div class="col-md-3">
                                            <label for="">
                                                <input type="checkbox" value="{{ $key }}" name="module_childrent[]">
                                                {{-- <p value="{{ $data }}">{{ $data }}</p> --}}
                                                {{-- <input type="" name="" value="{{ $data }}"> --}}
                                                {{ $data }}
                                            </label>
                                        </div>
                                        @endforeach


                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- /.table --}}

    </div>
    <!-- /.content-wrapper -->
@endsection
