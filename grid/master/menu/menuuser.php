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
jQuery("#datagrid").jqGrid({
   	url:'grid/master/menu/lismenuuser.php',
    datatype: "json",
    colNames:['ID','Level', 'Menu'],
    colModel:[ 
	{name:'id',index:'id', width:20,editable:false,hidden:true,editoptions:{readonly:true,size:10}}, 
		{name:'level',index:'level', width:120,editable:true,edittype:"select",editoptions:{value:"1:Admin;2:Service Advisor;4:Kasir;3:Warehouse"}},
		{name:'id_menu',index:'id_menu', width:120,editable:true,edittype:"select",editoptions:{value:"master:Master;service:Service;notbeng:Nota Bengkel;tagihan:Tagihan;kasir:Kasir;laporan:laporan"}}
	],
	rowNum:20,
	loadonce:true,
	autowidth:true, 
	pager: '#navGrid', 
	sortname: 'id_submenu_dtl',
	rownumbers:true,  
	sortorder: "desc", 
	height: 200,   
	caption:"User",
	editurl: 'grid/master/menu/editmenuuser.php',
	
}); 
jQuery("#datagrid").jqGrid('navGrid','#navGrid',{edit:false,add:true,del:true,view:true,search:false},
{closeAfterEdit:true,width:500}, {closeAfterAdd:true},{},{},{width:500});  
jQuery("#datagrid").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false}); 

</script> 
