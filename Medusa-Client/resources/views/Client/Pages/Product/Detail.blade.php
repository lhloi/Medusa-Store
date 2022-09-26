@extends('Client.Layout.layout')
@section('title')
    <title>Home Medusa</title>
@endsection
@section('css')
    <style>
        .nav::before {
            position: absolute;
            left: 0;
            top: 13px;
            height: 1px;
            width: 225px;
            background: #e1e1e1;
            content: "";
        }

        .nav::after {
            position: absolute;
            right: 0;
            top: 13px;
            height: 1px;
            width: 225px;
            background: #e1e1e1;
            content: "";
        }
        .nav-item {
	margin-right: 46px;
}

    </style>
@endsection
@php
 $baseUrl = config('app.base_url');
@endphp
@section('content')
    <!-- Breadcrumb Begin -->
    @include('Client.Pages.Shop.components.breadCrumb',['page'=>$nameCategory->name,'category'=>$productDetail->name])
    <!-- Breadcrumb End -->

 <!-- Product Details Section Begin -->
 <section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__left product__thumb nice-scroll">
                        <a class="pt active" href="#product-1">
                            <img src="{{ $baseUrl.$productDetail->feature_image_path }}" alt="">
                        </a>
                        {{-- <a class="pt" href="#product-2">
                            <img src="img/product/details/thumb-2.jpg" alt="">
                        </a>
                        <a class="pt" href="#product-3">
                            <img src="img/product/details/thumb-3.jpg" alt="">
                        </a>
                        <a class="pt" href="#product-4">
                            <img src="img/product/details/thumb-4.jpg" alt="">
                        </a> --}}
                        @foreach ($imageDetail as $item)
                        <a class="pt" href="#product-{{ $item->id }}">
                            <img src="{{ $baseUrl.$item->image_path }}" alt="">
                        </a>
                        @endforeach
                    </div>
                    <div class="product__details__slider__content">
                        <div class="product__details__pic__slider owl-carousel">
                            <img data-hash="product-1" class="product__big__img" src="{{ $baseUrl.$productDetail->feature_image_path }}" alt="">
                            @foreach ($imageDetail as $item)
                            <img data-hash="product-{{ $item->id }}" class="product__big__img" src="{{ $baseUrl.$item->image_path }}" alt="">

                        @endforeach

                            {{-- <img data-hash="product-2" class="product__big__img" src="img/product/details/product-3.jpg" alt="">
                            <img data-hash="product-3" class="product__big__img" src="img/product/details/product-2.jpg" alt="">
                            <img data-hash="product-4" class="product__big__img" src="img/product/details/product-4.jpg" alt=""> --}}
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ Url('cart/save-cart') }}" method="POST" class="col-lg-6">
                @csrf
                <input type="hidden" name="product_id" value="{{ $productDetail->id }}">
                <div class="product__details__text">
                    <h3>{{ $productDetail->name }} <span>Brand: {{ count($productDetail->brand)>0 ? $productDetail->brand->first()->name : 'Null' }}</span></h3>
                    {{-- <h3>Essential structured blazer </h3> --}}
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <span>( 138 đánh giá )</span>
                    </div>
                    <div class="product__details__price">{{number_format($productDetail->price ) }} vnd</div>
                    {{-- <div class="product__details__price">$ 75.0 <span>$ 83.0</span></div> --}}
                    {{-- <p>Nemo enim ipsam voluptatem quia aspernatur aut odit aut loret fugit, sed quia consequuntur
                    magni lores eos qui ratione voluptatem sequi nesciunt.</p> --}}

                    <div class="product__details__widget">
                        <ul>
                            {{-- <li>
                                <span>Availability:</span>
                                <div class="stock__checkbox">
                                    <label for="stockin">
                                        In Stock
                                        <input type="checkbox" id="stockin">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </li> --}}
                            <li>
                                <span>Màu:</span>
                                <div class="color__checkbox">
                                    @foreach ($productDetail->stock->unique('color_id') as $item)
                                        @foreach ($item->color as $data)
                                            <label for="{{ $data->slug }}">
                                                <input type="radio" name="color" id="{{ $data->slug }}" value="{{ $data->id }}">
                                                <span class="checkmark" style="background: #{{ $data->code_color }};border-style: ridge;" ></span>
                                            </label>
                                        @endforeach

                                    @endforeach
                                </div>
                            </li>
                            <li>
                                <span>Size:</span>
                                <div class="size__btn" id="size__btn">
                                    <div class="size">
                                        @foreach ($productDetail->stock->unique('size_id') as $item)
                                        {{-- @if ($item->color_id =='1') --}}
                                            @foreach ($item->size as $data)
                                                <label for="{{ $data->id }}" >
                                                    <input type="radio" name="size" id="{{ $data->id }}" value="{{ $data->id }}">
                                                    {{  $data->name }}
                                                </label>
                                            @endforeach
                                        {{-- @endif --}}

                                        @endforeach
                                    </div>
                                </div>
                            </li>
                            <li>
                                <span>Shipping:</span>
                                <p>Free shipping</p>
                            </li>
                        </ul>
                    </div>
                    <div class="product__details__button mt-3">
                        <div class="quantity">
                            <span>Số lượng:</span>
                            <div class="pro-qty">
                                <span class="dec qtybtn">-</span>
                                <input type="text" name="quantity" value="1">
                                <span class="inc qtybtn">+</span>

                            </div>
                        </div>
                        <button type="submit" class="cart-btn" style="border:0"><span class="icon_bag_alt"></span> Add to cart</button>
                        <ul>
                            <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                        </ul>
                    </div>
                </div>
            </form>


            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">MÔ TẢ SẢN PHẨM</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">CHI TIẾT SẢN PHẨM</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">ĐÁNH GIÁ SẢN PHẨM</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            {{-- <h6>Nô Tả</h6> --}}
                            {!!  $productDetail->content !!}



                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <h6>Specification</h6>
                            <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed
                                quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt loret.
                                Neque porro lorem quisquam est, qui dolorem ipsum quia dolor si. Nemo enim ipsam
                                voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed quia ipsu
                                consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla
                            consequat massa quis enim.</p>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium
                            quis, sem.</p>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <h6>Reviews ( 2 )</h6>
                            <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed
                                quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt loret.
                                Neque porro lorem quisquam est, qui dolorem ipsum quia dolor si. Nemo enim ipsam
                                voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed quia ipsu
                                consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla
                            consequat massa quis enim.</p>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium
                            quis, sem.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            {{-- @include('Client.Pages.Product.components.relatedProduct') --}}
    </div>
</section>
<!-- Product Details Section End -->
@endsection
@section('js')
{{-- <script src="{{ $baseUrl }}/AdminBE/Layout/tinymce.min.js"></script> --}}
    {{-- <script>
        function ColorBySize(id){

            var size = `  <div class="size">
                                @foreach ($productDetail->stock->where('color_id',6) as $item)
                                    @foreach ($item->size as $data)
                                                <label for="{{ $data->id }}" >
                                                    <input type="radio" id="{{ $data->id }}">
                                                    {{  $data->name }}
                                                </label>
                                    @endforeach
                                @endforeach
                        </div>`;

                $('.size').remove();
                $('.size__btn').append(size);
                // console.log(size);

        }
    </script> --}}

@endsection
