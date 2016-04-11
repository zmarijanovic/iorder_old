<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
        <title>
            @section('title')
            iOrder - ASA ŠPED
            @show
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- CSS are placed here -->
        {{-- HTML::style('css/bootstrap.css') --}}
        {{-- HTML::style('css/bootstrap-theme.css') --}}
        {{-- HTML::style('css/jquery.bootgrid.min.css') --}}
        {{-- HTML::style('css/themes/icon.css') --}}

        <style>
        @section('styles')
            body {
                padding-top: 70px;
            }
        @show
        </style>
    </head>

    <body>
        <!-- Navbar -->
       

        <!-- Container -->
        <div class="container">

            <!-- Content -->
            @yield('content')

        </div>

       
    </body>
</html>