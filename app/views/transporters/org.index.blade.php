@extends('layouts.master')

@section('title')
@parent
:: Transporters
@stop

@section('content')
<h2><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Transporteri</h2>
 @if ($transporters->count())
	<table class="table table-condensed table-hover">

	@foreach ($transporters as $transporter)

	<tr><td>{{ link_to("/transporters/{$transporter->id}", Str::upper($transporter->cname)) }}</td></tr>
	
	@endforeach

	</table>
	    {{ $transporters->links() }}
	@else
	<div class="alert alert-warning" role="alert">
	<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	<strong>Nema rezultata</strong><br>
	Ukoliko ovo nije očekivani ishod vaše pretrage molimo Vas da kontaktirate Administratora</div>
	@endif
@stop
