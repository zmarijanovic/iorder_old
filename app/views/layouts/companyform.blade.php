@extends('layouts.businessform')

@section('formextra')
@parent
<div class="form-group">
			{{ Form::label('companies_type_fk', Lang::get('validation.attributes.companies_type_fk'), array('class'=>'col-sm-2
			control-label')) }}
			<div class="col-sm-4">
		{{ Form::select('companies_type_fk',$types,isset($company->companies_type_fk) ? $company->companies_type_fk : '1',array('class'=>'form-control')) }}
		</div>
		</div>
@stop
