@extends('layouts.businessform')

@section('formextra')
<div class="fitem">
		{{ Form::label('companies_type_fk', 'Tip Kompanije',array('style'=>'width:95%')) }}
		{{ Form::select('companies_type_fk',array(),1,array('class'=>'easyui-combobox','style'=>'width:95%','required'=>'true')) }}
		</div>
@stop
