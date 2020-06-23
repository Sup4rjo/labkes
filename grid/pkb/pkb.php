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
<div>
	<table width="844">
	<tr><td width="206" class="text"><font color="#000000">No PKB</font>
    <input type="text" id="no_pkb" onKeyDown="doSearch1(arguments[0]||event)" size="16" style="border:dotted" />
    </td>
    <td width="282" class="text">
    <font color="#000000">Nama Pelanggan</font>
    <input type="text" id="nama_plg" onKeyDown="doSearch1(arguments[0]||event)" size="20" style="border:dotted"/>    </td>
    <td width="340" class="text"><font color="#000000">No Polisi</font>
      <input type="text" id="no_polisi" onkeydown="doSearch1(arguments[0]||event)" size="20" style="border:dotted"/></td>
	</tr>
    </table>
</div><br/>

<table id="datagrid"></table>  
<div id="navGrid"></div>
<script language="javascript">
jQuery("#datagrid").jqGrid({
   	url:'grid/pkb/listpkb.php',
    datatype: "json",
    colNames:['Id pkb','Tgl pkb','Id Registrasi','Tgl Registrasi', 'Nama','Alamat', 'No Polisi','PKB'],
    colModel:[ 
		{name:'id_pkb',index:'id_pkb', width:50, editable:true,editoptions:{size:15}},
		{name:'tgl_pkb',index:'tgl_pkb', width:60, editable:true,editoptions:{size:15}},
		{name:'id_registrasi',index:'id_registrasi', width:50, editable:true,editoptions:{size:15}},
			{name:'tgl_registrasi',index:'tgl_registrasi', width:60, editable:true,editoptions:{size:15}},
		{name:'nama',index:'nama', width:80, editable:true, editoptions:{size:15}},
		{name:'alamat',index:'alamat', width:80, editable:true, editoptions:{size:15}},
		{name:'no_polisi',index:'no_polisi', width:60, align:"center",editable:true,editoptions:{size:10}},
	
	{name:'act',index:'act', width:20,align:"right",editable:false,editoptions:{size:10}}
	],
	rowNum:10,
	autowidth:true, 
	pager: '#navGrid', 
	sortname: 'id_pkb',
	sortorder: "desc", 
	height: 200,   
	caption:"Perintah Kerja Bengkel",
	editurl: 'grid/editpkb.php',
	gridComplete: function(){
		
		var ids = jQuery("#datagrid").jqGrid('getDataIDs');
		for(var i=0;i < ids.length;i++){
			var cl = ids[i];
		
		klik = "<input style='height:25px;width:50px;' type='button' value='EDIT' onclick=\"window.open(\'grid/pkb/editpkb.php?ids="+cl+"',\'Popup\', \'width=990,height=700,scrollbars=yes\');\" />";
			
			jQuery("#datagrid").jqGrid('setRowData',ids[i],{act:klik});
		}	
	}
	
})
jQuery("#datagrid").jqGrid('navGrid','#navGrid', {edit:false,add:false,del:false,view:false,search:false, beforeRefresh:function(){
	var no_pkb = jQuery("#no_pkb").val('');
			var nama_plg = jQuery("#nama_plg").val('');
			var no_polisi = jQuery("#no_polisi").val('');
			jQuery("#datagrid").jqGrid('setGridParam',{url:"grid/pkb/listpkb.php",page:1});
			jQuery("#datagrid").trigger('reloadGrid');
		}},{jqModal:false,closeOnEscape:true,height:250}); 
function gridReload1(){
	var no_pkb = jQuery("#no_pkb").val();
	var nama_plg = jQuery("#nama_plg").val();
var no_polisi = jQuery("#no_polisi").val();
	jQuery("#datagrid").jqGrid('setGridParam',{url:"grid/pkb/listpkb.php?no_pkb="+no_pkb+"&nama_plg="+nama_plg+"&no_polisi="+no_polisi,page:1}).trigger("reloadGrid");
}

</script> 
