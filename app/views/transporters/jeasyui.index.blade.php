@extends('layouts.master') @section('title') @parent :: Transporters @stop

@section('content')
<h2>
	<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
Transporteri
</h2>

<table id="business-datagrid" class="easyui-datagrid" title="Lista"
	style="width: 95%; height: 520px" toolbar="#toolbar">
	<thead>
		<tr>
			<th>ID</th>
			<th>Naziv</th>
			<th>Grad</th>
			<th>Zemlja</th>
		</tr>
	</thead>
</table>
<div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newBusiness()">Novi Unos</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editBusiness()">Ažuriraj/Pogledaj</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyBusiness()">Obriši</a>
    </div>


<div id="dlg" class="easyui-dialog"
	style="width: 500px; height: 720px; padding: 10px 20px" closed="true"
	buttons="#dlg-buttons">
	<div class="ftitle">Informacije</div>
	{{ Form::open(
	array('url'=>'','method'=>'POST','role'=>'form','id'=>'fm')) }}
	{{ Form::hidden('_method','',array('id'=>'_method')) }}
	
	<!-- 	render subview form -->
        @include('layouts.businessform')
<!-- 	end subview form -->	

	{{ Form::close() }}
</div>
<div id="dlg-buttons">
	<a href="javascript:void(0)" class="easyui-linkbutton c6"
		iconCls="icon-ok" onclick="saveBusiness()" style="width: 90px">Sačuvaj</a> <a
		href="javascript:void(0)" class="easyui-linkbutton"
		iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')"
		style="width: 90px">Prekini</a>
</div>

@stop 
@section('extrascripts')
<script>

var url;
function newBusiness(){
	$('#dlg').dialog('open').dialog('setTitle','Novi Unos');
    $('#fm').form('clear');
    $('#_method').val('POST');
    url = 'transporters';
}
function editBusiness(){
	$('#_method').val('PUT');
    var row = $('#business-datagrid').datagrid('getSelected');
    if (row){
        $('#dlg').dialog('open').dialog('setTitle','Ažuriraj Unos');
        $('#fm').form('load',row);
        url = 'transporters/'+row.id;
    }
}
function saveBusiness(){
	 
    $('#fm').form('submit',{
        url: url,
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(result){
            var result = eval('('+result+')');
            if (result.errorMsg){
                $.messager.show({
                    title: 'Greška',
                    msg: result.errorMsg.companies_type_fk
                });
            } else {
                $('#dlg').dialog('close');        // close the dialog
                $('#business-datagrid').datagrid('reload');    // reload the user data
                $.messager.show({    // show message
                    title: result.status,
                    msg: result.msg
                });
            }
        }
    });
}
function destroyBusiness(){
    var row = $('#business-datagrid').datagrid('getSelected');
    if (row){
    	$.messager.defaults.ok = 'Da';
    	$.messager.defaults.cancel = 'Ne';
        $.messager.confirm('Pažnja!','Jeste li sigurni da želite obrisati ovaj podatak?',function(r){
            if (r){
                $.post('transporters/'+row.id,{id:row.id, _method:'DELETE',_token:'<?=csrf_token(); ?>'},function(result){
                    if (result.success){
                        $('#business-datagrid').datagrid('reload');    // reload the user data
                        $.messager.show({    // show message
                            title: result.status,
                            msg: result.msg
                        });
                    } else {
                        $.messager.show({    // show error message
                            title: 'Greška',
                            msg: result.errorMsg
                        });
                    }
                	
                },'json');
            }
        });
    }
}



function pagerFilter(data){
	if (typeof data.length == 'number' && typeof data.splice == 'function'){	// is array
		data = {
			total: data.length,
			rows: data
		}
	}

	

	var dg = $(this);
	var opts = dg.datagrid('options');
	var pager = dg.datagrid('getPager');
	pager.pagination({
		onSelectPage:function(pageNum, pageSize){
			opts.pageNumber = pageNum;
			opts.pageSize = pageSize;
			pager.pagination('refresh',{
				pageNumber:pageNum,
				pageSize:pageSize
			});
			dg.datagrid('loadData',data);
		}
	});
	if (!data.originalRows){
		data.originalRows = (data.rows);
	}
	if (!opts.remoteSort && opts.sortName){
		var target = $(this);
		var names = opts.sortName.split(',');
		var orders = opts.sortOrder.split(',');
		data.originalRows.sort(function(r1,r2){
			var r = 0;
			for(var i=0; i<names.length; i++){
				var sn = names[i];
				var so = orders[i];
				var col = $(target).datagrid('getColumnOption', sn);
				var sortFunc = col.sorter || function(a,b){
					return a==b ? 0 : (a>b?1:-1);
				};
				r = sortFunc(r1[sn], r2[sn]) * (so=='asc'?1:-1);
				if (r != 0){
					return r;
				}
			}
			return r;
		});
	}
	var start = (opts.pageNumber-1)*parseInt(opts.pageSize);
	var end = start + parseInt(opts.pageSize);
	data.rows = (data.originalRows.slice(start, end));

	return data;
}

$(function(){

	$('#business-datagrid').datagrid({
		autoRowHeight: true,
		method: 'get', 
		url: '{{{ URL::action('TransportersController@index') }}}',
        autoRowHeight:true,
        pagination:true,
        pageSize: 20,
        pageList: [20],
        remoteSort: false,
        striped: true,
        singleSelect: true,

        
         columns: [[
                    {field:'id', title:'ID',formatter:function(value,row){return row.id}, hidden: 'true'},
        		    {field:'cname', title:'Naziv', width: '60%', formatter:function(value,row){return row.cname}, sortable: 'true', order: 'asc'},
        		    {field:'city', title:'Grad', width: '20%',formatter:function(value,row){return row.city}},
        		    {field:'country', title:'Država', width: '20%',formatter:function(value,row){return row.country}},
		  ]]
		  
	  	});
	
	$('#business-datagrid').datagrid({loadFilter:pagerFilter});
});

    </script>
<style type="text/css">
        #fm{
            margin:0;
            padding:10px 30px;
        }
        .ftitle{
            font-size:14px;
            font-weight:bold;
            padding:5px 0;
            margin-bottom:10px;
            border-bottom:1px solid #ccc;
        }
        .fitem{
            margin-bottom:5px;
        }
        .fitem label{
            display:inline-block;
            width:80px;
        }
        .fitem input{
            width:160px;
        }
    </style>

@stop

