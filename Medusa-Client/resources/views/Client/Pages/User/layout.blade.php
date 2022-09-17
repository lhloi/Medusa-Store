@extends('Client.Layout.layout')
@section('title')
    <title>Home Medusa</title>
@endsection
@php
$baseUrl = config('app.base_url');
@endphp
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
<link rel="stylesheet" href="{{ asset($baseUrl . '/AdminBE/Layout/adminlte.min.css') }}">
<style>
    .title_address{
        display: flex;
        height: 25px;
    }
    .title_address .name{
        color: #000;
        font-weight: 500;
    }
    .post p {
        margin-bottom:0px;
    }
    .title_address span{
        margin-top:-2px;
    }
    .tab-content .tab-pane .cart__product__item__title h6{
        margin-bottom: 0;
    }
    .shop__cart__table tbody tr td{
        padding: 7px 0 !important;
    }
    .shop__cart__table .total{
        color:black;
    }
    .card .shop__cart__table{
        margin-bottom: 0;
    }
    .post {
        padding-bottom: 0;
    }
</style>
@endsection
@section('js')
<script src="{{ asset($baseUrl . '/AdminBE/Layout/adminlte.min.js') }}"></script>
<script src="{{ asset($baseUrl . '/AdminBE/Layout/jquery.min.js') }}"></script>

@endsection

@section('content')
    <!-- Main content -->
    <div class="content" style="padding: 25px 0 60px;background-color: #f4f6f9;">
        <section class="container">
            <div class="container-fluid">
                <div class="row">
                    <!-- /.col -->
                    @include('Client.Pages.User.components.menuProfile')
                    <div class="col-md-9">
                        @yield('profile_card')
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
