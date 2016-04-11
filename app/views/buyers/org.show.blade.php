@extends('layouts.master') @section('title') @parent :: Buyers :: {{ $buyer->cname }} @stop

@section('content')
<h2><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Kupci</h2>
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
				<h1 class="panel-title">{{ $buyer->cname }}</h1>
			</div>
			<div class="panel-body">
				<dl class="dl-horizontal">
					<dt>Kontakt Osoba</dt>
					<dd>{{ Str::title($buyer->pname) }}</dd>
					<dt>Email</dt>
					<dd>{{ $buyer->email }}</dd>
					<dt>Telefon</dt>
					<dd>{{ $buyer->phone }}</dd>
					<dt>Mobitel</dt>
					<dd>{{ $buyer->mobile }}</dd>
					<dt>Fax</dt>
					<dd>{{ $buyer->fax }}</dd>
					<dt>Adresa</dt>
					<dd>
						<address>
							{{ Str::title($buyer->street) }}<br>{{
							Str::title($buyer->zip." ".$buyer->city) }} <br>{{
							Str::title($buyer->country) }}
						</address>
					</dd>
					<dt>Web</dt>
					<dd>{{ link_to($buyer->web,$buyer->web) }}</dd>
					<dt>Zabilješke</dt>
					<dd>{{ $buyer->notes }}</dd>
				</dl>

			</div>
		</div>
	</div>

	<div class="tab-pane" id="edit">
	<div class="row">&nbsp;</div>
			{{ Form::model($buyer,
		array('route'=>array('buyers.update', $buyer->id),'method'=>'PUT','class'=>'form-horizontal form-group-sm','role'=>'form'))
		}}
<!-- 	render subview form -->
        @include('layouts.businessform')
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

