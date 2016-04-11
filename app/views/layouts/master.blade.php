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
        {{ HTML::style('css/bootstrap.css') }}
        {{ HTML::style('css/bootstrap-theme.css') }}
        {{ HTML::style('css/jquery.bootgrid.min.css') }}
        {{ HTML::style('css/themes/icon.css') }}

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
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="{{{ URL::to('') }}}">iOrder</a>
                </div>
                <!-- Everything you want hidden at 940px or less, place within here -->
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                   
                   <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Lang::get('gui.orders') }}<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
<li><a href="{{{ URL::action('OrdersController@orderList') }}}"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> {{ Lang::get('gui.list') }}</a></li>
<li class="divider"></li>
            <li><a href="{{{ URL::to('/orders/create') }}}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> {{ Lang::get('gui.add_new_entry') }}</a></li>
          </ul>
        </li>
                   
                        
                        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Lang::get('gui.companies') }}<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{{ URL::to('/companies/') }}}"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> {{ Lang::get('gui.list') }}</a></li>
            <li class="divider"></li>
            <li><a href="{{{ URL::action('CompaniesController@indexSuppliers') }}}"><span class="glyphicon glyphicon-th" aria-hidden="true"></span> {{ Lang::get('gui.suppliers') }}</a></li>
            <li class="divider"></li>
            <li><a href="{{{ URL::action('CompaniesController@indexClients') }}}"><span class="glyphicon glyphicon-th" aria-hidden="true"></span> {{ Lang::get('gui.clients') }}</a></li>
            <li class="divider"></li>
            <li><a href="{{{ URL::action('CompaniesController@indexContacts') }}}"><span class="glyphicon glyphicon-th" aria-hidden="true"></span> {{ Lang::get('gui.contacts') }}</a></li>
             <li class="divider"></li>
            <li><a href="{{{ URL::to('/companies/create') }}}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> {{ Lang::get('gui.add_new_entry') }}</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Lang::get('gui.buyers') }}<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{{ URL::to('/buyers/') }}}"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> {{ Lang::get('gui.list') }}</a></li>
            <li class="divider"></li>
            <li><a href="{{{ URL::to('/buyers/create') }}}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> {{ Lang::get('gui.add_new_entry') }}</a></li>
          </ul>
        </li>
                        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Lang::get('gui.transporters') }}<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{{ URL::to('/transporters/') }}}"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> {{ Lang::get('gui.list') }}</a></li>
            <li class="divider"></li>
            <li><a href="{{{ URL::to('/transporters/create') }}}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> {{ Lang::get('gui.add_new_entry') }}</a></li>
          </ul>
        </li>
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Lang::get('gui.reports') }}<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{{ URL::action('StandardReportController@indexTransporter') }}}"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> {{ Lang::get('gui.transporters') }}</a></li>
<!--             <li class="divider"></li> -->
           
          </ul>
        </li>
        
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Lang::get('gui.users') }}<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="{{{ URL::to('/users/') }}}"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> {{ Lang::get('gui.list') }}</a></li>
            <li class="divider"></li>
            <li><a href="{{{ URL::to('/users/create') }}}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> {{ Lang::get('gui.add_new_entry') }}</a></li>
          </ul>
        </li>
        
        
                    </ul> 
                </div>
            </div>
        </div> 

        <!-- Container -->
        <div class="container">

            <!-- Content -->
            @yield('content')

        </div>

        <!-- Scripts are placed here -->
        {{ HTML::script('js/jquery-1.11.1.min.js') }}
        {{ HTML::script('js/bootstrap.js') }}
        {{ HTML::script('js/jquery.bootgrid.min.js') }}
        {{ HTML::script('js/jquery.steps.min.js') }}
        
        <!-- Extra Scripts -->
        @yield('extrascripts')
        
    </body>
</html>