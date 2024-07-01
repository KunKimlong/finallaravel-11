@extends('frontend.master')
@section('title')
    Product | Detail
@endsection
@section('content')
<main class="product-detail">

    <section class="review">
        <div class="container">
            <div class="row">
                <div class="col-5">
                    <div class="thumbnail">
                        <img src="{{url('uploads/'.$product->thumbnail)}}" width="450" height="500" alt="">
                    </div>
                </div>
                <div class="col-7">
                    <div class="detail">
                        <div class="price-list">
                            @if ($product->sale_price == $product->regular_price)
                                <div class="price">US {{$product->regular_price}}</div>
                            @else
                                <div class="regular-price"><strike> US {{$product->regular_price}}</strike></div>
                                <div class="sale-price">US {{$product->sale_price}}</div>
                            @endif


                        </div>
                        <h5 class="title">{{$product->name}}</h5>
                        <div class="group-size">
                            <span class="title">Color Available</span>
                            <div class="group">
                                {{$product->color}}
                            </div>
                        </div>
                        <div class="group-size">
                            <span class="title">Size Available</span>
                            <div class="group">
                                {{$product->size}}
                            </div>
                        </div>
                        <div class="group-size">
                            <span class="title">Description</span>
                            <div class="description">
                                {{$product->description}}
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
                @foreach ($related_product as $item)
                <div class="col-3">
                    <figure>
                        <div class="thumbnail">
                            @if ($item->sale_price != $item->regular_price)
                                <div class="status">
                                    Promotion
                                </div>
                                @endif
                            <a href="/product/{{$item->id}}">
                                <img src="{{url('uploads/'.$item->thumbnail)}}" width="450" height="500" alt="">
                            </a>
                        </div>
                        <div class="detail">
                            <div class="price-list">
                                @if ($item->sale_price == $item->regular_price)
                                <div class="price">US {{$item->regular_price}}</div>
                                @else
                                    <div class="regular-price"><strike> US {{$item->regular_price}}</strike></div>
                                    <div class="sale-price">US {{$item->sale_price}}</div>
                                @endif
                            </div>
                            <h5 class="title">{{$item->name}}</h5>
                        </div>
                    </figure>
                </div>
            @endforeach
            </div>
        </div>
    </section>

</main>

@endsection
