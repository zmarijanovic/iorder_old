@extends('layouts.master') 
@section('title') 
@parent :: {{ Lang::get('gui.orders') }} 
@stop 
@section('content')
<h2><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> {{ Lang::get('gui.order') }} : {{ $order->order_num }} </h2>

<div class="panel panel-default">
	
	<div class="panel-heading"><h3 class="panel-title">{{ Lang::get('gui.submit_edit') }}</h3></div>
	<div class="panel-body">
			{{ Form::model($order,
		array('route'=>array('orders.update', $order->id),'method'=>'PUT','class'=>'form-horizontal form-group-sm','role'=>'form','id'=>'updateform'))
		}}
<!-- 	render subview form -->
        @include('layouts.orderform_edit')
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
{{ HTML::script('js/moment.min.js') }}
{{ HTML::script('js/moment.locale.bs.js') }}
{{ HTML::script('js/bootstrap-datetimepicker.min.js') }}
{{ HTML::style('css/bootstrap-datetimepicker.min.css') }}
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
$(function(){
	  $('#oDate').datetimepicker({
// 	      	defaultDate: moment(" ?? "),  // ovde treba danasnji datum kad je create.blade
	      	format: 'L'

	      });
	  $('.datepicker').datetimepicker({
//	      	defaultDate: moment(" ?? "),  // ovde treba danasnji datum kad je create.blade
	      	format: 'L LT'

	      });
});

function handleResponse(result){

    if (result.errorMsg){
        var errorText='';
        $.each(result.errorMsg, function(index, value) {
        	errorText = errorText+value+"<br>";
        	    });
    	bootbox.alert("{{ Lang::get('gui.crud_error') }}"+"<br>"+errorText);
    } else {
    	bootbox.alert(result.status+"<br>"+result.msg, function(){
    		var pagehref = '/orders/';
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
	var method = $(form).find('input[name="_method"]').val();
	var options = {

			data: postData,
	        url: formURL,
	        method: method,
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