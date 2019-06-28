@extends('master')



@section('content')


@if(session()->has('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

  @if($errors->any())
      @if($errors->count()==1)
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



<div class="container">
    <div class="row">
        <div class="card col-md-12">
            <div class="card-header">
                <h3 class="text-success">Create your Posts</h3>
            </div>
                <div class="card-content">

                    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <br>
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
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" aria-describedby="emailHelp" placeholder="Post title">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputTitle">Post Content</label>
                            <textarea name="longText" class="form-control" placeholder="post content"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputTitle">Photo</label>
                            <input type="file" name="photo" class="form-control"aria-describedby="emailHelp" >
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
                </div>

        </div>
    </div>
</div>


    <br>
    <a href="{{ route('posts.index') }}" class="btn btn-info btn-block">Posts list</a>




@endsection