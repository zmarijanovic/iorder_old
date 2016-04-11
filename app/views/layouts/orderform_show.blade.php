<?php
use Carbon\Carbon;
?>
<dl class="dl-horizontal col-xs-12 col-md-8">
	<dt>{{ Lang::get('gui.ordertype') }}:</dt>
	<dd>{{ $order->type->type }}</dd>
	<dt>{{ Lang::get('gui.orderdate') }}:</dt>
	<dd>{{ Carbon::parse($order->order_date)->format('d/m/Y') }}</dd>
	<dt>{{ Lang::get('validation.attributes.transporter_fk') }}:</dt>
	<dd>
		<kbd>{{ $order->vehicle->cname }}</kbd>
	</dd>
	<dt>{{ Lang::get('gui.type') }}:</dt>
	<dd>{{ Vehicle::find($order->vehicle->id)->type->type }}</dd>
	<dt>{{ Lang::get('gui.vehicle') }}:</dt>
	<dd>{{ $order->vehicle->licenceplate }}</dd>
	<dt></dt>
	<dt>{{ Lang::get('gui.request_number') }}:</dt>
	<dd>{{ $order->request_num }}</dd>
	<dt>{{ Lang::get('gui.cmr_number') }}:</dt>
	<dd>{{ $order->cmr_num }}</dd>
</dl>
<div class="col-xs-6 col-md-4 text-right">
<a
		href="{{{ URL::to('/orders/pdf/'.$order->id) }}}" role="button"
		class="btn btn-default"> <span class="glyphicon glyphicon-print"
		aria-hidden="true"></span> {{ Lang::get('gui.submit_print') }}
	</a>
</div>
<div class="col-xs-12">
	<div class="panel panel-default">

		<div class="panel-heading" data-toggle="collapse"
			data-target="#transport" style="cursor: pointer;">
			<h3 class="panel-title">{{ Lang::get('gui.transport_details') }}</h3>
		</div>
		<div id="transport" class="panel-body collapse in">
			@if ($order->details->count())
			<table
				class="table table-condensed table-hover table-striped initialism">
				<thead>
					<tr>
						<th>{{ Lang::get('gui.type') }}</th>
						<th>{{ Lang::get('gui.date') }}/{{ Lang::get('gui.time') }}</th>
						<th>{{ Lang::get('gui.load') }}</th>
						<th>{{ Lang::get('gui.address') }}</th>
					</tr>
				</thead>
				@foreach ($order->details as $detail)
				<tr>
					<td>{{ $detail->type }}</td>
					<td>{{ Carbon::parse($detail->odate)->format('d/m/Y') }} {{ Carbon::parse($detail->otime)->format('H:i') }}</td>
					<td>{{ $detail->load }}</td>
					<td><strong>{{ $detail->cname }}</strong><br><address>{{ Str::title($detail->street) }}<br>{{ Str::title($detail->zip." ".$detail->city) }} <br>{{ Str::title($detail->country) }}	</address></td>
				</tr>
				@endforeach
			</table>
			@else
			<div class="alert alert-warning" role="alert">
				<span class="glyphicon glyphicon-exclamation-sign"
					aria-hidden="true"></span> <strong>{{ Lang::get('gui.no_results') }}</strong><br> {{ Lang::get('gui.contact_admin') }}
			</div>
			@endif
		</div>
	</div>

	<div class="panel panel-default">

		<div class="panel-heading" data-toggle="collapse"
			data-target="#customs" style="cursor: pointer;">
			<h3 class="panel-title">{{ Lang::get('gui.customs_related') }} {{	Lang::get('gui.details') }}</h3>
		</div>
		<div id="customs" class="panel-body collapse out">
			@if ($order->customs->count())
			<table
				class="table table-condensed table-hover table-striped initialism">
				<thead>
					<tr>
						<th>{{ Lang::get('validation.attributes.customs_type_fk') }}</th>
						<th>{{ Lang::get('validation.attributes.customs_city_fk') }}</th>
						<th>{{ Lang::get('validation.attributes.customs_agents_fk') }}</th>
					</tr>
				</thead>
				@foreach ($order->customs as $customs)
				<tr>
					<td>{{ CustomsType::find($customs->customs_type_fk)->type }}</td>
					<td>{{ CustomsCity::find($customs->customs_city_fk)->city }}</td>
					<td>{{ CustomsAgent::find($customs->customs_agents_fk)->cname }}</td>
				</tr>
				@endforeach
			</table>
			@else
			<div class="alert alert-warning" role="alert">
				<span class="glyphicon glyphicon-exclamation-sign"
					aria-hidden="true"></span> <strong>{{ Lang::get('gui.no_results') }}</strong><br> {{ Lang::get('gui.contact_admin') }}
			</div>
			@endif
		</div>
	</div>
	
	<!-- 	Only priviledged users should see this -->
	<div class="panel panel-default">

		<div class="panel-heading" data-toggle="collapse"
			data-target="#invoice" style="cursor: pointer;">
			<h3 class="panel-title">{{ Lang::get('gui.buyers') }}</h3>
		</div>
		<div id="invoice" class="panel-body collapse out">
			@if ($order->invoices->count())
			<table
				class="table table-condensed table-hover table-striped initialism">
				<thead>
					<tr>
						<th>{{ Lang::get('gui.buyer') }}</th>
						<th>{{ Lang::get('gui.entry') }} {{ Lang::get('gui.invoice') }}</th>
						<th>{{ Lang::get('gui.entry') }} {{ Lang::get('gui.price') }}</th>
						<th>{{ Lang::get('gui.exit') }} {{ Lang::get('gui.invoice') }}</th>
						<th>{{ Lang::get('gui.exit') }} {{ Lang::get('gui.price') }}</th>
						
					</tr>
				</thead>
				@foreach ($order->invoices as $buyer)
				<tr>
					<td><strong>{{ $buyer->cname }}</strong><br>
					<address>{{ Str::title($buyer->street) }}<br>{{ Str::title($buyer->zip." ".$buyer->city) }} <br>{{ Str::title($buyer->country) }}
		</address></td>
					<td>{{ $buyer->pinvoice }}</td>
					<td>{{ $buyer->pinvoice_amount }}</td>
					<td>{{ $buyer->sinvoice }}</td>
					<td>{{ $buyer->sinvoice_amount }}</td>
				</tr>
				@endforeach
			</table>
			@else
			<div class="alert alert-warning" role="alert">
				<span class="glyphicon glyphicon-exclamation-sign"
					aria-hidden="true"></span> <strong>{{ Lang::get('gui.no_results') }}</strong><br> {{ Lang::get('gui.contact_admin') }}
			</div>
			@endif
		</div>
	</div>

	@if ($order->notes)
	<div class="panel panel-default">

		<div class="panel-heading" data-toggle="collapse" data-target="#notes"	style="cursor: pointer;">
			<h3 class="panel-title">{{ Lang::get('validation.attributes.notes') }}</h3>
		</div>
		<div id="notes" class="panel-body collapse out">{{ $order->notes }}</div>

	</div>
	@endif

</div>