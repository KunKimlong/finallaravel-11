@extends('frontend.layout')
@section('title')
    Home
@endsection
@section('content')
    <main class="home">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="main-title">
                            NEW PRODUCTS
                        </h3>
                    </div>
                </div>
                <div class="row">
                    @foreach ($newProducts as $newProductVal)
                        <div class="col-3">
                            <figure>
                                <div class="thumbnail">
                                    @if ($newProductVal->quantity == 0)
                                        <div class="status">
                                            Out of Stock
                                        </div>   
                                    @else
                                        @if ($newProductVal->sale_price > 0)
                                            <div class="status">
                                                Promotion
                                            </div>
                                        @endif                                        
                                    @endif
                                    <a href="product/{{ $newProductVal->slug }}">
                                        <img src="../../uploads/{{ $newProductVal->thumbnail }}" alt="">
                                    </a>
                                </div>
                                <div class="detail">
                                    <div class="price-list">
                                        @if ($newProductVal->sale_price > 0)
                                            <div class="regular-price "><strike> US {{ $newProductVal->regular_price }}</strike></div>
                                            <div class="sale-price ">US {{ $newProductVal->sale_price }}</div>
                                        @else
                                            <div class="price">US {{ $newProductVal->regular_price }}</div>
                                        @endif
                                    </div>
                                    <h5 class="title">{{ $newProductVal->name }}</h5>
                                </div>
                            </figure>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="main-title">
                            PROMOTION PRODUCTS
                        </h3>
                    </div>
                </div>
                <div class="row">
                    @foreach ($promoProducts as $promoProductVal)
                        <div class="col-3">
                            <figure>
                                <div class="thumbnail">
                                    <div class="status">
                                        Promotion
                                    </div>
                                    <a href="">
                                        <img src="../../uploads/{{ $promoProductVal->thumbnail }}" alt="">
                                    </a>
                                </div>
                                <div class="detail">
                                    <div class="price-list">
                                        <div class="regular-price "><strike> US {{ $newProductVal->regular_price }}</strike></div>
                                        <div class="sale-price ">US {{ $newProductVal->sale_price }}</div>
                                    </div>
                                    <h5 class="title">{{ $newProductVal->name }}</h5>
                                </div>
                            </figure>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>  

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="main-title">
                            POPULAR PRODUCTS
                        </h3>
                    </div>
                </div>
                <div class="row">
                    @foreach ($popularProducts as $popularProductVal)
                        <div class="col-3">
                            <figure>
                                <div class="thumbnail">
                                    @if ($popularProductVal->sale_price > 0)
                                        <div class="status">
                                            Promotion
                                        </div>
                                    @endif
                                    <a href="product/{{ $popularProductVal->slug }}">
                                        <img src="../../uploads/{{ $popularProductVal->thumbnail }}" alt="">
                                    </a>
                                </div>
                                <div class="detail">
                                    <div class="price-list">
                                        @if ($popularProductVal->sale_price > 0)
                                            <div class="regular-price "><strike> US {{ $popularProductVal->regular_price }}</strike></div>
                                            <div class="sale-price ">US {{ $popularProductVal->sale_price }}</div>
                                        @else
                                            <div class="price">US {{ $popularProductVal->regular_price }}</div>
                                        @endif
                                    </div>
                                    <h5 class="title">{{ $popularProductVal->name }}</h5>
                                </div>
                            </figure>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

    </main>  
@endsection
