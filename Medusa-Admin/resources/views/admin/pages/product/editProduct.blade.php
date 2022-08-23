@extends('admin.layouts.layout')

@section('css')
<link href="{{ asset('AdminBE/Product/product.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.content-header',['name'=>'Product','key'=>'add'])
        <!-- /.content-header -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card col-12 ">
                        <div class="card-body col-12">
                            <form method="POST" action="{{ Url('admin/product/update-product/'.$product->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Tên Sản Phẩm</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="" value="{{ $product->name }}" onkeyup="ChangeToSlug()">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug Sản Phẩm</label>
                                    <input type="text" class="form-control" id="slug" name="slug" value="{{ $product->slug }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="price">Giá Sản Phẩm</label>
                                    <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $product->price }}" onkeyup="ChangeToSlug()">
                                    @error('price')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="feature_image_path">Ảnh Chính</label>
                                    <input type="file" class="form-control-file mb-3"  name="feature_image_path">
                                    <img src="{{ $product->feature_image_path }}" width="150px" alt="">
                                </div>
                                <div class="form-group">
                                    <label for="image_path">Ảnh chi tiết</label>
                                    <input type="file" class="form-control-file mb-3" name="image_path[]" multiple>
                                    @foreach($img_path as $key => $data)
                                    <img src="{{ $data->image_path }}" width="150px" alt="">
                                    @endforeach
                                </div>
                                <div class="form-group">
                                    <label for="content">Mô Tả Sản Phẩm</label>
                                    <textarea class="form-control tinymce_edit_init @error('content') is-invalid @enderror"  name="content" rows="10">{{ $product->content }}</textarea>
                                    @error('content')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Chọn Danh Mục</label>
                                    <select class="form-control select2_init @error('category_id') is-invalid @enderror"  name="category_id">
                                        <option value="">Chọn Danh Mục</option>
                                        @foreach ($cate as $key=>$data)
                                            @if ($data->parent_id == 0)
                                                <option value="{{ $data->id }}" {{ $data->id == $product->category_id ? 'selected' : '' }}>{{ $data->name }}</option>
                                                @foreach ($cate as $key=>$parent)
                                                    @if ($data->id == $parent->parent_id)
                                                        <option value="{{ $parent->id }}" {{ $parent->id == $product->category_id ? 'selected' : '' }}>&nbsp&nbsp&nbsp{{ $parent->name }}</option>

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

                                        {{-- @foreach ($tags as $key=>$tag)
                                            @foreach ($product_tags as $item)
                                                @if ($tag->id == $item->tag_id)
                                                    <option value="{{ $tag->name }}" selected >{{ $tag->name }}</option>
                                                @endif
                                            @endforeach

                                            <option value="{{ $tag->name }}" >{{ $tag->name }}</option>

                                        @endforeach --}}
                                        {{-- @foreach ($tags as $key=>$data)
                                            <option value="{{ $data->name }}" selected >{{ $data->name }}</option>
                                        @endforeach --}}
                                        @foreach ($tags as $key => $data)
                                        @if ($data->parent_id == 0)
                                            <option {{ $tagsOfProduct->contains('id',$data->id)? 'selected': '' }}
                                            value="{{ $data->id }}">{{ $data->name }}</option>
                                         @endif
                                    @endforeach
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
