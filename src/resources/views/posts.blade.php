@extends('layouts.app')

@section('content')
    <div class="container">
        @if (isset($categoryRecord))
            <h1>{{ $categoryRecord->category }} Posts</h1>
        @endif

        @forelse($posts as $post)
            <div class="post-container-feed">
                <a href="{{ strtolower(url('/' . str_replace(' ', '-', $post->user->name) . '/' . $post->slug)) }}"
                    class="post-link">
                    <div class="banner-image-container">
                        @if (file_exists(\App\Http\Controllers\PostController::getImagePublicPath($post->banner_image_url)) &&
                                $post->banner_image_url != null)
                            <img src="{{ \App\Http\Controllers\PostController::getImageAssetPath($post->banner_image_url) }}"
                                class="banner-image">
                        @else
                            <img src="{{ asset('pics/banner.jpg') }}" class="banner-image">
                        @endif
                    </div>
                    <div class="post-container-content-feed">
                        <h2>
                            {{ $post->title }} <i class="fas fa-arrow-right" id="arrow"></i>
                        </h2>
                        <p class="post-meta">
                            <i class="fas fa-calendar"></i>
                            {{ date_format($post->created_at, 'm/d/Y') }}
                            <i class="fas fa-user"></i>
                            {{ $post->user->name }}
                            <i class="fas fa-clock"></i>
                            {{ \App\Http\Controllers\PostController::generateReadingTime($post) }} minutes
                            <i class="fas fa-tag"></i>
                            @if (isset($post->category->category))
                                <a href="{{ '/posts/' . $post->category->category }}">{{ $post->category->category }}</a>
                            @else
                                {{ 'Uncategorized' }}
                            @endif
                        </p>
                        <p>
                            <?php $strippedPost = preg_replace("/[^0-9a-zA-Z_.!?' \r\n+]/", '', $post->post); ?>
                            {{ substr($strippedPost, 0, 255) }}
                            ...
                        </p>
                    </div>
                </a>
            </div>
        @empty
            <h2>No posts yet.</h2>
            <p>If you are the owner of this blog, you should <a href="{{ route('create-post') }}">create your first
                    post</a>!</p>
        @endforelse
        <div class="pagination-wrapper">
            {{ $posts->links() }}
        </div>

        <a href="{{ route('posts') }}" class="btn btn-sm btn-primary category-button">All Posts</a>
        @foreach ($categories as $category)
            <a href="/posts/{{ $category->category }}"
                class="btn btn-sm btn-primary category-button">{{ $category->category }}</a>
        @endforeach
    </div>
@endsection
