@extends('master')



@section('content')
    <h3 class="text-success">Create your Category</h3>

    <br>

    @if(session()->has('message'))
        <div class="alert alert-danger">{{ session('message') }}</div>
        @endif

    @if ($errors->any())

        @if($errors->count() ==1)

            <div class="alert alert-danger">{{ $errors->first() }}</div>

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


    <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
       @csrf

        <div class="form-group">
            <label for="exampleInputName">Category name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputStatus">Status</label>

                <div class="radio">
                    <input type="radio" class="radio" name="status"  value="1"> Published
                    <input type="radio" class="radio" name="status"  value="0"> UnPublished
                </div>

        </div>

        <button type="submit" class="btn btn-primary btn-block">Submit</button>
        <br>
    </form>
    <br>
    <a href="{{ route('categories.index') }}" class="btn btn-info btn-block">Category list</a>




@endsection