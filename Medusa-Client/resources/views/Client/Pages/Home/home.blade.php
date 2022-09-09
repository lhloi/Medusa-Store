@extends('Client.Layout.layout')
@section('title')
    <title>Home Medusa</title>
@endsection
@section('css')
<link rel="stylesheet" href="client/home/banner.css" type="text/css">
@endsection
@section('js')

@endsection
@php
 $baseUrl = config('app.base_url');
@endphp
@section('content')

    <!-- Banner Section Begin -->
    @include('Client.Pages.Home.components.banner')
    <!-- Banner Section End -->

    <!-- Product Section Begin -->
    @include('Client.Pages.Home.components.product')
    <!-- Product Section End -->

    <!-- Categories Section Begin -->
    @include('Client.Pages.Home.components.categories')

    <!-- Categories Section End -->

    <!-- Trend Section Begin -->
    @include('Client.Pages.Home.components.trend-product')
    <!-- Trend Section End -->


    <!-- Discount Section Begin -->
    {{-- <section class="discount">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <div class="discount__pic">
                        <img src="ashion-master/img/discount.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="discount__text">
                        <div class="discount__text__title">
                            <span>Discount</span>
                            <h2>Summer 2019</h2>
                            <h5><span>Sale</span> 50%</h5>
                        </div>
                        <div class="discount__countdown" id="countdown-time">
                            <div class="countdown__item">
                                <span>22</span>
                                <p>Days</p>
                            </div>
                            <div class="countdown__item">
                                <span>18</span>
                                <p>Hour</p>
                            </div>
                            <div class="countdown__item">
                                <span>46</span>
                                <p>Min</p>
                            </div>
                            <div class="countdown__item">
                                <span>05</span>
                                <p>Sec</p>
                            </div>
                        </div>
                        <a href="#">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Discount Section End -->


    <!-- Services Section Begin -->
    @include('Client.Pages.Home.components.services')
    <!-- Services Section End -->






@endsection
