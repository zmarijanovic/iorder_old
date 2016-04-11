<div class="form-group @if ($errors->has('licenceplate')) has-error @endif">
			{{ Form::label('licenceplate', 'Registracija', array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-4">{{
				Form::text('licenceplate',null,array('class'=>'form-control')) }}</div>
				@if ($errors->has('licenceplate')) <p class="help-block">{{ $errors->first('licenceplate') }}</p> @endif
		</div>
		<div class="form-group @if ($errors->has('vehicletype_fk')) has-error @endif">
			{{ Form::label('vehicletype_fk', 'Tip Vozila', array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-4">
				{{ Form::select('vehicletype_fk',$types,isset($vehicle->vehicletype_fk) ? $vehicle->vehicletype_fk : '1',array('class'=>'form-control')) }}</div>
		@if ($errors->has('vehicletype_fk')) <p class="help-block">{{ $errors->first('vehicletype_fk') }}</p> @endif
		</div>
		
		<div class="form-group">
    <div class="col-sm-offset-2 col-sm-4">
		<div class="checkbox">
			<label>
			{{ Form::checkbox('active',isset($vehicle->active) ? $vehicle->active : '1',(isset($vehicle->active) && $vehicle->active=='1' ? true : false)) }} Active
			</label>
			{{ $errors->first('active') }}
		</div>
		</div>
		</div>
		
		<div class="form-group">
    <div class="col-sm-offset-2 col-sm-4">
      <button type="submit" class="btn btn-default pull-right">Sačuvaj</button>
    </div>
  </div> 