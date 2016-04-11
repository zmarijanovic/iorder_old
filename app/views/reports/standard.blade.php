@extends('layouts.master') 
@section('title') 
@parent :: {{ Lang::get('gui.orders') }} 
@stop 
@section('content')
<h2>
	<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
	@if (Route::current()->getUri()=='reports/transporter') {{ Lang::get('gui.report')
	}} - {{ Lang::get('gui.transporters')
	}}&nbsp;&nbsp;&nbsp;
	<a
		href="{{{ URL::to('/reports/transporter/print') }}}" role="button"
		class="btn btn-default"> <span class="glyphicon glyphicon-print"
		aria-hidden="true"></span> {{ Lang::get('gui.submit_print') }}
	</a>
	@elseif (Route::current()->getUri()=='closedorders') {{
	Lang::get('gui.closedorders') }}&nbsp;&nbsp;&nbsp;
	<a
		href="{{{ URL::to('/orders/create') }}}" role="button"
		class="btn btn-default"> <span class="glyphicon glyphicon-plus"
		aria-hidden="true"></span> {{ Lang::get('gui.add_new_entry') }}
	</a>
	@elseif (Route::current()->getUri()=='cancelledorders') {{
	Lang::get('gui.cancelledorders') }} &nbsp;&nbsp;&nbsp;<a
		href="{{{ URL::to('/orders/create') }}}" role="button"
		class="btn btn-default"> <span class="glyphicon glyphicon-plus"
		aria-hidden="true"></span> {{ Lang::get('gui.add_new_entry') }}
	</a> 
	@else {{
	Lang::get('gui.orders') }} &nbsp;&nbsp;&nbsp;<a
		href="{{{ URL::to('/orders/create') }}}" role="button"
		class="btn btn-default"> <span class="glyphicon glyphicon-plus"
		aria-hidden="true"></span> {{ Lang::get('gui.add_new_entry') }}
	</a> 
	
	
	@endif
</h2>
<div class="row">
<div class="col-md-12">&nbsp;</div></div>
<div class="row">
<div class="form-inline col-md-offset-2">
@if (Route::current()->getUri()=='reports/transporter')
<div class="form-group form-group-sm col-md-5">
{{ Form::label('transporter_fk', Lang::get('validation.attributes.transporter_fk'), array('class'=>'control-label')) }}
{{ Form::select('transporter_fk',$transporters,0,array('id'=>'transporter_fk','class'=>'form-control')) }}
</div>
@endif
@if (Route::current()->getUri()=='reports/buyers')
<div class="form-group form-group-sm">
{{ Form::label('buyer_fk', Lang::get('gui.buyer'), array('class'=>'control-label')) }}
{{ Form::select('buyer_fk',$buyers,0,array('id'=>'buyer_fk','class'=>'form-control')) }}
</div>
@endif
<div class="form-group form-group-sm col-md-1">
 {{ Form::label('start_date', Lang::get('gui.timeframe'), array('class'=>'control-label')) }}
 </div>
<div class="form-group form-group-sm col-xs-2 col-md-2">
            <div class='input-group date' id='sDate'>
                {{ Form::text('start_date',null,array('id'=>'start_date','class'=>'form-control text-uppercase','placeholder'=>Lang::get('gui.daterange_from'))) }}
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
        <div class="form-group form-group-sm col-xs-2 col-md-2">
            <div class='input-group date' id='eDate'>
                {{ Form::text('end_date',null,array('id'=>'end_date','class'=>'form-control text-uppercase','placeholder'=>Lang::get('gui.daterange_to'))) }}
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
</div>
</div>

<table class="table table-condensed table-hover table-striped" id="grid-data-api">
	<thead>
		<tr>
			<th data-column-id="order_num" data-header-css-class="colbutton" data-formatter="order">{{
				Lang::get('gui.order') }}</th>
				<th data-column-id="timeframe" data-sortable="false" data-header-css-class="time">{{ Lang::get('gui.timeframe')
				}}</th>

			<th data-column-id="order_type" data-sortable="false" data-header-css-class="type">{{ Lang::get('gui.type')
				}}</th>
			<th data-column-id="transporter" data-sortable="false" data-header-css-class="time">{{
				Lang::get('validation.attributes.transporter_fk') }}</th>
				<th data-column-id="buyer" data-sortable="false" data-header-css-class="time">{{
				Lang::get('gui.buyer') }}</th>
				<th data-column-id="vehicle_type" data-sortable="false">{{ Lang::get('gui.vehicle') }}</th>
			<th data-column-id="route" data-header-css-class="route" data-sortable="false">{{
				Lang::get('gui.route') }}</th>
			<th data-column-id="commands" data-formatter="commands"
				data-sortable="false" data-header-css-class="colbutton">{{
				Lang::get('gui.options') }}</th>
		</tr>
	</thead>
