@extends('frontend.layout')
@section('title')
    Search
@endsection
@section('content')
<main class="shop">

    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="main-title">
                        Product Result
                    </h3>
                </div>
            </div>
            <div class="row">
                @foreach ($Product as $proVal)
                    <div class="col-3">
                        <figure>
                            <div class="thumbnail">
                                @if ($proVal->quantity == 0)
                                    <div class="status">
                                        Out of Stock
                                    </div>   
                                @else
                                    @if ($proVal->sale_price > 0)
                                        <div class="status">
                                            Promotion
                                        </div>
                                    @endif                                        
                                @endif
                                <a href="product/{{ $proVal->slug }}">
                                    <img src="../../uploads/{{ $proVal->thumbnail }}" alt="">
                                </a>
                            </div>
                            <div class="detail">
                                <div class="price-list">
                                    @if ($proVal->sale_price > 0)
                                        <div class="regular-price "><strike> US {{ $proVal->regular_price }}</strike></div>
                                        <div class="sale-price ">US {{ $proVal->sale_price }}</div>
                                    @else
                                        <div class="price">US {{ $proVal->regular_price }}</div>
                                    @endif
                                </div>
                                <h5 class="title">{{ $proVal->name }}</h5>
                            </div>
                        </figure>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="container">
            <div class="row mt-5">
                <div class="col-12">
                    <h3 class="main-title">
                        News Result
                    </h3>
                </div>
            </div>
            <div class="row">
                @for ($i = 0; $i < 4; $i++)
                    <div class="col-3">
                        <figure>
                            <div class="thumbnail">
                                <a href="">
                                    <img src="https://placehold.co/300x300" alt="">
                                </a>
                            </div>
                            <div class="detail">
                                <h5 class="title">But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born</h5>
                            </div>
                        </figure>
                    </div>
                @endfor
            </div>
        </div>
    </section>

</main>
@endsection