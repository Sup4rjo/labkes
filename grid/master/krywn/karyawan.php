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
   	url:'grid/master/krywn/listkaryawan.php',
    datatype: "json",
    colNames:['Id Karyawan', 'Nama', 'Tlp', 'Alamat', 'Jabatan'],
    colModel:[ 
		{name:'id_kry',index:'id_kry', width:60, editable:false,editoptions:{size:15}},
		{name:'nama',index:'nama', width:150, editable:true, editoptions:{size:15}},
		{name:'tlp',index:'tlp', width:60, editable:true,editoptions:{size:10}},
		{name:'alamat',index:'alamat', width:60, editable:true,edittype:"textarea",editoptions:{size:10}},
			{name:'jabatan',index:'jabatan', width:120,editable:true,edittype:"select",editoptions:{value:"Kepala Bengkel:Kepala Bengkel;Service Advisor:Service Advisor;FA Manager:FA Manager;Mekanik:Mekanik;Marketing:Marketing;Driver:Driver"}},
	],
	rowNum:10,
	loadonce:true,
	autowidth:true, 
	pager: '#navGrid', 
	sortname: 'id_kry',
	rownumbers:true,  
	sortorder: "desc", 
	height: 200,   
	caption:"Karyawan",
	editurl: 'grid/master/krywn/editkry.php',
	
}); 
jQuery("#datagrid").jqGrid('navGrid','#navGrid',{edit:true,add:true,del:true,view:true,search:false},
{closeAfterEdit:true,width:500}, {closeAfterAdd:true},{},{},{width:500});  
jQuery("#datagrid").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false}); 

</script> 
