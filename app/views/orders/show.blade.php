@extends('layouts.master') 
@section('title') 
@parent :: {{ Lang::get('gui.orders') }} 
@stop 
@section('content')
<h2><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> {{ Lang::get('gui.orders') }}</h2>

<div class="panel panel-default">
	
	<div class="panel-heading"><h4 class="panel-title"><strong>{{ Lang::get('gui.order') }} : {{ $order->order_num }}</strong></h4></div>
	<div class="panel-body">
<!-- 	render subview form -->
        @include('layouts.orderform_show')
<!-- 	end subview form -->
	</div>
</div>

@stop
@section('extrascripts')
{{ HTML::script('js/moment.min.js') }}
{{ HTML::script('js/moment.locale.bs.js') }}
@stop