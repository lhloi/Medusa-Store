@extends('admin.layouts.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.content-header',['name'=>'Menu','key'=>'add'])
        <!-- /.content-header -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card col-12 ">
                        <div class="card-body col-6">
                            <form method="POST" action="{{ Url('admin/menu/update-menu/'.$data->id) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Tên Danh Mục</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $data->name }}" onkeyup="ChangeToSlug()">
                                    @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug Menu</label>
                                    <input type="text" class="form-control" id="slug" name="slug" value="{{ $data->slug }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="parent_id">Chọn Menu Cha</label>
                                    <select class="form-control" id="parent_id" name="parent_id">
                                        <option value="0" selected>Chọn menu cha</option>
                                        @foreach ($menu as $key=>$value)
                                            @if ($value->parent_id == 0)
                                                <option value="{{ $value->id }}" {{ $value->id == $data->parent_id? "selected" : ""}}>{{ $value->name }}</option>
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
