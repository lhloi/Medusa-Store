@extends('Client.Layout.layout')
@section('title')
    <title>Home Medusa</title>
@endsection
@section('css')
    <style>
        .checkout{
            background-color:#f4f6f9 ;
        }
        .card-header{
            background-color:white !important ;
        }
        .checkout__order{
            background-color:white !important ;
        }
        input.discount {
            height: 35px;
            /* width: 70%; */
            border: 1px solid #444444;
            border-radius: 50px;
            padding-left: 20px;
            padding-right: 20px;
            font-size: 14px;
            color: #444444;
        }
        .btn-discount{
            font-size: 14px;
            color: #ffffff;
            background: #ca1515;
            font-weight: 600;
            border: none;
            text-transform: uppercase;
            display: inline-block;
            padding: 6px 0;
            border-radius: 50px;
        }
        /* .total{
            border: 0;
            float: right;
            color: #ca1515;
            text-align: right;
            font-weight: 600;

        } */
    </style>
    {{-- <link rel="stylesheet" href="{{ asset('client/home/banner.css') }}" type="text/css"> --}}
@endsection
@section('js')
@endsection
@php
$baseUrl = config('app.base_url');
@endphp
@section('content')
    {{-- @include('Client.Pages.Shop.components.breadCrumb', ['page' => 'Shopping cart']) --}}
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            {{-- <div class="row">
                <div class="col-lg-12">
                    <h6 class="coupon__link"><span class="icon_tag_alt"></span> <a href="#">Have a coupon?</a> Click
                        here to enter your code.</h6>
                </div>
            </div> --}}
            <form action="{{ Url('order/place') }}" method="POST" class="checkout__form">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        {{-- <h5>Billing detail</h5> --}}
                        <div class="row">
                            <div class="checkout__order">
                                <h5>
                                    Thông tin giao hàng
                                </h5>
                                {{-- <div class="card-header">

                                </div> --}}
                                @if (!isset($address))
                                    <div class="card-body row">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="checkout__form__input">
                                                <p>Họ Và Tên <span>*</span></p>
                                                <input type="text">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="checkout__form__input">
                                                <p>Số Điện Thoại <span>*</span></p>
                                                <input type="text">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                                {{-- <div class="checkout__form__input col-md-4">
                                                <p>Country <span>*</span></p>
                                                <input type="text">
                                            </div>
                                            <div class="checkout__form__input col-md-4">
                                                <p>Country <span>*</span></p>
                                                <input type="text">
                                            </div>
                                            <div class="checkout__form__input col-md-4">
                                                <p>Country <span>*</span></p>
                                                <input type="text">
                                            </div> --}}
                                            <div class="checkout__form__input">
                                                <p>Address <span>*</span></p>
                                                <input type="text" placeholder="Street Address">
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <p><strong>{{ $address->name.' '. $address->phone}}</strong> <br> {{ $address->address.', '. $address->district.', '. $address->conscious.', '. $address->city}}</p>
                                @endif


                            </div>

                            <div class="checkout__order mt-3">
                                <div class="shop__cart__table">
                                    {{-- {{ Cart::content(); }} --}}
                                    <table>
                                        <tbody>
                                            @php
                                                $quantityCount = 0;
                                                $shipping = 0;
                                            @endphp
                                            @foreach ($cart_item as $item)
                                            <tr>
                                                <td class="cart__product__item">
                                                    <img src="{{ $baseUrl.$item->image }}" width="90px" alt="">
                                                    <div class="cart__product__item__title">
                                                        <h6>{{ $item->name }}</h6>
                                                        <div class="rating">
                                                            <p>Màu:{{ $item->color }}, Size:{{ $item->size }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="cart__price">{{ number_format($item->price,0,",",".") }}vnd</td>
                                                <td class="cart__quantity">{{ $item->quantity }}</td>
                                                @php
                                                    $quantityCount += $item->quantity
                                                @endphp
                                                <td class="cart__total">{{number_format($item->total,0,",",".")  }}vnd</td>
                                            </tr>
                                            @endforeach

                                        </tbody>

                                    </table>
                                    <div class="form-group pt-3 row">
                                        <p class="col-md-2">Lời Nhắn <span>*</span></p>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="note">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                            <div class="checkout__order">
                                <h5>Phương thức thanh toán</h5>
                            <div class="checkout__order__product">
                                <ul>
                                    <li>
                                        {{-- <i class='fa fa-money' style="font: 15px"></i> --}}
                                         <label for="1">Thanh toán khi nhận hàng</label>
                                         <span><input class="form-check-input" type="radio" name="pay" value="1" id="1" checked></span>
                                    </li>
                                    <li>
                                        {{-- <i class="fa fa-credit-card-alt" aria-hidden="true"></i> --}}
                                        <label for="2">Thẻ tín dụng/ Ghi </label>
                                        <span><input class="form-check-input" type="radio" name="pay" value="2" id="2"></span></span>
                                    </li>
                                    <li>
                                        <label for="3">Ví Zalo Pay </label>
                                        <span><input class="form-check-input" type="radio" name="pay" value="3" id="3"></span></span>
                                    </li>
                                    <li>
                                        <label for="4">Ví Momo </label>
                                        <span><input class="form-check-input" type="radio" name="pay" value="4" id="4"></span></span>
                                    </li>

                                </ul>
                            </div>
                            {{-- <div class="discount pt-3">
                                <form action="{{ Url('/check-coupon') }}" method="POST" class="row">
                                    <input type="text" class="discount col-8" name="coupon" placeholder="Enter your coupon code">
                                    <button type="submit" class="col-3 btn-discount">Apply</button>
                                </form>
                            </div> --}}
                            <div class="checkout__order__total">
                                <ul>
                                    <li>Tạm tính ({{ $quantityCount }}) <span>{{  number_format($subtotal,0,",",".")  }} vnd</span></li>
                                    <li>Phí vận chuyển
                                        <span>
                                            @if ($shipping == 0)Free @else {{ $shipping }} @endif
                                        </span>
                                    </li>
                                    @php
                                        $total = $subtotal+$shipping;
                                    @endphp
                                    @if (Session::get('coupon'))
                                    @foreach (Session::get('coupon') as $cou)
                                        @if ($cou['condition'] ==1)
                                            <li> Voucher giảm giá: <span>-{{$cou['number']}}%</span></li>
                                            @php
                                                $total =$total-($total*$cou['number'])/100
                                            @endphp
                                        @elseif($cou['condition'] ==2)
                                            <li> Voucher giảm giá: <span>-{{number_format($cou['number'],0,",",".")}}vnd</span></li>
                                            @php
                                                // $subtotal = $subtotal-$cou['number']
                                                $total = ($total-$cou['number']<0) ? 0 : $total-$cou['number'] ;
                                            @endphp

                                        @endif
                                    @endforeach

                                @endif

                                    <li>Tổng thanh toán: <span>{{number_format($total,0,",",".")}}vnd</span></li>
                                    <input type="hidden" value="{{$total}}" name="total">
                                </ul>
                            </div>
                            <button type="submit" class="site-btn">Place oder</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection
