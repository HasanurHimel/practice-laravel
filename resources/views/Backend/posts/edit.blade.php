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


    <form action="{{ route('posts.update', $posts->id) }}" method="post" enctype="multipart/form-data" id="select_category">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="exampleInputName">Category name</label>


            <select class="form-control" name="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>


        </div>

        <div class="form-group">
            <label for="exampleInputTitle">Post Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') ?? $posts->title}}" aria-describedby="emailHelp" placeholder="Post title">
        </div>
        <div class="form-group">
            <label for="exampleInputTitle">Post Content</label>
            <textarea name="longText" class="form-control" placeholder="post content">{{ $posts->content }}</textarea>
        </div>

        <div class="form-group">
            <label for="exampleInputTitle">Photo</label>
            <div><img src="{{ url('uploads', $posts->image_path) }}" alt="" height="80px" width="80px"></div>
            <input type="file" name="photo" class="form-control"aria-describedby="emailHelp" >
        </div>

        <div class="form-group">
            <label for="exampleInputStatus">Status</label>

            <div class="radio">
                <input type="radio" {{ $posts->status ==1 ?'checked' :'' }} class="radio" name="status"  value="1"> Published
                <input type="radio" {{ $posts->status ==0 ?'checked' :'' }} class="radio" name="status"  value="0"> UnPublished
            </div>

        </div>

        <button type="submit" class="btn btn-primary btn-block">Submit</button>
        <br>

    </form>
    <a href="{{ route('posts.show', $posts->id) }}" class="btn btn-info btn-block">Details</a>


    <a href="{{ route('posts.index') }}" class="btn btn-info btn-block">Category list</a>

    <script>
        document.forms['select_category'].elements['category_id'].value='{{ $posts->category_id }}'

    </script>


@endsection
