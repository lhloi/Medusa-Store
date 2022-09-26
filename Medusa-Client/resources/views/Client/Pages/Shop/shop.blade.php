@extends('Client.Layout.layout')
@section('title')
    <title>Home Medusa</title>
@endsection
@section('css')

@endsection
@section('js')

@endsection
@php
 $baseUrl = config('app.base_url');
 $active = 'shop'
@endphp
@section('content')
    <!-- Breadcrumb Begin -->
    @include('Client.Pages.Shop.components.breadCrumb',['page'=>'Shop'])
    <!-- Breadcrumb End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                @include('Client.Pages.Shop.components.sidebar')
                <div class="col-lg-9 col-md-9">
                    <div class="row">
                        @foreach ($products as $data)
                        <div class="col-lg-4 col-md-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ $baseUrl.$data->feature_image_path }}">
                                    {{-- <div class="label new">New</div> --}}
                                    <ul class="product__hover">
                                        <li><a href="{{ $baseUrl.$data->feature_image_path }}" class="image-popup"><span class="arrow_expand"></span></a></li>
                                        <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                        <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{ Url('thong-tin-san-pham/'.$data->slug) }}">{{ $data->name }}</a></h6>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="product__price">{{number_format($data->price)  }}VND</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                            {{ $products->links('client.Pages.Shop.components.page') }}



                        {{-- <div class="col-lg-12 text-center">
                            <div class="pagination__option">
                                <a href="#">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <a href="#"><i class="fa fa-angle-right"></i></a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->
@endsection
