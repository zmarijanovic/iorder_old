@extends('layouts.master')

@section('title')
@parent
:: Orders
@stop

@section('content')
<h2><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Nalozi</h2>
 @if ($orders->count())
	<table class="table table-condensed table-hover table-striped">
    <thead>
    <tr>
    <th width="5%">Status</th>
    <th width="8%">Datum</th>
    <th width="8%">Broj</th>
    <th width="5%">Tip</th>
    <th width="15%">Transporter</th>
    <th width="30%">Utovar</th>
    <th width="30%">Istovar</th>
    </tr>
    </thead>
	@foreach ($orders as $order)

	<tr>
	<td>{{ $order->status->type }}</td>
	<td>{{ $order->order_date }}</td>
	<th scope="row">{{ link_to("/orders/{$order->id}", Str::upper($order->order_num)) }}</th>
	<td>{{ $order->type->type }}</td>
	<td>{{ isset($order->vehicle->cname) ? $order->vehicle->cname : '<span class="bg-danger">MISSING</span>'  }}</td>
	<?php //        @TODO: nadji bolji nacin da prikazes missing vehicle ?>
	<td>{{ $order->tripstart($order->id)->cname }}</td>
	<td>{{ $order->tripend($order->id)->cname }}</td>
	</tr>
	
	@endforeach

	</table>
	    {{ $orders->links() }}
	@else
	<div class="alert alert-warning" role="alert">
	<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	<strong>Nema rezultata</strong><br>
	Ukoliko ovo nije očekivani ishod vaše pretrage molimo Vas da kontaktirate Administratora</div>
	@endif
@stop
