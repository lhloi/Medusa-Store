@extends('admin.layouts.layout')

@section('css')
    <link href="{{ asset('AdminBE/Role/role.css') }}" rel="stylesheet" />
@endsection



@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.content-header', ['name' => 'Role', 'key' => 'add'])
        <!-- /.content-header -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    {{-- @if ($errors->any())
                        <div class="text-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}
                    <div class="card col-12 ">
                        <div class="card-body col-12">
                            <form method="POST" action="{{ Url('admin/role/update-role/'.$role->id ) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Tên Vai Trò</label>
                                    <input type="text" class="form-control"
                                        value="{{$role->name }}" name="name" placeholder="Nhập tiêu đề role">
                                    {{-- @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror --}}
                                </div>

                                <div class="form-group">
                                    <label for="display_name">Mô Tả Vai Trò</label>
                                    <textarea class="form-control tinymce_edit_init" name="display_name"
                                        rows="4">{{$role->name }}</textarea>
                                    @error('display_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <label>
                                            <input type="checkbox" name="" class="checkall">
                                        </label>
                                        Chọn tất cả
                                    </div>
                                    @foreach ($permission as $key => $data)
                                        <div class="card mb-3">
                                            <div class="card-header bg-secondary">
                                                <label>
                                                    <input type="checkbox" value="" class="checkbox_wrapper">
                                                </label>
                                                Module {{ $data->name }}
                                            </div>
                                            <div class="row">
                                                @foreach ($data->PermissionChildrent as $key=>$childrent)
                                                <div class="card-body col-3">
                                                    <h5 class="card-title ">
                                                        <label>
                                                            <input type="checkbox" name="permission_id[]" value="{{ $childrent->id }}" {{ $permissionChecked->contains('id',$childrent->id)? 'checked':'' }} class="checkbox_childrent">

                                                        </label>
                                                        {{ $childrent->name }}
                                                    </h5>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
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

@section('js')
    <script src="{{ asset('AdminBE/Role/role.js') }}"></script>
@endsection
