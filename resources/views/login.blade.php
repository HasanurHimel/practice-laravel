@extends('master')



@section('content')
    <h3 class="text-success">If you have already registered so, Please Login</h3>

    <br>


    <form action="{{ route('login') }}" method="post" enctype="multipart/form-data">
        @csrf

        @if(session()->has('message'))
            <div class="alert alert-danger">{{ session('message') }}</div>
            @endif


        @if ($errors->any())
            @if($errors->count()==1)
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @else

            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>
        @endif
        @endif



        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" value="{{ old('password') }}" placeholder="Password">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>




@endsection
