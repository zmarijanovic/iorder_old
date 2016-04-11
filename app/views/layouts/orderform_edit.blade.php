<?php
use Carbon\Carbon;
//FIXME Naci nacin da se prikupe i posalju array-i svih polja u order.update
//TODO Dodati button za kloniranje reda u formularu
?>
<div class="form-group">
			{{ Form::label('order_type_fk', Lang::get('gui.ordertype'), array('class'=>'col-sm-2 control-label')) }}
			<div class="col-sm-2">
		{{ Form::select('order_type_fk',$order_types,isset($order->order_type_fk) ? $order->order_type_fk : '1',array('class'=>'form-control','required'=>'')) }}
		</div>
		</div>

		<div class="form-group form-group-sm">
        {{ Form::label('order_date', Lang::get('gui.orderdate'), array('class'=>'col-sm-2 control-label')) }}
        <div class="col-sm-2">
            <div class='input-group date' id='oDate'>
                {{ Form::text('order_date', Carbon::parse($order->order_date)->format('d/m/Y') ,array('id'=>'order_date','class'=>'form-control text-uppercase','required'=>'')) }}
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            </div>
            </div>
        </div>
        
        <div class="form-group">
			{{ Form::label('transporter_fk', Lang::get('validation.attributes.transporter_fk'), array('class'=>'col-sm-2 control-label')) }}
			<div class="col-sm-4">
		{{ Form::select('transporter_fk',$transporters,isset($order->vehicle->transporter_fk) ? $order->vehicle->transporter_fk : '1',array('class'=>'form-control','required'=>'')) }}
		</div>
		</div>
		
		<div class="form-group">
		{{ Form::label('vehicletype_fk', Lang::get('gui.type')." ".Lang::get('gui.vehicles'), array('class'=>'col-sm-2 control-label')) }}
			<div class="col-sm-2">
		{{ Form::select('vehicletype_fk',$vehicle_types,isset(Vehicle::find($order->vehicle->id)->type->id) ? Vehicle::find($order->vehicle->id)->type->id : '1',array('class'=>'form-control','required'=>'')) }}
		</div>
		<div class="col-sm-4">
			{{ Form::label('vehicle_fk', Lang::get('gui.vehicle'), array('class'=>'col-sm-4 control-label')) }}
			<div class="col-sm-6">
		{{ Form::select('vehicle_fk',Vehicle::where('transporter_fk',$order->vehicle->transporter_fk)->lists('licenceplate','id'),isset($order->vehicle_fk) ? $order->vehicle_fk : '1',array('class'=>'form-control','required'=>'')) }}
		</div>
		</div>
		</div>
		
		<div class="form-group">
		{{ Form::label('request_num', Lang::get('gui.request_number'), array('class'=>'col-sm-2 control-label')) }}
			<div class="col-sm-2">
		{{ Form::text('request_num',$order->request_num,array('class'=>'form-control col-sm-2')) }}
		</div>
		<div class="col-sm-4">
			{{ Form::label('cmr_num', Lang::get('gui.cmr_number'), array('class'=>'col-sm-4 control-label')) }}
			<div class="col-sm-6">
		{{ Form::text('cmr_num',$order->cmr_num,array('class'=>'form-control')) }}
		</div>
		</div>
		</div>
		
<div class="col-xs-12">
	<div class="panel panel-default">

		<div class="panel-heading" data-toggle="collapse"
			data-target="#transport" style="cursor: pointer;">
			<h3 class="panel-title">{{ Lang::get('gui.transport_details') }}</h3>
		</div>
		<div id="transport" class="panel-body collapse in">
			@if ($order->details->count())
			<table class="table table-condensed table-hover table-striped initialism">
				<thead>
					<tr>
						<th>{{ Lang::get('gui.type') }}</th>
						<th>{{ Lang::get('gui.date')."-".Lang::get('gui.time') }}</th>
						<th>{{ Lang::get('gui.load') }}</th>
						<th>{{ Lang::get('gui.address') }}</th>
						<th></th>
					</tr>
				</thead>
				@foreach ($order->details as $detail)
				<tr>
					<td>
					{{ Form::select('orders_actions_fk['.$detail->id.']',array('1' => 'Utovar', '2' => 'Istovar'),isset($detail->aid) ? $detail->aid : '1',array('class'=>'form-control')) }}
					</td>
					<td class="col-sm-2">
					<div class='input-group date datepicker' id='doDate[]'>
                {{ Form::text('o_datetime['.$detail->id.']', Carbon::parse($detail->o_datetime)->format('d/m/Y H:i:s') ,array('id'=>'o_datetime['.$detail->id.']','class'=>'form-control text-uppercase')) }}
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
            
            </div>
</td>
					<td class="col-sm-4">
					<div class="controls">
		{{ Form::textarea('load['.$detail->id.']',$detail->load,array('class'=>'form-control','rows'=>'3','maxlength'=>'255','style'=>'resize: none;')) }}
		</div></td>
		
					<td class="col-sm-4">
					{{ Form::select('companies_fk['.$detail->id.']',$companies,isset($detail->companies_fk) ? $detail->companies_fk : '1',array('class'=>'form-control')) }}
					</td>
					<td>
					<?php 
					//FIXME Napraviti jscript koji ce obrisati citav red na dugme i zapisati u array $detail->id koji ce se eventualno obrisati iz order_details tabele
					?>
					<button type="button" class="btn btn-xs btn-default command-delete" data-row-id="{{ $detail->id }}" ><span class="glyphicon glyphicon-trash"></span></button>
					</td>
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