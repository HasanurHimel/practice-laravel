@extends('master')

@section('content')



    <div class="container">
        <div class="row">
            <div class="card col-md-11">
                <div class="card-header">
                    <h3 align="center" class="text-success">{{ $posts->title }}</h3>
                </div>
                <div class="card-body">
                    <p>Id : {{ $posts->id }}</p>
                    <p>Auther : {{ $posts->user->userName }}</p>
                    <p>Category name : {{ $posts->category->name }}</p>
                    <p>Post Title : {{ $posts->title }}</p>
                    <p>Post Content : {{ $posts->content }}</p>
                    <p>Photo : <img src="{{ url('uploads', $posts->image_path) }}" alt="" height="80px" width="280px"></p>
                    <p>Status : {{ $posts->status ==1? 'Active' :'InActive' }}</p>


                </div>
                <a href="{{ route('posts.edit', $posts->id) }}" class="btn btn-info btn-block">Edit</a>

                <br>

                <form action="{{ route('posts.destroy', $posts->id) }}" method="post" >
                   @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-block" onclick="return  confirm('Are you sure to Delete ?')">Delete</button>
                </form>


                <br>

                <a href="{{ route('posts.index') }}" class="btn btn-info btn-block">Posts list</a>

            </div>
        </div>
    </div>



    @endsection