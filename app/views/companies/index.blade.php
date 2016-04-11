@extends('layouts.master') 
@section('title') 
@parent :: {{ Lang::get('gui.companies') }} 
@stop 
@section('content')
<h2>
	<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
	@if (Route::current()->getUri()=='clients') {{ Lang::get('gui.clients')
	}}&nbsp;&nbsp;&nbsp;
	<a
		href="{{{ URL::to('/companies/create') }}}" role="button"
		class="btn btn-default"> <span class="glyphicon glyphicon-plus"
		aria-hidden="true"></span> {{ Lang::get('gui.add_new_entry') }}
	</a>
	@elseif (Route::current()->getUri()=='suppliers') {{
	Lang::get('gui.suppliers') }}&nbsp;&nbsp;&nbsp;
	<a
		href="{{{ URL::to('/companies/create') }}}" role="button"
		class="btn btn-default"> <span class="glyphicon glyphicon-plus"
		aria-hidden="true"></span> {{ Lang::get('gui.add_new_entry') }}
	</a>
	@elseif (Route::current()->getUri()=='contacts') {{
	Lang::get('gui.contacts') }} &nbsp;&nbsp;&nbsp;<a
		href="{{{ URL::to('/companies/create') }}}" role="button"
		class="btn btn-default"> <span class="glyphicon glyphicon-plus"
		aria-hidden="true"></span> {{ Lang::get('gui.add_new_entry') }}
	</a> 
	@else {{
	Lang::get('gui.companies') }} &nbsp;&nbsp;&nbsp;<a
		href="{{{ URL::to('/companies/create') }}}" role="button"
		class="btn btn-default"> <span class="glyphicon glyphicon-plus"
		aria-hidden="true"></span> {{ Lang::get('gui.add_new_entry') }}
	</a> 
	
	
	@endif
</h2>

<table class="table table-condensed table-hover table-striped"
	id="grid-data-api">
	<thead>
		<tr>
			<th data-column-id="cname" data-order="asc">{{
				Lang::get('validation.attributes.cname') }}</th>
			<th data-column-id="city">{{ Lang::get('validation.attributes.city')
				}}</th>
			<th data-column-id="country">{{
				Lang::get('validation.attributes.country') }}</th>
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
	                    post: function ()
	                    {
	                        return {
	                            id: "b0df282a-0d67-40e5-8558-c9e93b7befed",
	                            transporter_fk: "22"
	                        };
	                    },
	                    @if (Route::current()->getUri()=='clients')  
	            			url: '{{{ URL::action('CompaniesController@indexClients') }}}',
	            			@elseif (Route::current()->getUri()=='suppliers')
	            			url: '{{{ URL::action('CompaniesController@indexSuppliers') }}}',
	            			@elseif (Route::current()->getUri()=='contacts')
	            			url: '{{{ URL::action('CompaniesController@indexContacts') }}}',
	            			@else 
	            			url: '{{{ URL::action('CompaniesController@indexAll') }}}',
	            			@endif
	            			formatters: {
	            		        "commands": function(column, row)
	            		        {
	            		            return "<button type=\"button\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-pencil\"></span></button> " + 
	            		                "<button type=\"button\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.id + "\" data-row-title=\"" + row.cname + "\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
	            		        }
	            		    }
	            			
	                }).on("loaded.rs.jquery.bootgrid", function()
	                		{
	                    /* Executes after data is loaded and rendered */
	                    grid.find(".command-edit").on("click", function(e)
	                    {
	                        var pagehref = '/companies/'+$(this).data("row-id")+'/edit';
	                        window.location.href=pagehref;
	                        return false;
	                    }).end().find(".command-delete").on("click", function(e)
	                    {
	                    	var target = $(this).data("row-id");
	                    	var item_name = $(this).data("row-title");
	                    	var choice = bootbox.confirm("{{ Lang::get('gui.confirm_delete', array('item'=>'"+item_name+"')) }}" , function(result){
	                        if (result) {

	                        	$.post('companies/'+target,{id:target, _method:'DELETE',_token:'<?=csrf_token(); ?>'},function(result){
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
