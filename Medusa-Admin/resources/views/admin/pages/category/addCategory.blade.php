@extends('admin.layouts.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.content-header',['name'=>'Category','key'=>'add'])
        <!-- /.content-header -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card col-12 ">
                        <div class="card-body col-6">
                            <form method="POST" action="{{ Url('admin/category/save-category/') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="category">Tên Danh Mục</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nhập tên Danh mục" onkeyup="ChangeToSlug()">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug Danh Mục</label>
                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="parent_id">Chọn Danh Mục Cha</label>
                                    <select class="form-control" id="parent_id" name="parent_id">
                                        <option value="0" selected>Chọn danh mục cha</option>
                                        @foreach ($cate as $key=>$data)
                                            @if ($data->parent_id == 0)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>

                                                {{-- @foreach ($cate as $key=>$parent)
                                                    @if ($data->id == $parent->parent_id)
                                                        <option>&nbsp&nbsp&nbsp{{ $parent->name }}</option>

                                                    @endif
                                                @endforeach --}}
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
