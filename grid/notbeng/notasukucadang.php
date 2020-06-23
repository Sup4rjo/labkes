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
   onclick="window.open('grid/notbeng/formnotbeng.php', 
  'windowname1', 
  'width=900, height=400,scrollbars=yes'); 
   return false;"><button class="btn btn-success">Tambah</button></a></div>
<div style="padding-bottom:20px;">
	<table width="960">
	<tr><td width="187" class="text"><font color="#000000">Id NS</font>
    <input type="text" id="no_ns" onKeyDown="doSearch1(arguments[0]||event)" size="16" style="border:dotted" />
    </td><td width="206" class="text"><font color="#000000">No PKB</font>
    <input type="text" id="no_pkb" onKeyDown="doSearch1(arguments[0]||event)" size="16" style="border:dotted" />
    </td>
    <td width="278" class="text">
    <font color="#000000">Nama Pelanggan</font>
    <input type="text" id="nama_plg" onKeyDown="doSearch1(arguments[0]||event)" size="20" style="border:dotted"/>    </td>
    <td width="269" class="text"><font color="#000000">No Polisi</font>
      <input type="text" id="no_polisi" onkeydown="doSearch1(arguments[0]||event)" size="20" style="border:dotted"/></td>
	</tr>
  </table>
</div>

<table id="datagrid"></table>  
<div id="navGrid"></div>
<script language="javascript">
jQuery("#datagrid").jqGrid({
   	url:'grid/notbeng/listnotbeng.php',
    datatype: "json",
    colNames:['Id NS','Tgl NS','Id PKB','ID Registasi', 'Nama','No Polisi', 'Warna','Cetak'],
    colModel:[ 
		{name:'id_ns',index:'id_ns', width:50, editable:true,editoptions:{size:15}},
		{name:'tgl_ns',index:'tgl_ns', width:60, editable:true,editoptions:{size:15}},
		{name:'id_pkb',index:'id_pkb', width:50, editable:true,editoptions:{size:15}},
			{name:'id_registrasi',index:'id_registrasi', width:60, editable:true,editoptions:{size:15}},
		{name:'nama',index:'nama', width:80, editable:true, editoptions:{size:15}},
		{name:'no_polisi',index:'no_polisi', width:60, align:"center",editable:true,editoptions:{size:10}},
		{name:'warna',index:'warna', width:60, editable:true, editoptions:{size:15}},
		
	
	{name:'act',index:'act', width:20,align:"right",editable:false,editoptions:{size:10}}
	],
	rowNum:10,
	autowidth:true, 
	pager: '#navGrid', 
	sortname: 'id_ns',
	sortorder: "desc", 
	height: 200,   
	subGrid: true,
	caption:"Nota Bengkel",
	gridComplete: function(){
		
		var ids = jQuery("#datagrid").jqGrid('getDataIDs');
		for(var i=0;i < ids.length;i++){
			var cl = ids[i];
		
		klik = "<input style='height:25px;width:50px;' type='button' value='CETAK' onclick=\"window.open('grid/notbeng/cetaknotasukucadang.php?id="+cl+"',\'Popup\', \'width=800,height=500,scrollbars=yes\');\" />";
	
			
			jQuery("#datagrid").jqGrid('setRowData',ids[i],{act:klik});
			
		}	
	},
	mtype:"GET",
	rownumWidth: 40,
	subGrid: true,
	subGridRowExpanded: function(subgrid_id, row_id) { 
	var subgrid_table_id, pager_id; 
	subgrid_table_id = subgrid_id+"_t"; 
	pager_id = "p_"+subgrid_table_id; 
	$("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>"); 
	
	jQuery("#"+subgrid_table_id).jqGrid({ 
		url:"grid/notbeng/dtlnota.php?id="+row_id, 
		datatype: "xml", 
		colNames: ['Id Part','Nama Part','Qty','Harga','Jumlah'], 
		colModel: [  
				{name:"id_part",index:"id_part",width:60}, 
				{name:"nama_part",index:"nama_part",width:200,align:"left"}, 
				{name:"qty",index:"qty",width:30,align:"left"}, 
				{name:"harga",index:"harga",width:70,align:"left"}, 
				{name:"jumlah",index:"jumlah",width:70,align:"left",sortable:false}], 
				rowNum:20, 
				width:750,
				pager: pager_id, 
				sortname: 'id_ns_dtl', 
				sortorder: "asc", 
				height: '100%' 
	}); 
	jQuery("#"+subgrid_table_id).jqGrid('navGrid',"#"+pager_id,{edit:false,add:false,del:false, search:false}) }, 
	subGridRowColapsed: function(subgrid_id, row_id) {
	}
	
	
});
 
jQuery("#datagrid").jqGrid('navGrid','#navGrid',{edit:false,add:false,del:false,search:false, beforeRefresh:function(){
		var no_ns = jQuery("#no_ns").val('');
	var no_pkb = jQuery("#no_pkb").val('');
			var nama_plg = jQuery("#nama_plg").val('');
			var no_polisi = jQuery("#no_polisi").val('');
			jQuery("#datagrid").jqGrid('setGridParam',{url:"grid/notbeng/listnotbeng.php",page:1});
			jQuery("#datagrid").trigger('reloadGrid');
		}},
{closeAfterEdit:true,width:500}, {closeAfterAdd:true,width:500},{});  
		
		
function gridReload1(){
var no_ns = jQuery("#no_ns").val();
	var no_pkb = jQuery("#no_pkb").val();
	var nama_plg = jQuery("#nama_plg").val();
var no_polisi = jQuery("#no_polisi").val();
	jQuery("#datagrid").jqGrid('setGridParam',{url:"grid/notbeng/listnotbeng.php?id_ns="+no_ns+"&no_pkb="+no_pkb+"&nama_plg="+nama_plg+"&no_polisi="+no_polisi,page:1}).trigger("reloadGrid");
}

</script> 
