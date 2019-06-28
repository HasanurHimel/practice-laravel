@extends('master')



@section('content')


    @foreach($posts as $post)
        <div class="blog-post">
            <h2 class="blog-post-title">{{ $post->title }}</h2>
            <p class="blog-post-meta">{{ $post->created_at->diffForHumans() }} by <a href="#">{{ $post->user->userName }}</a>
                as <a href="#">{{ $post->category->name }}</a>
            </p>

        </div>
    @endforeach










    @endsection
