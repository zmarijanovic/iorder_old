@extends('layouts.master') @section('title') @parent :: Home @stop

@section('content')
<h2><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Korisnici</h2>
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
				<h1 class="panel-title">{{ $user->cname }}</h1>
			</div>
			<div class="panel-body">
				<dl class="dl-horizontal">
					<dt>Kontakt Osoba</dt>
					<dd>{{ Str::title($user->pname) }}</dd>
					<dt>Email</dt>
					<dd>{{ $user->email }}</dd>
					<dt>Telefon</dt>
					<dd>{{ $user->phone }}</dd>
					<dt>Mobitel</dt>
					<dd>{{ $user->mobile }}</dd>
					<dt>Tip</dt>
					<dd>{{-- $user->accessLevels->type --}}</dd>
					
					
				</dl>
{{ dd($user) }}

			</div>
		</div>
	</div>

	<div class="tab-pane" id="edit">
	<div class="row">&nbsp;</div>
			{{ Form::model($user,
		array('route'=>array('users.update', $user->id),'method'=>'PUT','class'=>'form-horizontal form-group-sm','role'=>'form'))
		}}
		<div class="form-group @if ($errors->has('cname')) has-error @endif">
			{{ Form::label('cname', 'Naziv kompanije', array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-4">{{
				Form::text('cname',null,array('class'=>'form-control')) }}</div>
				@if ($errors->has('cname')) <p class="help-block">{{ $errors->first('cname') }}</p>@endif
		</div>
		<div class="form-group">
			{{ Form::label('access_level_fk', 'Tip', array('class'=>'col-sm-2
			control-label')) }} 
			<div class="col-sm-4">
		{{ Form::select('access_level_fk',$level,$user->access_level_fk,array('class'=>'form-control')) }}</div>
		</div>
		<div class="form-group">
			{{ Form::label('pname', 'Kontakt Osoba', array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-4">{{
				Form::text('pname',null,array('class'=>'form-control')) }}</div>
		</div>
		<div class="form-group @if ($errors->has('email')) has-error @endif">
			{{ Form::label('email', 'Email', array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-3">{{ Form::text('email',null,array('class'=>'form-control')) }}</div>
			@if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p>@endif
		</div>
		<div class="form-group">
			{{ Form::label('phone', 'Telefon', array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-3">
		{{ Form::text('phone',null,array('class'=>'form-control')) }}</div>
		</div>
		<div class="form-group">
			{{ Form::label('mobile', 'Mobitel', array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-3">
		{{ Form::text('mobile',null,array('class'=>'form-control')) }}</div>
		</div>
		<div class="form-group">
			{{ Form::label('fax', 'Fax', array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-3">
		 {{ Form::text('fax',null,array('class'=>'form-control')) }}</div>
		</div>
		<div class="form-group @if ($errors->has('street')) has-error @endif">
			{{ Form::label('street', 'Ulica', array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-4">
		 {{ Form::text('street',null,array('class'=>'form-control')) }}</div>
		 @if ($errors->has('street')) <p class="help-block">{{ $errors->first('street') }}</p>@endif
		</div> 
		 <div class="form-group @if ($errors->has('zip')) has-error @endif">
			{{ Form::label('zip', 'Poštanski broj', array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-2">
		 {{ Form::text('zip',null,array('class'=>'form-control')) }}</div>
		 @if ($errors->has('zip')) <p class="help-block">{{ $errors->first('zip') }}</p>@endif
		</div> 
		 <div class="form-group @if ($errors->has('city')) has-error @endif">
			{{ Form::label('city', 'Grad', array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-3">
		 {{ Form::text('city',null,array('class'=>'form-control')) }}</div>
		 @if ($errors->has('city')) <p class="help-block">{{ $errors->first('city') }}</p>@endif
		</div>
		<div class="form-group @if ($errors->has('country')) has-error @endif">
			{{ Form::label('country', 'Država', array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-3">
		 {{ Form::text('country',null,array('class'=>'form-control')) }}</div>
		 @if ($errors->has('country')) <p class="help-block">{{ $errors->first('country') }}</p>@endif
		</div> 
		<div class="form-group @if ($errors->has('web')) has-error @endif">
			{{ Form::label('web', 'Web', array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-4">
		{{ Form::text('web',null,array('class'=>'form-control')) }}</div>
		@if ($errors->has('web')) <p class="help-block">{{ $errors->first('web') }}</p>@endif
		</div> 
		<div class="form-group">
			{{ Form::label('notes', 'Zabilješke', array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-4">
		{{ Form::textarea('notes',null,array('class'=>'form-control','rows'=>'3')) }}</div>
		</div>
		<div class="form-group">
    <div class="col-sm-offset-2 col-sm-5">
      <button type="submit" class="btn btn-default pull-right">Ažuriraj</button>
    </div>
  </div> 
		
		
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

