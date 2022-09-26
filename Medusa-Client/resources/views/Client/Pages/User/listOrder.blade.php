@extends('Client.Pages.User.layout')

@section('profile_card')
    <div class="card">
        <div class="card-header p-2">
            <ul class="nav nav-pills text-center row">
                <li class="nav-item col">
                    <a class="nav-link active" href="#activity" data-toggle="tab">Tất cả</a>
                </li>
                <li class="nav-item col">
                    <a class="nav-link" href="#waitconfirmation" data-toggle="tab">Chờ xác nhận</a>
                </li>
                <li class="nav-item col">
                    <a class="nav-link" href="#waitinggoods" data-toggle="tab">Chờ lấy hàng</a>
                </li>
                <li class="nav-item col">
                    <a class="nav-link" href="#delivering" data-toggle="tab">Đang giao</a>
                </li>
                <li class="nav-item col">
                    <a class="nav-link" href="#delivered" data-toggle="tab">Đã giao</a>
                </li>
                <li class="nav-item col">
                    <a class="nav-link" href="#cancelled" data-toggle="tab">Đã hủy</a>
                </li>
            </ul>
        </div><!-- /.card-header -->
    </div>

    <div class="tab-content">
        <div class="active tab-pane" id="activity">
            <!-- Post -->
            @php
                $quantityCount = 0;
                $baseUrl = config('app.base_url');
            @endphp
            @foreach ($order as $data)
            <div class="post card">
                {{-- <div class="user-block">
                        <img class="img-circle img-bordered-sm"
                            src="../../dist/img/user1-128x128.jpg" alt="user image">
                        <span class="username">
                            <a href="#">Jonathan Burke Jr.</a>
                            <a href="#" class="float-right btn-tool"><i
                                    class="fas fa-times"></i></a>
                        </span>
                        <span class="description">Shared publicly - 7:30 PM today</span>
                    </div> --}}
                <!-- /.user-block -->
                <div class="shop__cart__table card-body">
                        <table>
                            <tbody>
                                @foreach ($data->order_item as $item)
                                    <tr class="float-left">
                                        <td class="cart__product__item">
                                            <img src="{{ $baseUrl . $item->product->first()->feature_image_path }}"
                                                width="90px" alt="">
                                            <div class="cart__product__item__title">
                                                <h6>{{ $item->name }}</h6>
                                                <div class="rating">
                                                    <p>Màu:{{ $item->color }}, Size:{{ $item->size }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="cart__price">{{ number_format($item->price, 0, ',', '.') }}vnd
                                        </td>
                                        <td class="cart__quantity">
                                            x{{ $item->quantity }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-2 row">
                            <div class="total col-10">Tổng thanh toán :<span>{{  number_format($data->total,0,",",".")  }} vnd</span> <span style="opacity: 0.7;font-style: italic;">({{ date_format($data->created_at , 'd/m/Y') }})</span></div>
                            <div class="col-2">
                                {{-- <button type="button" disabled class="btn btn-outline-danger btn-sm"> --}}

                                    @php switch ($data->status) {
                                        case '1':
                                            echo('<button class="btn btn-outline-warning btn-sm" disabled>Chờ xác nhận</button>');
                                            echo('<a href="purchase-destroy/'.$data->id.'" class="btn btn-outline-danger btn-sm mt-1">hủy</a>');
                                            break;
                                        case '2':
                                            echo('<button class="btn btn-outline-warning btn-sm" disabled>Chờ lấy hàng</button>');
                                            break;
                                        case '3':
                                            echo('<button class="btn btn-outline-info btn-sm" disabled>Đang giao</button>');
                                            break;
                                        case '4':
                                            echo('<button class="btn btn-outline-success  btn-sm" disabled>Đã giao</button>');
                                            break;
                                        case '5':
                                            echo('<button class="btn btn-outline-danger btn-sm" disabled>Đã hủy</button>');
                                            break;
                                        default:
                                            # code...
                                            break;
                                    }@endphp
                                {{-- </button> --}}
                            </div>
                        </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="waitconfirmation">
            <!-- Post -->
            @php
                $quantityCount = 0;
                $baseUrl = config('app.base_url');
            @endphp
            @foreach ($order as $data)
            @if ($data->status == '1')
                <div class="post card">
                    {{-- <div class="user-block">
                            <img class="img-circle img-bordered-sm"
                                src="../../dist/img/user1-128x128.jpg" alt="user image">
                            <span class="username">
                                <a href="#">Jonathan Burke Jr.</a>
                                <a href="#" class="float-right btn-tool"><i
                                        class="fas fa-times"></i></a>
                            </span>
                            <span class="description">Shared publicly - 7:30 PM today</span>
                        </div> --}}
                    <!-- /.user-block -->
                    <div class="shop__cart__table card-body">
                            <table>
                                <tbody>
                                    @foreach ($data->order_item as $item)
                                        <tr class="float-left">
                                            <td class="cart__product__item">
                                                <img src="{{ $baseUrl . $item->product->first()->feature_image_path }}"
                                                    width="90px" alt="">
                                                <div class="cart__product__item__title">
                                                    <h6>{{ $item->name }}</h6>
                                                    <div class="rating">
                                                        <p>Màu:{{ $item->color }}, Size:{{ $item->size }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart__price">{{ number_format($item->price, 0, ',', '.') }}vnd
                                            </td>
                                            <td class="cart__quantity">
                                                x{{ $item->quantity }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-2 row">
                                <div class="total col-10">Tổng thanh toán :<span>{{  number_format($data->total,0,",",".")  }} vnd</span></div>
                                <div class="col-2">
                                    <button type="button" disabled class="btn btn-outline-danger btn-sm">Chờ xác nhận </button>
                                </div>
                            </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
        <div class="tab-pane" id="waitinggoods">
            <!-- Post -->
            @php
                $quantityCount = 0;
                $baseUrl = config('app.base_url');
            @endphp
            @foreach ($order as $data)
            @if ($data->status == '2')
                <div class="post card">
                    {{-- <div class="user-block">
                            <img class="img-circle img-bordered-sm"
                                src="../../dist/img/user1-128x128.jpg" alt="user image">
                            <span class="username">
                                <a href="#">Jonathan Burke Jr.</a>
                                <a href="#" class="float-right btn-tool"><i
                                        class="fas fa-times"></i></a>
                            </span>
                            <span class="description">Shared publicly - 7:30 PM today</span>
                        </div> --}}
                    <!-- /.user-block -->
                    <div class="shop__cart__table card-body">
                            <table>
                                <tbody>
                                    @foreach ($data->order_item as $item)
                                        <tr class="float-left">
                                            <td class="cart__product__item">
                                                <img src="{{ $baseUrl . $item->product->first()->feature_image_path }}"
                                                    width="90px" alt="">
                                                <div class="cart__product__item__title">
                                                    <h6>{{ $item->name }}</h6>
                                                    <div class="rating">
                                                        <p>Màu:{{ $item->color }}, Size:{{ $item->size }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart__price">{{ number_format($item->price, 0, ',', '.') }}vnd
                                            </td>
                                            <td class="cart__quantity">
                                                x{{ $item->quantity }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-2 row">
                                <div class="total col-10">Tổng thanh toán :<span>{{  number_format($data->total,0,",",".")  }} vnd</span></div>
                                <div class="col-2">
                                    <button type="button" disabled class="btn btn-outline-danger btn-sm">Chờ lấy hàng</button>
                                </div>
                            </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
        <div class="tab-pane" id="delivering">
            <!-- Post -->
            @php
                $quantityCount = 0;
                $baseUrl = config('app.base_url');
            @endphp
            @foreach ($order as $data)
            @if ($data->status == '3')
                <div class="post card">
                    {{-- <div class="user-block">
                            <img class="img-circle img-bordered-sm"
                                src="../../dist/img/user1-128x128.jpg" alt="user image">
                            <span class="username">
                                <a href="#">Jonathan Burke Jr.</a>
                                <a href="#" class="float-right btn-tool"><i
                                        class="fas fa-times"></i></a>
                            </span>
                            <span class="description">Shared publicly - 7:30 PM today</span>
                        </div> --}}
                    <!-- /.user-block -->
                    <div class="shop__cart__table card-body">
                            <table>
                                <tbody>
                                    @foreach ($data->order_item as $item)
                                        <tr class="float-left">
                                            <td class="cart__product__item">
                                                <img src="{{ $baseUrl . $item->product->first()->feature_image_path }}"
                                                    width="90px" alt="">
                                                <div class="cart__product__item__title">
                                                    <h6>{{ $item->name }}</h6>
                                                    <div class="rating">
                                                        <p>Màu:{{ $item->color }}, Size:{{ $item->size }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart__price">{{ number_format($item->price, 0, ',', '.') }}vnd
                                            </td>
                                            <td class="cart__quantity">
                                                x{{ $item->quantity }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-2 row">
                                <div class="total col-10">Tổng thanh toán :<span>{{  number_format($data->total,0,",",".")  }} vnd</span></div>
                                <div class="col-2">
                                    <button type="button" disabled class="btn btn-outline-danger btn-sm">Đang giao hàng</button>
                                </div>
                            </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
        <div class="tab-pane" id="delivered">
            <!-- Post -->
            @php
                $quantityCount = 0;
                $baseUrl = config('app.base_url');
            @endphp
            @foreach ($order as $data)
            @if ($data->status == '4')
                <div class="post card">
                    {{-- <div class="user-block">
                            <img class="img-circle img-bordered-sm"
                                src="../../dist/img/user1-128x128.jpg" alt="user image">
                            <span class="username">
                                <a href="#">Jonathan Burke Jr.</a>
                                <a href="#" class="float-right btn-tool"><i
                                        class="fas fa-times"></i></a>
                            </span>
                            <span class="description">Shared publicly - 7:30 PM today</span>
                        </div> --}}
                    <!-- /.user-block -->
                    <div class="shop__cart__table card-body">
                            <table>
                                <tbody>
                                    @foreach ($data->order_item as $item)
                                        <tr class="float-left">
                                            <td class="cart__product__item">
                                                <img src="{{ $baseUrl . $item->product->first()->feature_image_path }}"
                                                    width="90px" alt="">
                                                <div class="cart__product__item__title">
                                                    <h6>{{ $item->name }}</h6>
                                                    <div class="rating">
                                                        <p>Màu:{{ $item->color }}, Size:{{ $item->size }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart__price">{{ number_format($item->price, 0, ',', '.') }}vnd
                                            </td>
                                            <td class="cart__quantity">
                                                x{{ $item->quantity }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-2 row">
                                <div class="total col-10">Tổng thanh toán :<span>{{  number_format($data->total,0,",",".")  }} vnd</span></div>
                                <div class="col-2">
                                    <button type="button" disabled class="btn btn-outline-danger btn-sm">Đã giao hàng</button>
                                </div>
                            </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
        <div class="tab-pane" id="cancelled">
            <!-- Post -->
            @php
                $quantityCount = 0;
                $baseUrl = config('app.base_url');
            @endphp
            @foreach ($order as $data)
            @if ($data->status == '5')
                <div class="post card">
                    {{-- <div class="user-block">
                            <img class="img-circle img-bordered-sm"
                                src="../../dist/img/user1-128x128.jpg" alt="user image">
                            <span class="username">
                                <a href="#">Jonathan Burke Jr.</a>
                                <a href="#" class="float-right btn-tool"><i
                                        class="fas fa-times"></i></a>
                            </span>
                            <span class="description">Shared publicly - 7:30 PM today</span>
                        </div> --}}
                    <!-- /.user-block -->
                    <div class="shop__cart__table card-body">
                            <table>
                                <tbody>
                                    @foreach ($data->order_item as $item)
                                        <tr class="float-left">
                                            <td class="cart__product__item">
                                                <img src="{{ $baseUrl . $item->product->first()->feature_image_path }}"
                                                    width="90px" alt="">
                                                <div class="cart__product__item__title">
                                                    <h6>{{ $item->name }}</h6>
                                                    <div class="rating">
                                                        <p>Màu:{{ $item->color }}, Size:{{ $item->size }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart__price">{{ number_format($item->price, 0, ',', '.') }}vnd
                                            </td>
                                            <td class="cart__quantity">
                                                x{{ $item->quantity }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-2 row">
                                <div class="total col-10">Tổng thanh toán :<span>{{  number_format($data->total,0,",",".")  }} vnd</span></div>
                                <div class="col-2">
                                    <button type="button" disabled class="btn btn-outline-danger btn-sm">Đã hủy</button>
                                </div>
                            </div>
                    </div>
                </div>
                {{-- @else
                    <div class="donthave">

                        <img src="{{ asset('storage/images/logo/notepad.png') }}" alt="">
                        <p>Chưa có đơn hàng</p>
                    </div> --}}
                @endif
            @endforeach
        </div>
    </div>
@endsection
