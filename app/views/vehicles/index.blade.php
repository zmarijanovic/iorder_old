@extends('layouts.master')
@section('title')
@parent
:: {{ Lang::get('gui.vehicles') }} 
@stop

@section('content')
  <h2><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> 
  {{ Lang::get('gui.vehicles') }} &nbsp;&nbsp;&nbsp;
  <a href="{{{ URL::to('/vehicles/create',$transporter) }}}" role="button"
		class="btn btn-default"> <span class="glyphicon glyphicon-plus"
		aria-hidden="true"></span> {{ Lang::get('gui.add_new_entry') }}
	</a></h2>
    {{ Form::hidden('transporter_fk',$transporter) }}
	<table class="table table-condensed table-hover table-striped"
	id="grid-data-api">
	<thead>
		<tr>
			<th data-column-id="licenceplate" data-sortable="false">{{
				Lang::get('validation.attributes.licenceplate') }}</th>
			<th data-column-id="vehicletype" data-sortable="false">{{ Lang::get('validation.attributes.vehicletype_fk')
				}}</th>
			<th data-column-id="active" data-formatter="active" data-sortable="false">{{
				Lang::get('gui.active') }}</th>
			<th data-column-id="commands" data-formatter="commands"
				data-sortable="false" data-header-css-class="colbutton">{{
				Lang::get('gui.options') }}</th>
		</tr>
	</thead>
</table>

@stop

@section('extrascripts') 
{{ HTML::script('js/bootbox.min.js') }}
<style type="text/css">
.colbutton {
	width: 7%;
}
</style>
<script>
	$(function(){

	    var grid=$("#grid-data-api").bootgrid({
	                    ajax: true,
	                    rowCount: 15,
	                    templates: {
	                        search: ""
	                    },
	                    post: function ()
	                    {
	                        return {
	                            id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
	                        };
	                    },
	                    url: '{{{ URL::action('VehiclesController@indexAll',array('transporter_fk'=>$transporter)) }}}',
	            		formatters: {
	            		        "commands": function(column, row)
	            		        {
	            		            return "<button type=\"button\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-pencil\"></span></button> " + 
	            		                "<button type=\"button\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.id + "\" data-row-title=\"" + row.licenceplate + "\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
	            		        },
	            		        "active": function(column, row)
	            		        {
	            		        	if (row.active=='1'){ 
		            		        	return '<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>';
	            		        	}
	    							else { 
		    							return '<span class="glyphicon glyphicon-ban-circle" aria-hidden="true" style="color: lightgrey"></span>';
	    							}

		            		        }
	            		    }
	            			
	                }).on("loaded.rs.jquery.bootgrid", function()
	                		{
	                    /* Executes after data is loaded and rendered */
	                    grid.find(".command-edit").on("click", function(e)
	                    {
	                        var pagehref = '/vehicles/'+$(this).data("row-id")+'/edit';
	                        window.location.href=pagehref;
	                        return false;
	                    }).end().find(".command-delete").on("click", function(e)
	                    {
	                    	var target = $(this).data("row-id");
	                    	var item_name = $(this).data("row-title");
	                    	var choice = bootbox.confirm("{{ Lang::get('gui.confirm_delete', array('item'=>'"+item_name+"')) }}" , function(result){
	                        if (result) {

	                        	$.post('/vehicles/'+target,{id:target, _method:'DELETE',_token:'<?=csrf_token(); ?>'},function(result){
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

