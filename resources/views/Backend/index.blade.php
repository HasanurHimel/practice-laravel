@extends('master')



@section('content')

        @if(session()->has('message'))
            <div class="alert alert-danger">

                {{ session('message') }}
            </div>
            @endif


    <h4 align="center" class="text-success">Your Category list</h4>
<br>
    <p><a href="{{ route('categories.create') }}" class="btn btn-info">Add Category</a></p>
<div class="well">
    <table class="table table-bordered table-condensec">
        <thead>
        <tr>
            <th>Serial</th>
            <th>Category Name</th>
            <th>Slug</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        @php($i='1')
        @foreach($categories as $category)
        <tr>

            <td>{{ $i++ }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->slug }}</td>
            <td>{{ $category->status ==1 ? 'Active' : 'InActive'}}</td>
            <td><a href="{{ route('categories.show', $category->id) }}" class="btn btn-success btn-block">Details</a></td>
        </tr>
            @endforeach
        </tbody>
    </table>
    {{ $categories->links() }}
</div>






@endsection