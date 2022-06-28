@extends('components.layout')
@section('detail')
<section class="des-body-detail">
    <section class="detail-articles">
        @foreach ($posts as $post)
        <div class="articles-item-one">
            <a class="back-btn" href="/"><img src="/images/arrow.png" alt=""></a>
            @auth
            <div class="edit-del-btn">
                <button class="edit-delete">
                    <img src="/images/three_dots.png" alt="">
                </button>
                <div class="com-btn">
                    <a class="delete-post" href="/deletePost/{{ $post->id }}">
                        Remove
                    </a>
                    <a class="delete-post" href="/editPost/{{ $post->id }}">
                        Edit
                    </a>
                </div>
            </div>
            @endauth
            <div class="articles-screen">
                <div class="articles-des-title">
                    {{ $post->title }}
                </div>
                <div class="articles-subtitle">
                    <span class="subtitle-article">
                        {{ strtoupper($post->category_name) }}
                    </span>
                    <span>
                        {{ $post->created_at->format('M d, Y') }}
                    </span>
                </div>

                <div class="articles-description">
                    {!! $post->description !!}
                </div>
            </div>
        </div>
        @endforeach
    </section>
</section>
@endsection