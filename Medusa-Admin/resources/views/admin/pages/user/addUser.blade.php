@extends('admin.layouts.layout')

@section('css')
<link href="{{ asset('AdminBE/User/user.css') }}" rel="stylesheet" />
@endsection



@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.content-header', ['name' => 'User', 'key' => 'add'])
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
                            <form method="POST" action="{{ Url('admin/user/save-user/') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Tên Nhân Viên</label>
                                    <input type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}"
                                        name="name" placeholder="Nhập tên nhân viên" >
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Email</label>
                                    <input type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}"
                                        name="email" placeholder="Nhập email nhân viên" >
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Password</label>
                                    <input type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        value="{{ old('password') }}"
                                        name="password" placeholder="Nhập mật khẩu nhân viên" >
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label for="role_id"> Chọn vai trò </label>
                                    <select class="form-control select2_init  @error('role_id') is-invalid @enderror" name="role_id[]" multiple>
                                        @foreach ($role as $key => $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>

                                {{-- <div class="form-group">
                                    <label for="description">Trạng Thái</label>
                                    <select class="form-control" name="status" aria-label="Default select example">
                                        <option value="0" selected>Hiện</option>
                                        <option value="1">Ẩn</option>
                                      </select>
                                </div> --}}


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
    <script src="{{ asset('AdminBE/User/user.js') }}"></script>
@endsection
