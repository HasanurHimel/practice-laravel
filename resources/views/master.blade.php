
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="https://getbootstrap.com/favicon.ico">

    <title>Blog Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/blog.css') }}">
</head>

<body>

<div class="container" id="app">

    @include('partials.Header')


    @includeWhen(request()->is('/'), 'partials.jumbtrom')








    <main role="main" class="container">
        <div class="row">

            <div class="col-md-8 blog-main">






                @yield('content')








            </div><!-- /.blog-main -->






        @include('partials.sideber')





        <!-- /.blog-sidebar -->

        </div><!-- /.row -->

    </main><!-- /.container -->




    @include('partials.footer')





</div>

<script src="{{ mix('js/app.js') }}"></script>
<script>
    Echo.Private('post.created')
        .listen('CreateEvent', (e) => {
            $.notify({
                // options
                message: e.post.title +'has been published now'
            },{
                // settings
                type: 'success'
            });

        });
</script>

</body>
</html>
