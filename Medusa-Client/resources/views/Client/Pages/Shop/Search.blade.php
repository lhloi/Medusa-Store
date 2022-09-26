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
@endphp
@section('content')
    <!-- Breadcrumb Begin -->
    @include('Client.Pages.Shop.components.breadCrumb',['page'=>'Shop','category'=>'Search'])
    <!-- Breadcrumb End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                @include('Client.Pages.Shop.components.sidebar')
                <div class="col-lg-9 col-md-9">
                    <div class="Search mb-3"> <i class="fa fa-info-circle" aria-setsize="15px"></i> Kết quả tìm kiếm cho từ khoá 'asdas'</div>
                    <div class="row">
                        @foreach ($search_product as $data)
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
                        {{ $search_product->links('client.Pages.Shop.components.page') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->
@endsection
