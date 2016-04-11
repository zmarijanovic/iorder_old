<div class="form-group @if ($errors->has('cname')) has-error @endif">
			{{ Form::label('cname', Lang::get('validation.attributes.cname'), array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-4">{{
				Form::text('cname',null,array('class'=>'form-control','required'=>'')) }}</div>
				@if ($errors->has('cname')) <p class="help-block">{{ $errors->first('cname') }}</p>@endif
		</div>
		
		<!-- FormExtra -->
            @yield('formextra')
		
		<div class="form-group">
			{{ Form::label('pname', Lang::get('validation.attributes.pname'), array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-4">{{
				Form::text('pname',null,array('class'=>'form-control')) }}</div>
		</div>
		<div class="form-group @if ($errors->has('email')) has-error @endif">
			{{ Form::label('email', Lang::get('validation.attributes.email'), array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-3">{{ Form::email('email',null,array('class'=>'form-control')) }}</div>
			@if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p>@endif
		</div>
		<div class="form-group">
			{{ Form::label('phone', Lang::get('validation.attributes.phone'), array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-3">
		{{ Form::text('phone',null,array('class'=>'form-control')) }}</div>
		</div>
		<div class="form-group">
			{{ Form::label('mobile', Lang::get('validation.attributes.mobile'), array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-3">
		{{ Form::text('mobile',null,array('class'=>'form-control')) }}</div>
		</div>
		<div class="form-group">
			{{ Form::label('fax', Lang::get('validation.attributes.fax'), array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-3">
		 {{ Form::text('fax',null,array('class'=>'form-control')) }}</div>
		</div>
		<div class="form-group">
			{{ Form::label('street', Lang::get('validation.attributes.street'), array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-4">
		 {{ Form::text('street',null,array('class'=>'form-control')) }}</div>
		 </div> 
		 <div class="form-group">
			{{ Form::label('zip', Lang::get('validation.attributes.zip'), array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-2">
		 {{ Form::text('zip',null,array('class'=>'form-control')) }}</div>
		</div> 
		 <div class="form-group">
			{{ Form::label('city', Lang::get('validation.attributes.city'), array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-3">
		 {{ Form::text('city',null,array('class'=>'form-control')) }}</div>
		 </div>
		<div class="form-group">
			{{ Form::label('country', Lang::get('validation.attributes.country'), array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-3">
		 {{ Form::text('country',null,array('class'=>'form-control')) }}</div>
		 </div> 
		<div class="form-group @if ($errors->has('web')) has-error @endif">
			{{ Form::label('web', Lang::get('validation.attributes.web'), array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-4">
		{{ Form::url('web',null,array('class'=>'form-control')) }}</div>
		@if ($errors->has('web')) <p class="help-block">{{ $errors->first('web') }}</p>@endif
		</div> 
		<div class="form-group">
			{{ Form::label('notes', Lang::get('validation.attributes.notes'), array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-4">
		{{ Form::textarea('notes',null,array('class'=>'form-control','rows'=>'3')) }}</div>
		</div>
		<div class="form-group">
    <div class="col-sm-offset-2 col-sm-5">
      <button type="submit" class="btn btn-default pull-right">{{ Lang::get('gui.submit_save') }}</button>
    </div>
  </div> 