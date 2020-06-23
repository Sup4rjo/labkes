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
<div style="padding-bottom:20px; float: right;">
<a href="javascript: void(0)" 
   onclick="window.open('grid/notbeng/formreturns.php', 
  'windowname1', 
  'width=830, height=650,scrollbars=yes'); 
   return false;"><button class="btn btn-success">Tambah</button></a></div>

<div style="padding-bottom:20px;">
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
</div>
<table id="datagrid"></table>  
<div id="navGrid"></div>
<script language="javascript">
jQuery("#datagrid").jqGrid({
   	url:'grid/notbeng/listreturnotbeng.php',
    datatype: "json",
    colNames:['Id Retur NS','Tgl Retur','Id NS','ID PKB','Cetak'],
    colModel:[ 
		{name:'id_retur_ns',index:'id_retur_ns', width:50, editable:true,editoptions:{size:15}},
		{name:'tgl_retur_ns',index:'tgl_retur_ns', width:60, editable:true,editoptions:{size:15}},
		{name:'id_ns',index:'id_ns', width:50, editable:true,editoptions:{size:15}},
			{name:'id_pkb',index:'id_pkb', width:60, editable:true,editoptions:{size:15}},
		
	{name:'act',index:'act', width:20,align:"right",editable:false,editoptions:{size:10}}
	],
	rowNum:10,
	autowidth:true, 
	pager: '#navGrid', 
	sortname: 'id_retur_ns',
	sortorder: "desc", 
	height: 200,   
	caption:"Retur Nota Bengkel",
	gridComplete: function(){
		
		var ids = jQuery("#datagrid").jqGrid('getDataIDs');
		for(var i=0;i < ids.length;i++){
			var cl = ids[i];
				var c2= ids[i];
		
		klik = "<input style='height:25px;width:50px;' type='button' value='CETAK' onclick=\"window.open('grid/notbeng/cetakreturns.php?trx="+cl+"',\'Popup\', \'width=800,height=500,scrollbars=yes\');\" />";
	
			
			jQuery("#datagrid").jqGrid('setRowData',ids[i],{act:klik});
			
		}	
	}
	
})
jQuery("#datagrid").jqGrid('navGrid','#navGrid', {edit:false,add:false,del:false,view:false,search:false, beforeRefresh:function(){
	var no_pkb = jQuery("#no_pkb").val('');
			var nama_plg = jQuery("#nama_plg").val('');
			var no_polisi = jQuery("#no_polisi").val('');
			jQuery("#datagrid").jqGrid('setGridParam',{url:"grid/notbeng/listreturnotbeng.php",page:1});
			jQuery("#datagrid").trigger('reloadGrid');
		}},{jqModal:false,closeOnEscape:true,height:250}); 
function gridReload1(){
	var no_pkb = jQuery("#no_pkb").val();
	var nama_plg = jQuery("#nama_plg").val();
var no_polisi = jQuery("#no_polisi").val();
	jQuery("#datagrid").jqGrid('setGridParam',{url:"grid/notbeng/listreturnotbeng.php?no_pkb="+no_pkb+"&nama_plg="+nama_plg+"&no_polisi="+no_polisi,page:1}).trigger("reloadGrid");
}
</script> 
