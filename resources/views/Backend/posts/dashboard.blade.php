@extends('master')



@section('content')


            {{--<div class="alert alert-danger">{{ session('message') }}</div>--}}
    @if(session()->has('message'))
        <div class="alert alert-danger">{{ session('message') }}</div>

    @endif

        <p>Email : {{ optional($user)->email }}</p>
        <p>Name: {{ $user->userName }}</p>
        <p><img src="{{ url('uploads/', $user->photo) }}" height="80px" width="100px"></p>


    <p>
        <a href="{{ route('categories.index') }}" class="btn btn-info btn-block">Category</a>
    </p>









@endsection