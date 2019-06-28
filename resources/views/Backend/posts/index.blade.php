@extends('master')



@section('content')

        @if(session()->has('message'))
            <div class="alert alert-danger">

                {{ session('message') }}
            </div>
            @endif


    <h4 align="center" class="text-success">Your Posts list</h4>
<br>
    <p><a href="{{ route('posts.create') }}" class="btn btn-info">Add Post</a></p>
<div class="well">
    <table class="table table-bordered table-condensec">
        <thead>
        <tr>
            <th>Serial</th>
            <th>Auther</th>
            <th>Category name</th>
            <th>Title</th>
            <th>Photo</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        @php($i='1')
        @foreach($posts as $post)
        <tr>

            <td>{{ $i++ }}</td>
            <td>{{ $post->user->userName }}</td>
            <td>{{ $post->category->name }}</td>
            <td>{{ $post->title }}</td>
            <td><img src="{{ url('uploads/', $post->image_path) }}" height="80px" width="80px"></td>
            <td>{{ $post->status ==1 ? 'Active' : 'InActive'}}</td>
            <td><a href="{{ route('posts.show', $post->id) }}" class="btn btn-success btn-block">Details</a></td>
        </tr>
            @endforeach
        </tbody>
    </table>
    {{ $posts->links() }}
</div>






@endsection