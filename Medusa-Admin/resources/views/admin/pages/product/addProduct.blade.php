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
                <form method="POST" class="row" action="{{ Url('admin/product/save-product/') }}" enctype="multipart/form-data">
                    @csrf
{{-- --------------------------colom left --}}
                    <div class="col-md-8">
                        <div class="card col-12">
                            <div class="card-body col-12">
                                <div class="form-group">
                                    <label for="name">Tên Sản Phẩm</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" name="name" id="name"
                                        placeholder="Nhập tên Sản Phẩm" onkeyup="ChangeToSlug()">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug Sản Phẩm</label>
                                    <input type="text" class="form-control" name="slug" id="slug"
                                        placeholder="Slug" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="content">Mô Tả Sản Phẩm</label>
                                    <textarea class="form-control tinymce_edit_init @error('content') is-invalid @enderror" name="content" rows="40">{{ old('content') }}</textarea>
                                    @error('content')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card col-12">
                            <div class="card-header">
                                <h3 class="card-title">Thêm Biến thể</h3>
                                <div class="card-tools">
                                    <a href="javascriptp:;" class="btn btn-block btn-info btn-xs addrow">+</a>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-sm">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select class="form-control" name="color[]">
                                                    @foreach ($color as $data )
                                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control" name="size[]">
                                                    @foreach ($size as $data )
                                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="quantity[]" class="form-control col-3" placeholder="số lượng">
                                            <td>
                                                <a href="javascriptp:;" class="btn btn-block btn-sm btn-danger deleteRow">X</a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
{{-- -------------------------- colum right --}}
                    <div class="col-4">
                        <div class="card col-md-12">
                            <div class="card-header mb-2">
                                <h3 class="card-title">Giá Sản Phẩm</h3>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control @error('price') is-invalid @enderror"
                                    value="{{ old('price') }}" name="price" placeholder="Nhập Giá Sản Phẩm">
                                @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card col-12">
                            <div class="card-header mb-2">
                                <h3 class="card-title">Danh Mục Sản Phẩm</h3>
                            </div>
                            <div class="form-group">
                                {{-- <label for="category_id">Chọn Danh Mục</label> --}}
                                <select class="form-control select2_init @error('category_id') is-invalid @enderror"
                                    name="category_id">
                                    <option value="" selected>Chọn Danh Mục</option>
                                    @foreach ($cate as $key => $data)
                                        @if ($data->parent_id == 0)
                                            <option  value="{{ $data->id }}" disabled>{{ $data->name }}</option>
                                            @foreach ($cate as $key => $parent)
                                                @if ($data->id == $parent->parent_id)
                                                    <option value="{{ $parent->id }}">
                                                        - &nbsp&nbsp&nbsp{{ $parent->name }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach

                                </select>
                                @error('category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <a href="{{ Url('admin/category/add-category') }}" class="card-link mb-2">+ Thêm Danh Mục</a>
                        </div>
                        <div class="card col-12">
                            <div class="card-header mb-2">
                                <h3 class="card-title">Thương Hiệu Sản Phẩm</h3>
                            </div>
                            <div class="form-group">
                                {{-- <label for="category_id">Chọn Danh Mục</label> --}}
                                <select class="form-control select2_init @error('brand_id') is-invalid @enderror"
                                    name="brand_id">
                                    <option value="" selected>Chọn Thương Hiệu</option>
                                    @foreach ($brand as $key => $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach

                                </select>
                                @error('brand_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <a href="{{ Url('admin/brand') }}" class="card-link mb-2">+ Thêm Thương Hiệu</a>
                        </div>
                        <div class="card col-md-12">
                            <div class="card-header mb-2">
                                <h3 class="card-title">Nhập Tags Sản Phẩm</h3>
                            </div>
                            <div class="form-group">
                                {{-- <label for="parent_id">  </label> --}}
                                <select class="form-control tags_select_choose" name="tags[]" multiple="multiple">
                                    @if (!empty($tags))
                                        @foreach ($tags as $key => $data)
                                            <option value="{{ $data->name }}">{{ $data->name }}</option>
                                        @endforeach
                                    @endif

                                </select>
                            </div>
                        </div>
                        <div class="card col-md-12">
                            <div class="card-header mb-2">
                                <h3 class="card-title">Ảnh Chính</h3>
                            </div>
                            <div class="form-group">
                                {{-- <label for="feature_image_path">Ảnh Chính</label> --}}
                                <input type="file" class="form-control-file " id="feature_image_path"
                                    name="feature_image_path">
                            </div>
                        </div>
                        <div class="card col-md-12">
                            <div class="card-header mb-2">
                                <h3 class="card-title">Ảnh chi tiết</h3>
                            </div>
                            <div class="form-group">
                                <input type="file" class="form-control-file" name="image_path[]" multiple>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

        {{-- /.table --}}

    </div>
    <!-- /.content-wrapper -->
@endsection

@section('js')
    <script src="{{ asset('AdminBE/Product/form.js') }}"></script>
    {{-- <script src="{{ asset('AdminBE/Product/addtable.js') }}"></script> --}}

    <script>
        $(document).on('click','.addrow',function(){
            var tr = `<tr>
                        <td>
                            <select class="form-control" name="color[]">
                                @foreach ($color as $data )
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="form-control" name="size[]">
                                @foreach ($size as $data )
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control col-3" name="quantity[]" placeholder="Số Lượng">
                        </td>
                        <td>
                            <a href="javascriptp:;" class="btn btn-block btn-sm btn-danger deleteRow">X</a>
                        </td>
                    </tr>`;
                    $('tbody').append(tr);
        })
        $('tbody').on('click','.deleteRow',function(){
            $(this).parent().parent().remove();
        })

    </script>
@endsection
