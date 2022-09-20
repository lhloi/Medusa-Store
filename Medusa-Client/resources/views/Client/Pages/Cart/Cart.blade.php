@extends('Client.Layout.layout')
@section('title')
    <title>Home Medusa</title>
@endsection
@section('css')
{{-- <link rel="stylesheet" href="{{ asset('client/home/banner.css') }}" type="text/css"> --}}
@endsection
@section('js')

@endsection
@php
 $baseUrl = config('app.base_url');
@endphp
@section('content')

@include('Client.Pages.Shop.components.breadCrumb',['page'=>'Shopping cart'])


    <!-- Shop Cart Section Begin -->
    <section class="shop-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop__cart__table">
                        {{-- {{ Cart::content(); }} --}}
                        <table>
                            <thead>
                                <tr>
                                    <th>Sản Phẩm</th>
                                    <th>Giá</th>
                                    <th>Số Lượng</th>
                                    <th>Tổng</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart_item as $item)
                                <tr>
                                    <td class="cart__product__item">
                                        <img src="{{ $baseUrl.$item->image }}" width="90px" alt="">
                                        <div class="cart__product__item__title">
                                            <h6>{{ $item->name }}</h6>
                                            <div class="rating">
                                                <p>Màu:{{ $item->color }}, Size:{{ $item->size }}</p>
                                            </div>
                                            {{-- <div class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div> --}}
                                        </div>
                                    </td>
                                    <td class="cart__price">{{ number_format($item->price,0,",",".") }}vnd</td>
                                    <td class="cart__quantity">
                                        <div class="pro-qty">
                                            <span class="dec qtybtn"><a href="{{ Url('cart/dec-quantity/'.$item->id) }}">-</a></span>
                                            <input type="text" value="{{ $item->quantity }}">
                                            <span class="inc qtybtn"><a href="{{ Url('cart/inc-quantity/'.$item->id) }}">+</a></span>
                                        </div>
                                    </td>

                                    <td class="cart__total">{{number_format($item->total,0,",",".")  }}vnd</td>
                                    <td class="cart__close"><a href="{{ Url('cart/delete-cart/'.$item->id) }}"><span class="icon_close"></a></span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn">
                        <a href="{{ Url('/danh-sach-san-pham') }}">Continue Shopping</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn update__btn">
                        <a href="#"><span class="icon_loading"></span> Update cart</a>
                    </div>
                </div>
            </div> --}}
            <div class="row">
                <div class="col-lg-6">
                    <div class="discount__content">
                        <h6>Discount codes</h6>
                        <form action="{{ Url('/check-coupon') }}">
                            <input type="text" name="coupon" placeholder="Enter your coupon code">
                            <button type="submit" class="site-btn">Apply</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-2">
                    <div class="cart__total__procced">
                        <h6>Tổng thanh toán</h6>
                        <ul>
                            <li>Tổng tiền hàng <span>{{number_format($subtotal,0,",",".") }} vnd</span></li>
                            <li>Phí vận chuyển <span>{{Cart::subtotal(0,',','.')}} vnd</span></li>
                            @if (Session::get('coupon'))
                                @foreach (Session::get('coupon') as $cou)
                                    @if ($cou['condition'] ==1)
                                        <li> Voucher giảm giá: <span>-{{$cou['number']}}%</span></li>
                                        @php
                                            $subtotal =$subtotal-($subtotal*$cou['number'])/100
                                        @endphp
                                    @elseif($cou['condition'] ==2)
                                        <li> Voucher giảm giá: <span>-{{number_format($cou['number'],0,",",".")}}vnd</span></li>
                                        @php
                                            // $subtotal = $subtotal-$cou['number']
                                            $subtotal = ($subtotal-$cou['number']<0) ? 0 : $subtotal-$cou['number'] ;
                                        @endphp

                                    @endif
                                @endforeach

                            @endif

                            {{-- <li> Voucher giảm giá: <span>{{Cart::subtotal(0,',','.')}} vnd</span></li> --}}

                            <li>Tổng số tiền<span>{{number_format($subtotal,0,",",".") }} vnd</span></li>
                        </ul>
                        <a href="{{ Url('checkout/') }}" class="primary-btn">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Cart Section End -->
    @endsection
