@extends('layouts.master') @section('title') @parent :: {{ Lang::get('gui.vehicles') }}  @stop

@section('content')
<h2><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> {{ Lang::get('gui.vehicles') }}</h2>
<div class="panel panel-default">
	
	<div class="panel-heading"><h3 class="panel-title">{{ Lang::get('gui.new_entry') }}</h3></div>
	<div class="panel-body">
			{{ Form::open(
		array('route'=>array('vehicles.store'),'method'=>'POST','class'=>'form-horizontal form-group-sm','role'=>'form', 'id'=>'updateform'))
		}}
		{{ Form::hidden('transporter_fk',$transporter) }}
<!-- 	render subview form -->
        @include('layouts.vehicleform')
<!-- 	end subview form -->		
		
		
		{{ Form::close() }}

	</div>
</div>

@stop
@section('extrascripts')
{{ HTML::script('js/jquery.validate.min.js') }}
{{ HTML::script('js/jquery.form.min.js') }}
{{ HTML::script('js/bootbox.min.js') }}
{{ HTML::script('js/messages_hr.js') }}
<style type="text/css">
label.error {
	/* remove the next line when you have trouble in IE6 with labels in list */
	color: red;
	font-style: italic
}
input.error { 
	border: 1px dotted red; 
}

</style>
<script>

function handleResponse(result){

        if (result.errorMsg){
            var errorText='';
            $.each(result.errorMsg, function(index, value) {
            	errorText = errorText+value+"<br>";
            	    });
        	bootbox.alert("{{ Lang::get('gui.crud_error') }}"+"<br>"+errorText);
        } else {
        	bootbox.alert(result.status+"<br>"+result.msg, function(){
        		var pagehref = '{{{ URL::action('VehiclesController@indexAll',array('transporter_fk'=>$transporter)) }}}';
                window.location.href=pagehref;
                return false;
            	});
        }
	
}


$('#updateform').submit(function(e){
e.preventDefault();
});

$('#updateform').validate({
	
    submitHandler: function(form){
    	var postData = $(form).serializeArray();
    	var formURL = $(form).attr("action");
    	var options = {

    			data: postData,
    	        url: formURL,
    	        type: 'POST',
    	    	dataType: 'json',
    	    	success: handleResponse
    	};

        $(form).ajaxSubmit(options);
        return false;
    }
});

</script>
@stop
