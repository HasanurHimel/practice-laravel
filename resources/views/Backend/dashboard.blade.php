@extends('master')



@section('content')


            {{--<div class="alert alert-danger">{{ session('message') }}</div>--}}
    @if(session()->has('message'))
        <div class="alert alert-danger">{{ session('message') }}</div>

    @endif

            @if($user->id ==22)

                <div class="well">
                    <ul>
                        @foreach ($user->unreadnotifications as $notification)
                        <li>{{ $notification->data['userName'] }} is registered now..!!</li>
                            {{ $notification->markAsRead() }}
                            @endforeach
                    </ul>
                </div>

                @endif

        <p>Email : {{ optional($user)->email }}</p>
        <p>Name: {{ $user->userName }}</p>
        <p><img src="{{ url('uploads/', $user->photo) }}" height="80px" width="100px"></p>


    <p>
        <a href="{{ route('categories.index') }}" class="btn btn-info btn-block">Category</a>
    </p>
            <p>
        <a href="{{ route('posts.index') }}" class="btn btn-info btn-block">Posts</a>
    </p>









@endsection