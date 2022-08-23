@extends('admin.layouts.layout')

@section('css')
    {{-- <style>
        .select2-selection__choice {
            background-color: black !important;
        }
    </style> --}}
@endsection



@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.content-header', ['name' => 'Slider', 'key' => 'add'])
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
                            <form method="POST" action="{{ Url('admin/slider/save-slider/') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Tiêu Đề Slider</label>
                                    <input type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}"
                                        name="name" placeholder="Nhập tiêu đề Slider" >
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label for="image_path">Hình Ảnh</label>
                                    <input type="file" class="form-control-file @error('image_path') is-invalid @enderror" name="image_path">
                                        @error('image_path')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">Mô Tả</label>
                                    <textarea class="form-control tinymce_edit_init @error('description') is-invalid @enderror"
                                        name="description" rows="10">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Trạng Thái</label>
                                    <select class="form-control" name="status" aria-label="Default select example">
                                        <option value="0" selected>Hiện</option>
                                        <option value="1">Ẩn</option>
                                      </select>
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
    <script src="{{ asset('AdminBE/Product/form.js') }}"></script>
@endsection
