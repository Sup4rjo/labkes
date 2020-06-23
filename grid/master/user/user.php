<link rel="stylesheet" href="css/jquery-ui-1.8.13.custom.css" type="text/css" media="all" /> 
<link rel="stylesheet" href="css/ui.jqgrid.css" type="text/css" media="all" /> 
<link type="text/css" href="themes/ui-lightness/ui.all.css" rel="stylesheet" />
<script src="js/jquery-1.4.js" type="text/javascript" charset="utf-8"/> </script>
<script src="js/jquery-1.5.2.min.js" type="text/javascript" charset="utf-8"></script> 
<script src="js/jquery-ui-1.8.13.custom.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/i18n/grid.locale-en.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.jqGrid.src.js" type="text/javascript" charset="utf-8"></script> 
<script src="js/jquery.table.addrow.js" type="text/javascript" charset="utf-8"></script>
<script src="js/engineSearch.js" type="text/javascript" charset="utf-8"></script>  
<table id="datagrid"></table>  
<div id="navGrid"></div>
<script language="javascript">
var codata = (function () {
           var t = "";

            $.ajax({
                'async': false,
                'global': false,
                'url': 'grid/master/user/selectlevel.php',
             	'dataType': 'json',
				'type' : "GET",
                'success' : function(data)
            	{
					
                    $.each(data, function(i,item){
                        t += item.id_level+":"+item.nama_level+";";
                    });
					t=t.substring(0,t.length-1);
				
                 } 
            });
          	return t;
        });
		
jQuery("#datagrid").jqGrid({
   	url:'grid/master/user/listuser.php',
    datatype: "json",
    colNames:['ID','Nama', 'Username', 'Password', 'Level'],
    colModel:[ 
	{name:'id',index:'id', width:20,editable:false,hidden:true,editoptions:{readonly:true,size:10}}, 
		{name:'nama',index:'nama', width:150, editable:true, editoptions:{size:15}},
		{name:'username',index:'username', width:60, editable:true,editoptions:{size:10}},
		{name:'password',index:'password', width:80,editable:true,hidden:true,editoptions:{size:25}, editrules:{edithidden:true}},
		{name:'level',index:'level', width:70,editable:true,edittype:'select',editoptions:{value:codata,size:10}, editrules:{required:true}},
	],
	rowNum:10,
	loadonce:true,
	autowidth:true, 
	pager: '#navGrid', 
	sortname: 'id_user',
	rownumbers:true,  
	sortorder: "desc", 
	height: 200,   
	caption:"User",
	editurl: 'grid/master/user/edituser.php',
	
}); 
jQuery("#datagrid").jqGrid('navGrid','#navGrid',{edit:true,add:true,del:true,view:true,search:false},
{closeAfterEdit:true,width:500}, {closeAfterAdd:true},{},{},{width:500});  
jQuery("#datagrid").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false}); 

</script> 
