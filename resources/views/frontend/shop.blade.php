@extends('frontend.layout')
@section('title')
    Shop
@endsection
@section('content')
<main class="shop">
    <section>
        <div class="container">
            <div class="row">
                <div class="col-9">
                    <div class="row">   
                        @foreach ($products as $proVal)
                            <div class="col-4">
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
                        
                        <div class="col-12">
                            <ul class="pagination">
                                @for ($i = 1; $i <= $page; $i++)
                                    <li>
                                        <a href="/shop?page={{$i}}">{{$i}}</a>
                                    </li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-3 filter">
                    <h4 class="title">Category</h4>
                    <ul>
                        <li>
                            <a href="/shop">ALL</a>
                        </li>
                        @foreach ($category as $cateVal)
                            <li>
                                <a href="/shop?category={{ $cateVal->slug }}">{{ $cateVal->name }}</a>
                            </li> 
                        @endforeach
                    </ul>
                    
                    <h4 class="title mt-4">Price</h4>
                    <div class="block-price mt-4">
                        <a href="/shop?price=max">High</a>
                        <a href="/shop?price=min">Low</a>
                    </div>

                    <h4 class="title mt-4">Promotion</h4>
                    <div class="block-price mt-4">
                        <a href="/shop?promotion=true">Promotion Product</a>
                    </div>

                </div>
            </div>
        </div>
    </section>

</main>
@endsection