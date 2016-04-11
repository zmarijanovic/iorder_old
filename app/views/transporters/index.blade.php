@extends('layouts.master')
@section('title')
@parent
:: {{ Lang::get('gui.transporters') }} 
@stop

@section('content')
  <h2><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> 
  {{ Lang::get('gui.transporters') }} &nbsp;&nbsp;&nbsp;<a
		href="{{{ URL::to('/transporters/create') }}}" role="button"
		class="btn btn-default"> <span class="glyphicon glyphicon-plus"
		aria-hidden="true"></span> {{ Lang::get('gui.add_new_entry') }}
	</a></h2>

	<table class="table table-condensed table-hover table-striped"
	id="grid-data-api">
	<thead>
		<tr>
			<th data-column-id="cname" data-order="asc">{{
				Lang::get('validation.attributes.cname') }}</th>
			<th data-column-id="city">{{ Lang::get('validation.attributes.city')
				}}</th>
			<th data-column-id="vehicles" data-formatter="vehicles"
			data-sortable="false" data-header-css-class="vehbutton">{{
				Lang::get('gui.vehicles') }}</th>
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
.vehbutton {
	width: 9%;
}
</style>
<script>
	$(function(){
	                var grid=$("#grid-data-api").bootgrid({
	                    ajax: true,
	                    rowCount: 15,
	                    post: function ()
	                    {
	                        return {
	                            id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
	                        };
	                    },
	                    url: '{{{ URL::action('TransportersController@indexAll') }}}',
	            		formatters: {
	            			"vehicles": function(column, row)
            		        {
            		            return "<button type=\"button\" class=\"btn btn-xs btn-default command-show\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-th\"></span></button> ";
            		        },
	            		        "commands": function(column, row)
	            		        {
	            		            return "<button type=\"button\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-pencil\"></span></button> " + 
	            		                "<button type=\"button\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.id + "\" data-row-title=\"" + row.cname + "\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
	            		        }
	            		    }
	            			
	                }).on("loaded.rs.jquery.bootgrid", function()
	                		{
	                    /* Executes after data is loaded and rendered */
	                	grid.find(".command-show").on("click", function(e)
	    	                    {
	    	                        var pagehref = '/transporters/'+$(this).data("row-id")+'/vehicles';
	    	                        window.location.href=pagehref;
	    	                        return false;
	    	                    }).end().find(".command-edit").on("click", function(e)
	                    {
	                        var pagehref = '/transporters/'+$(this).data("row-id")+'/edit';
	                        window.location.href=pagehref;
	                        return false;
	                    }).end().find(".command-delete").on("click", function(e)
	                    {
	                    	var target = $(this).data("row-id");
	                    	var item_name = $(this).data("row-title");
	                    	var choice = bootbox.confirm("{{ Lang::get('gui.confirm_delete', array('item'=>'"+item_name+"')) }}" , function(result){
	                        if (result) {

	                        	$.post('/transporters/'+target,{id:target, _method:'DELETE',_token:'<?=csrf_token(); ?>'},function(result){
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

