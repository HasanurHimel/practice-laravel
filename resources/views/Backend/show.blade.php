@extends('master')

@section('content')



    <div class="container">
        <div class="row">
            <div class="card col-md-12">
                <div class="card-header">
                    <h3 align="center" class="text-success">{{ $category->name }}</h3>
                </div>
                <div class="card-body">
                    <p> Id : {{ $category->id }}</p>
                    <p> Name : {{ $category->name }}</p>
                    <p> Slug : {{ $category->slug }}</p>
                    <p> Status : {{ $category->status ==1? 'Active' :'InActive' }}</p>



                </div>
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info btn-block">Edit</a>

                <br>

                <form action="{{ route('categories.delete', $category->id) }}" method="post" >
                   @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-block" onclick="return  confirm('Are you sure to Delete ?')">Delete</button>
                </form>


                <br>

                <a href="{{ route('categories.index') }}" class="btn btn-info btn-block">Category list</a>



                <br>



                 <br>

            </div>
        </div>
    </div>
    @if($category->posts->count())

        <h4 class="text-success">Post Under "{{ $category->name }}" Category :</h4>

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
            @foreach($category->posts as $post)
                <tr>

                    <td>{{ $i++ }}</td>
                    <td>{{ $post->user->userName }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $post->title }}</td>
                    <td><img src="{{ url('uploads/', $post->photo) }}" height="80px" width="80px"></td>
                    <td>{{ $post->status ==1 ? 'Active' : 'InActive'}}</td>
                    <td><a href="{{ route('posts.show', $post->id) }}" class="btn btn-success btn-block">Details</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>



    @endif



    @endsection