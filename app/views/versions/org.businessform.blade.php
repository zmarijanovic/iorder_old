<div class="form-group @if ($errors->has('cname')) has-error @endif">
			{{ Form::label('cname', 'Naziv kompanije', array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-4">{{
				Form::text('cname',null,array('class'=>'form-control')) }}</div>
				@if ($errors->has('cname')) <p class="help-block">{{ $errors->first('cname') }}</p>@endif
		</div>
		
		<!-- FormExtra -->
            @yield('formextra')
		
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
		<div class="form-group">
			{{ Form::label('street', 'Ulica', array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-4">
		 {{ Form::text('street',null,array('class'=>'form-control')) }}</div>
		 </div> 
		 <div class="form-group">
			{{ Form::label('zip', 'Poštanski broj', array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-2">
		 {{ Form::text('zip',null,array('class'=>'form-control')) }}</div>
		</div> 
		 <div class="form-group">
			{{ Form::label('city', 'Grad', array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-3">
		 {{ Form::text('city',null,array('class'=>'form-control')) }}</div>
		 </div>
		<div class="form-group">
			{{ Form::label('country', 'Država', array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-3">
		 {{ Form::text('country',null,array('class'=>'form-control')) }}</div>
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
      <button type="submit" class="btn btn-default pull-right">Sačuvaj</button>
    </div>
  </div> 