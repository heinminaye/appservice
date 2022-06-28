@extends('components.layout')

@section('content')
<section class="des-body">
    <section class="articles">
        @foreach ($posts as $post)
        <div class="articles-item">
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
                <a href="/details/{{ $post->title }}">
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
                </a>

                <div class="articles-description">
                    {!! Str::words($post->description, '40') !!}
                </div>
            </div>
        </div>
        @endforeach
        {{ $posts->links() }}
    </section>
</section>
@endsection