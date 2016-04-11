@extends('layouts.master') @section('title') @parent :: Transporters ::
{{ $transporter->cname }} @stop @section('content')
<h2>
	<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
	Transporteri
</h2>
<ul class="nav nav-tabs">
	<li role="presentation" class="active"><a href="#info"
		data-toggle="tab">Info</a></li>
	<li role="presentation"><a href="#edit" data-toggle="tab">Ažuriraj</a></li>
	<li role="presentation"><a href="#vehicles" data-toggle="tab">Vozila</a></li>
</ul>

<div class="tab-content">
	<div class="tab-pane active" id="info">
		<div class="row">&nbsp;</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 class="panel-title">{{ $transporter->cname }}</h1>
			</div>
			<div class="panel-body">
				<dl class="dl-horizontal">
					<dt>Kontakt Osoba</dt>
					<dd>{{ Str::title($transporter->pname) }}</dd>
					<dt>Email</dt>
					<dd>{{ $transporter->email }}</dd>
					<dt>Telefon</dt>
					<dd>{{ $transporter->phone }}</dd>
					<dt>Mobitel</dt>
					<dd>{{ $transporter->mobile }}</dd>
					<dt>Fax</dt>
					<dd>{{ $transporter->fax }}</dd>
					<dt>Adresa</dt>
					<dd>
						<address>
							{{ Str::title($transporter->street) }}<br>{{
							Str::title($transporter->zip." ".$transporter->city) }} <br>{{
							Str::title($transporter->country) }}
						</address>
					</dd>
					<dt>Web</dt>
					<dd>{{ link_to($transporter->web,$transporter->web) }}</dd>
					<dt>Zabilješke</dt>
					<dd>{{ $transporter->notes }}</dd>
				</dl>

			</div>
		</div>
	</div>

	<div class="tab-pane" id="edit">
		<div class="row">&nbsp;</div>
		{{ Form::model($transporter,
		array('route'=>array('transporters.update',
		$transporter->id),'method'=>'PUT','class'=>'form-horizontal
		form-group-sm','role'=>'form')) }}
<!-- 	render subview form -->
        @include('layouts.businessform')
<!-- 	end subview form -->


		{{ Form::close() }}

	</div>


	<div class="tab-pane" id="vehicles">
		<div class="row">&nbsp;</div>
		<h4 class="text-right">
			<a
				href="{{ URL::action('VehiclesController@create',array($transporter->id)) }}"><span
				class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
				Dodaj novi unos</a>
		</h4>
		<div class="panel panel-default">



			@if ($transporter->vehicles->count())
			<table class="table table-condensed table-hover table-striped">
				<thead>
					<tr>
						<th>Registracija</th>
						<th>Tip Vozila</th>
						<th>Aktivno</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($transporter->vehicles as $vehicle)

					<tr>
						<td>{{ link_to("/vehicles/{$vehicle->id}",
							Str::upper($vehicle->licenceplate)) }}</td>
						<td>{{ Str::upper($vehicle->type) }}</td>
						<td>@if ($vehicle->active==1) <span
							class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
							@else <span class="glyphicon glyphicon-ban-circle"
							aria-hidden="true" style="color: lightgrey"></span> @endif
						</td>
					</tr>

					@endforeach
				</tbody>
			</table>
			@else
			<div class="alert alert-warning" role="alert">
				<span class="glyphicon glyphicon-exclamation-sign"
					aria-hidden="true"></span> <strong>Nema rezultata</strong><br>
				Ukoliko ovo nije očekivani ishod vaše pretrage molimo Vas da
				kontaktirate Administratora
			</div>
			@endif
		</div>
	</div>


</div>

@stop 
@section('extrascripts') 

@if(count($errors)>0)

<script>
    $(window).load(function () {
        $('.nav-tabs a[href="#edit"]').tab('show')
    });
    </script>
@endif

@if(Input::has('pane'))
<script>
    $(window).load(function () {
        $('.nav-tabs a[href="#vehicles"]').tab('show')
    });
    </script>
@endif 
@stop

