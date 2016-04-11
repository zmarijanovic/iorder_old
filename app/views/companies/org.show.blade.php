@extends('layouts.master') @section('title') @parent :: Companies :: {{ $company->cname }} @stop

@section('content')
<h2><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Kompanije</h2>
<ul class="nav nav-tabs">
	<li role="presentation" class="active"><a href="#info"
		data-toggle="tab">Info</a></li>
	<li role="presentation"><a href="#edit" data-toggle="tab">Ažuriraj</a></li>
</ul>

<div class="tab-content">
	<div class="tab-pane active" id="info">
		<div class="row">&nbsp;</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 class="panel-title">{{ $company->cname }}</h1>
			</div>
			<div class="panel-body">
				<dl class="dl-horizontal">
					<dt>Kontakt Osoba</dt>
					<dd>{{ Str::title($company->pname) }}</dd>
					<dt>Email</dt>
					<dd>{{ $company->email }}</dd>
					<dt>Telefon</dt>
					<dd>{{ $company->phone }}</dd>
					<dt>Mobitel</dt>
					<dd>{{ $company->mobile }}</dd>
					<dt>Fax</dt>
					<dd>{{ $company->fax }}</dd>
					<dt>Adresa</dt>
					<dd>
						<address>
							{{ Str::title($company->street) }}<br>{{
							Str::title($company->zip." ".$company->city) }} <br>{{
							Str::title($company->country) }}
						</address>
					</dd>
					<dt>Web</dt>
					<dd>{{ link_to($company->web,$company->web) }}</dd>
					<dt>Zabilješke</dt>
					<dd>{{ $company->notes }}</dd>
					<dt>Tip</dt>
					<dd>{{ $company->companytype->type }}</dd>
				</dl>

			</div>
		</div>
	</div>

	<div class="tab-pane" id="edit">
	<div class="row">&nbsp;</div>
			{{ Form::model($company,
		array('route'=>array('companies.update', $company->id),'method'=>'PUT','class'=>'form-horizontal form-group-sm','role'=>'form'))
		}}
<!-- 	render subview form -->
        @include('layouts.companyform')
<!-- 	end subview form -->
		
		
		{{ Form::close() }}

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
@stop    