</table>
@stop 

@section('extrascripts') 
{{ HTML::script('js/bootbox.min.js') }}
{{ HTML::script('js/moment.min.js') }}
{{ HTML::script('js/moment.locale.bs.js') }}
{{ HTML::script('js/bootstrap-datetimepicker.min.js') }}
{{ HTML::style('css/bootstrap-datetimepicker.min.css') }}
<style type="text/css">
.colbutton {
	width: 7%;
}
.type {
	width: 5%;
}
.time {
	width: 15%;
}
.route {
	width: 30%;
}
</style>
<script>
	$(function(){


		   $('#sDate').datetimepicker({
			   defaultDate: moment("{{ $lastdate }}").startOf('month'),
 			   format: 'L'
			   });
	        $('#eDate').datetimepicker({
	        	defaultDate: moment("{{ $lastdate }}"),
	        	format: 'L'

	        });
	        $("#sDate").on("dp.change",function (e) {
	            $('#eDate').data("DateTimePicker").minDate(e.date);
	        });
	        $("#eDate").on("dp.change",function (e) {
	            $('#sDate').data("DateTimePicker").maxDate(e.date);
	        });

				   var grid=$("#grid-data-api").bootgrid({
	                    ajax: true,
	                    rowCount: 15,
	                    columnSelection: false,
	                    templates: {
	                        search: ""
	                    },
	                    post: function ()
	                    {
	                    	var start = moment($('#start_date').val(),"DD-MM-YYYY");
	                        var end = moment($('#end_date').val(),"DD-MM-YYYY");
	                        return {
	                            id: "b0df282a-0d67-40e5-8558-c9e93b7befed",
	                            transporterFK: $('#transporter_fk').val(), // preuzmi iz comboboxa
	                            buyerFK: $('#buyer_fk').val(), // preuzmi iz comboboxaß
	                            sDate: start.format('YYYY-MM-DD'), // preuzmi datume iz dateboxa
	                            eDate: end.format('YYYY-MM-DD')
	                        };
	                    },
	            			url: '{{{ URL::action('StandardReportController@indexTransporter') }}}',
	            			formatters: {
	            		        "commands": function(column, row)
	            		        {
	            		            return "<button type=\"button\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-pencil\"></span></button> " + 
	            		                "<button type=\"button\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.id + "\" data-row-title=\"" + row.cname + "\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
	            		        },
	            		        "order": function(column,row)
	            		        {
	            		            return "<span class=\"initialism\"><a href=\"{{ URL::to('/orders/"+ row.id +"') }}\">"+row.order_num+"</a></span>";
			            		        
	            		        },
// 	            		        "status": function(column, row)
// 	            		        {
// 		            		        switch(row.status_fk){

// 		            		        case 1:
// 		            		        	return '<span class="glyphicon glyphicon-folder-open" aria-hidden="true" style="color: lightgrey"></span>';
// 		            		        	break;
// 		            		        case 2:
// 		            		        	return '<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>';
// 		            		        	break;
// 		            		        case 3:
// 		            		        	return '<span class="glyphicon glyphicon-folder-close" aria-hidden="true"></span>';
// 		            		        	break;

// 		            		        }
// 	            		        }
	            		    }
	            			
	                }).on("loaded.rs.jquery.bootgrid", function()
	                		{
	                    /* Executes after data is loaded and rendered */
	                    grid.find(".command-edit").on("click", function(e)
	                    {
	                        var pagehref = '/orders/'+$(this).data("row-id")+'/edit';
	                        window.location.href=pagehref;
	                        return false;
	                    }).end().find(".command-delete").on("click", function(e)
	                    {
	                    	var target = $(this).data("row-id");
	                    	var item_name = $(this).data("row-title");
	                    	var choice = bootbox.confirm("{{ Lang::get('gui.confirm_delete', array('item'=>'"+item_name+"')) }}" , function(result){
	                        if (result) {

	                        	$.post('/orders/'+target,{id:target, _method:'DELETE',_token:'<?=csrf_token(); ?>'},function(result){
	                                if (result.success){
	                                	$("#grid-data-api").bootgrid('reload');    // reload the user data
	                                	bootbox.alert(result.status+"<br>"+result.msg);
                                    } else {
                                    	var errorText='';
                                        $.each(result.errorMsg, function(index, value) {
                                        	errorText = errorText+value+"<br>";
                                        	    });
                                    	bootbox.alert("{{ Lang::get('gui.crud_error') }}"+"<br>"+errorText);   // show error message
	                                       
	                                }
	                            	
	                            },'json');
	                        } 
	                    	});
	                    });
	                });






		            });

    
	 

</script>

@stop
