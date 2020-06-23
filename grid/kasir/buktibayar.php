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
   onclick="window.open('grid/kasir/formbuktibayar.php', 
  'windowname1', 
  'width=800, height=650,scrollbars=yes'); 
   return false;"><button class="btn btn-success">Tambah</button></a> </div>
	<table width="960">
	<tr><td width="187" class="text"><font color="#000000">Id BB</font>
    <input type="text" id="id_bb" onKeyDown="doSearch1(arguments[0]||event)" size="16" style="border:dotted" />
    </td>
    <td width="761" class="text">
    <font color="#000000">Nama Pelanggan</font>
    <input type="text" id="nama_plg" onKeyDown="doSearch1(arguments[0]||event)" size="20" style="border:dotted"/>    </td>
   
	</tr>
  </table><br/>

<table id="datagrid"></table>  
<div id="navGrid"></div>
<script language="javascript">
jQuery("#datagrid").jqGrid({
   	url:'grid/kasir/listbuktibayar.php',
    datatype: "json",
    colNames:['ID BB','Nama','Alamat','Tlp','Total','Action'],
    colModel:[ 
	{name:'id_bb',index:'id_bb', width:100,fixed:false,editable:false,editoptions:{readonly:true,size:10}},
		{name:'nama',index:'nama', width:80, fixed:false,editable:false,editoptions:{readonly:true,size:10}}, 
		{name:'alamat',index:'alamat', width:80, fixed:false,editable:false,editoptions:{readonly:true,size:10}}, 
		{name:'tlp',index:'tlp', width:80, fixed:false,editable:false,editoptions:{readonly:true,size:10}}, 
		{name:'total',index:'total', width:80, fixed:false,editable:false,editoptions:{readonly:true,size:10}}, 
		{name:'act',index:'act', width:34,align:"right",editable:false,editoptions:{size:10}}
	],
	rowNum:10,
	autowidth:true, 
	pager: '#navGrid', 
	sortname: 'id_buktibayar',
	sortorder: "desc", 
	height: 200,
	subGrid: true,
	caption:"Bukti Bayar",
	editurl: 'grid/editnotbeng.php',
	gridComplete: function(){
		
		var ids = jQuery("#datagrid").jqGrid('getDataIDs');
		for(var i=0;i < ids.length;i++){
			var cl = ids[i];
				var c2= ids[i];
		
		klik = "<input style='height:25px;width:50px;' type='button' value='CETAK' onclick=\"window.open('grid/kasir/cetakbuktibayar.php?id="+cl+"',\'Popup\', \'width=800,height=500,scrollbars=yes\');\" />";
	
			
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
			url:"grid/kasir/dtlbb.php?id="+row_id, 
		datatype: "xml", 
			colNames: ['Id Faktur','No_polisi','Total','Diskon','Harga(Net)'], 
		colModel: [  
				{name:"id_faktur",index:"id_faktur",width:100}, 
				{name:"no_polisi",index:"no_polisi",width:60,align:"left"}, 
				{name:"total",index:"total",width:70,align:"left"}, 
				{name:"diskon",index:"diskon",width:70,align:"left"}, 
				{name:"jumlah",index:"jumlah",width:70,align:"left",sortable:false}], 
				rowNum:20, 
					autowidth:true,
				pager: pager_id, 
				sortname: 'PK_dtl_buktibayar', 
				sortorder: "asc", 
				height: '100%' 
	}); 
	jQuery("#"+subgrid_table_id).jqGrid('navGrid',"#"+pager_id,{edit:false,add:false,del:false, search:false}) }, 
	subGridRowColapsed: function(subgrid_id, row_id) {
	}
	
	
});
jQuery("#datagrid").jqGrid('navGrid','#navGrid',{edit:false,add:false,del:false,search:false, beforeRefresh:function(){
		var id_bb = jQuery("#id_bb").val('');
			var nama_plg = jQuery("#nama_plg").val('');
			jQuery("#datagrid").jqGrid('setGridParam',{url:"grid/kasir/listbuktibayar.php",page:1});
			jQuery("#datagrid").trigger('reloadGrid');
		}},
{closeAfterEdit:true,width:500}, {closeAfterAdd:true,width:500},{});  
		
		
function gridReload1(){
var id_bb = jQuery("#id_bb").val();
	var nama_plg = jQuery("#nama_plg").val();
	jQuery("#datagrid").jqGrid('setGridParam',{url:"grid/kasir/listbuktibayar.php?id_bb="+id_bb+"&nama_plg="+nama_plg,page:1}).trigger("reloadGrid");
}

</script> 
