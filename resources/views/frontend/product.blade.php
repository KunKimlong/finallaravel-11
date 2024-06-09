@extends('frontend.layout')
@section('title')
    Product Detail
@endsection
@section('content')
<main class="product-detail">

    <section class="review">
        <div class="container">
            <div class="row">
                <div class="col-5">
                    <div class="thumbnail">
                        @if ($ProductDetail[0]->quantity == 0)
                            <div class="stock-status">
                                Out of Stock
                            </div>   
                        @else
                            @if ($ProductDetail[0]->sale_price > 0)
                                <div class="stock-status">
                                    Promotion
                                </div>
                            @endif                                        
                        @endif
                        <img src="../../uploads/{{ $ProductDetail[0]->thumbnail }}" alt="">
                    </div>
                </div>
                <div class="col-7">
                    <div class="detail">
                        <div class="price-list">
                            @if ($ProductDetail[0]->sale_price > 0)
                                <div class="regular-price "><strike> US {{ $ProductDetail[0]->regular_price }}</strike></div>
                                <div class="sale-price ">US {{ $ProductDetail[0]->sale_price }}</div>
                            @else
                                <div class="price">US {{ $ProductDetail[0]->regular_price }}</div>
                            @endif
                        </div>
                        <h5 class="title">{{ $ProductDetail[0]->name }}</h5>
                        <div class="group-size">
                            <span class="title">Color Available</span>
                            <div class="group">
                                {{ $ProductDetail[0]->attribute_color }}
                            </div>
                        </div>
                        <div class="group-size">
                            <span class="title">Size Available</span>
                            <div class="group">
                                {{ $ProductDetail[0]->attribute_size }}
                            </div>
                        </div>
                        <div class="group-size">
                            <span class="title">Description</span>
                            <div class="description">
                                {{ $ProductDetail[0]->description }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="main-title">
                        RELATED PRODUCTS
                    </h3>
                </div>
            </div>
            <div class="row">
                @foreach ($relatedPro as $relatedProVal)
                    <div class="col-3">
                        <figure>
                            <div class="thumbnail">
                                @if ($relatedProVal->sale_price > 0)
                                    <div class="status">
                                        Promotion
                                    </div>
                                @endif
                                <a href="/product/{{ $relatedProVal->slug }}">
                                    <img src="../../uploads/{{ $relatedProVal->thumbnail }}" alt="">
                                </a>
                            </div>
                            <div class="detail">
                                <div class="price-list">
                                    @if ($relatedProVal->sale_price > 0)
                                        <div class="regular-price "><strike> US {{ $relatedProVal->regular_price }}</strike></div>
                                        <div class="sale-price ">US {{ $relatedProVal->sale_price }}</div>
                                    @else
                                        <div class="price">US {{ $relatedProVal->regular_price }}</div>
                                    @endif
                                </div>
                                <h5 class="title">{{ $relatedProVal->name }}</h5>
                            </div>
                        </figure>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

</main>
@endsection