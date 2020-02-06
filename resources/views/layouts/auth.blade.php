<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Login - Restorang</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <link href="{{ asset('/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/css/icons.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/css/style.css')}}" rel="stylesheet" type="text/css">
    </head>

    <body>

        <!-- Begin page -->
        <div class="wrapper-page">

            @yield('content')

            <div class="m-t-40 text-center">
                <!-- <p>Don't have an account ? <a href="pages-register.html" class="font-500 font-14 text-primary font-secondary"> Signup Now </a> </p> -->
                <p>© 2019 Restorang. Crafted with <i class="mdi mdi-heart text-danger"></i> by <a href='https://www.facebook.com/ahmadsaugi.gis'>Ahmad Saugi</a></p>
            </div>

        </div>
        

        <!-- jQuery  -->
        <script src="{{ asset('/js/jquery.min.js') }}"></script>
        <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('/js/waves.min.js') }}"></script>

        <script src="{{ asset('/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('/js/app.js') }}"></script>

    </body>
</html>