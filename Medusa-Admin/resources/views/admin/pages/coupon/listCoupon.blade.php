@extends('admin.layouts.layout')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css" />
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.layouts.content-header', ['name' => 'Coupon', 'key' => 'List'])
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
                            @if (!isset($couponById))
                            <form method="POST" class="" action="{{ Url('admin/product/save-coupon') }}">

                            @else
                            <form method="POST" class="" action="{{ Url('admin/product/update-coupon/'.$couponById->id) }}">
                                    @method('GET')
                            @endif

                                @csrf
                                <div class="form-group ">
                                    <label for="name">Tên</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                         name="name" id="name" value="{{isset($couponById)? $couponById->name : old('name')}}">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="form-group ">
                                    <label for="code">Mã Giảm Giá</label>
                                    <input type="text" class="form-control @error('code') is-invalid @enderror"
                                         name="code" id="code" value="{{isset($couponById)? $couponById->code : old('code')}}">
                                        @error('code')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="condition">Loại Giảm Giá</label>
                                    <select class="form-control" name="condition">
                                        <option value="1" {{ isset($couponById)? $couponById->condition = 1 ? 'selected': '' : old('condition') }} >Giảm theo phần trăm (%)</option>
                                        <option value="2" {{ isset($couponById)? $couponById->condition = 2 ? 'selected': '' : old('condition') }}>Giảm theo số tiền (vnd)</option>
                                      </select>
                                </div>
                                <div class="form-group ">
                                    <label for="quantity">Số Lượng</label>
                                    <input type="text" class="form-control @error('quantity') is-invalid @enderror"
                                         name="quantity" id="quantity" value="{{isset($couponById)? $couponById->quantity : old('quantity')}}">
                                        @error('quantity')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="form-group ">
                                    <label for="number">Số % hoặc số tiền</label>
                                    <input type="text" class="form-control @error('number') is-invalid @enderror"
                                         name="number" id="number" value="{{isset($couponById)? $couponById->number : old('number')}}">
                                        @error('number')
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
                                        <th scope="col">Mã Giảm Giá</th>
                                        <th scope="col">Loại Giảm Giá</th>
                                        <th scope="col">Số Lượng</th>
                                        <th scope="col">Số giảm</th>
                                        <th scope="col">Active
                                            @if (isset($couponById))
                                            <a href="{{ Url('admin/product/coupon') }}"
                                            type="button" data-func="dt-add" class="btn btn-success btn-xs dt-add">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                            @endif
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coupon as $key => $data)
                                    <tr>
                                        <td style="font-weight: 600;" class="text-primary">{{ $data->name }}</td>
                                        <td>{{ $data->code }}</td>
                                        <td>
                                            @if ($data->condition == '1')
                                                Giảm theo %
                                            @else
                                                Giảm theo tiền
                                            @endif
                                        </td>
                                        <td>{{ $data->quantity }}</td>
                                        <td>
                                            @if ($data->condition == '1')
                                                {{ $data->number }} %
                                            @else
                                                {{ number_format($data->number,0, ',', '.') }} vnd
                                            @endif

                                        </td>

                                        <td>
                                            <a class="btn btn-info btn-sm" href="{{ Url('admin/product/edit-coupon/'.$data->id) }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a class="btn btn-danger btn-sm action_Delete" data-url="{{ Url('admin/product/delete-coupon/'.$data->id) }}">
                                                <i class="fas fa-trash"></i>
                                            </a>
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


    {{-- ----------------------------------------------------------- --}}

@endsection
