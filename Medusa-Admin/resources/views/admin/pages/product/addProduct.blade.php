@extends('admin.layouts.layout')

@section('css')
<link href="{{ asset('AdminBE/Product/product.css') }}" rel="stylesheet" />
@endsection



@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.content-header', ['name' => 'Product', 'key' => 'add'])
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
                            <form method="POST" action="{{ Url('admin/product/save-product/') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Tên Sản Phẩm</label>
                                    <input type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}"
                                        name="name" id="name" placeholder="Nhập tên Sản Phẩm" onkeyup="ChangeToSlug()">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug Sản Phẩm</label>
                                    <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="price">Giá Sản Phẩm</label>
                                    <input type="text"
                                        class="form-control @error('price') is-invalid @enderror"
                                        value="{{ old('price') }}"
                                        name="price" placeholder="Nhập Giá Sản Phẩm" onkeyup="ChangeToSlug()">
                                        @error('price')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="feature_image_path">Ảnh Chính</label>
                                    <input type="file" class="form-control-file " id="feature_image_path"
                                        name="feature_image_path">
                                </div>
                                <div class="form-group">
                                    <label for="image_path">Ảnh chi tiết</label>
                                    <input type="file" class="form-control-file" name="image_path[]" multiple>
                                </div>
                                <div class="form-group">
                                    <label for="content">Mô Tả Sản Phẩm</label>
                                    <textarea class="form-control tinymce_edit_init @error('content') is-invalid @enderror"
                                        name="content" rows="10">{{ old('content') }}</textarea>
                                        @error('content')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Chọn Danh Mục</label>
                                    <select class="form-control select2_init @error('category_id') is-invalid @enderror"
                                        name="category_id">
                                        <option value="" selected>Chọn Danh Mục</option>
                                        @foreach ($cate as $key => $data)
                                            @if ($data->parent_id == 0)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>

                                                @foreach ($cate as $key => $parent)
                                                    @if ($data->id == $parent->parent_id)
                                                        <option value="{{ $parent->id }}">
                                                            &nbsp&nbsp&nbsp{{ $parent->name }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach

                                    </select>
                                    @error('category_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="parent_id"> Nhập Tags Sản Phẩm </label>
                                    <select class="form-control tags_select_choose" name="tags[]" multiple="multiple">
                                        @if (!empty($tags))
                                            @foreach ($tags as $key => $data)
                                                <option value="{{ $data->name }}">{{ $data->name }}</option>
                                            @endforeach
                                        @endif

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
