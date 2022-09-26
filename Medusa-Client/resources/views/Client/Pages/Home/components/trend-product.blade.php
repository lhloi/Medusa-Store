@php
$baseUrl = config('app.base_url');
@endphp
<section class="trend spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Hot Trend</h4>
                    </div>
                    @if (isset($feature))
                    @foreach ($feature as $item)
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="{{ $baseUrl.$item->feature_image_path }}" width="90px" height="90px" alt="">
                        </div>
                        <div class="product__item__text pt-0" style="text-align: left;">
                            <h6><a href="{{ Url('thong-tin-san-pham/'.$item->slug) }}">{{ $item->name }}</a></h6>
                            {{-- <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div> --}}
                            <div class="product__price">{{ number_format($item->price,0,",",".") }}vnd</div>
                        </div>
                    </div>
                    @endforeach

                @endif
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Best seller</h4>
                    </div>
                    @if (isset($seller))
                        @foreach ($seller as $item)
                            <div class="trend__item">
                                <div class="trend__item__pic">
                                    <img src="{{ $baseUrl.$item->product->first()->feature_image_path }}" width="90px" height="90px" alt="">
                                </div>
                                <div class="product__item__text pt-0" style="text-align: left;">
                                    <h6><a href="{{ Url('thong-tin-san-pham/'.$item->product->first()->slug) }}">{{ $item->product->first()->name }}</a></h6>
                                    {{-- <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div> --}}
                                    <div class="product__price">{{ number_format($item->product->first()->price,0,",",".") }}vnd</div>
                                </div>
                            </div>
                        @endforeach

                    @endif

                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="trend__content">
                    <div class="section-title">
                        <h4>Feature</h4>
                    </div>
                    @if (isset($feature))
                        @foreach ($feature as $item)
                        <div class="trend__item">
                            <div class="trend__item__pic">
                                <img src="{{ $baseUrl.$item->feature_image_path }}" width="90px" height="90px" alt="">
                            </div>
                            <div class="product__item__text pt-0" style="text-align: left;">
                                <h6><a href="{{ Url('thong-tin-san-pham/'.$item->slug) }}">{{ $item->name }}</a></h6>
                                {{-- <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div> --}}
                                <div class="product__price">{{ number_format($item->price,0,",",".") }}vnd</div>
                            </div>
                        </div>
                        @endforeach

                    @endif

                    {{-- <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="ashion-master/img/trend/f-2.jpg" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Metallic earrings</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                    <div class="trend__item">
                        <div class="trend__item__pic">
                            <img src="ashion-master/img/trend/f-3.jpg" alt="">
                        </div>
                        <div class="trend__item__text">
                            <h6>Flap cross-body bag</h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>
