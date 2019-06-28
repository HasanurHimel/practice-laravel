@extends('master')



@section('content')



    <form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
      @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                @if($errors->count()==1)

                    {{ $errors->first() }}
                @else
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                    @endif
            </div>
        @endif

        @if(session()->has('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
            @endif



        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputuserName">User Name</label>
            <input type="text" name="userName" class="form-control" value="{{ old('userName') }}" aria-describedby="emailHelp" placeholder="Enter User name">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" value="{{ old('password') }}" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="exampleInputPhoto">Photo</label>
            <input type="file" name="photo" class="form-control" >
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>




    @endsection