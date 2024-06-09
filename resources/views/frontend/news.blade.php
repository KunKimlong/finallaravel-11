@extends('frontend.layout')
@section('title')
    News Blog
@endsection
@section('content')
    <main class="shop news-blog">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="main-title">
                            NEWS BLOG
                        </h3>
                    </div>
                </div>
                <div class="row">
                    @foreach ($news as $newsVal)
                        <div class="col-3">
                            <figure>
                                <div class="thumbnail">
                                    <a href="/article/{{ $newsVal->slug }}">
                                        <img src="../../uploads/{{ $newsVal->thumbnail }}" alt="">
                                    </a>
                                </div>
                                <div class="detail">
                                    <h5 class="title">{{ $newsVal->title }}</h5>
                                </div>
                            </figure>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@endsection