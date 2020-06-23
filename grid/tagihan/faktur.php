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
   onclick="window.open('grid/tagihan/formfaktur.php', 
  'windowname1', 
  'width=850, height=650,scrollbars=yes'); 
   return false;"><button class="btn btn-success">Tambah</button></a></div>
<div style="padding-bottom:20px;">
	<table width="867">
	<tr><td width="263" class="text"><font color="#000000">No Faktur</font>
    <input type="text" id="no_faktur" onKeyDown="doSearch1(arguments[0]||event)" size="16" style="border:dotted" />
    </td>
    <td width="319" class="text">
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
   	url:'grid/tagihan/listfaktur.php',
    datatype: "json",
    colNames:['Id faktur','Tgl faktur','Id PKB','Tgl PKB', 'Nama','Alamat', 'No Polisi','Cetak'],
    colModel:[ 
		{name:'id_faktur',index:'id_faktur', width:50, editable:true,editoptions:{size:15}},
		{name:'tgl_faktur',index:'tgl_faktur', width:60, editable:true,editoptions:{size:15}},
		{name:'id_pkb',index:'id_pkb', width:50, editable:true,editoptions:{size:15}},
			{name:'tgl_pkb',index:'tgl_pkb', width:60, editable:true,editoptions:{size:15}},
		{name:'nama',index:'nama', width:80, editable:true, editoptions:{size:15}},
		{name:'alamat',index:'alamat', width:80, editable:true, editoptions:{size:15}},
		{name:'no_polisi',index:'no_polisi', width:60, align:"center",editable:true,editoptions:{size:10}},
	
	{name:'act',index:'act', width:20,align:"right",editable:false,editoptions:{size:10}}
	],
	rowNum:10,
	autowidth:true, 
	pager: '#navGrid', 
	sortname: 'id_faktur',
	sortorder: "desc", 
	height: 200,   
	caption:"Faktur",
	gridComplete: function(){
		
		var ids = jQuery("#datagrid").jqGrid('getDataIDs');
		for(var i=0;i < ids.length;i++){
			var cl = ids[i];
				var c2= ids[i];
		
		klik = "<input style='height:25px;width:50px;' type='button' value='Cetak' onclick=\"window.open(\'grid/tagihan/cetakfaktur.php?id="+cl+"',\'Popup\', \'width=800,height=500,scrollbars=yes\');\" />";
		klik2 = "<input style='height:25px;width:50px;' type='button' value='faktur' onclick=\"pilih('"+c2+"');\" />";
			
			jQuery("#datagrid").jqGrid('setRowData',ids[i],{act:klik});
			jQuery("#datagrid").jqGrid('setRowData',ids[i],{act2:klik2});
		}	
	}
	
})
jQuery("#datagrid").jqGrid('navGrid','#navGrid', {edit:false,add:false,del:false,view:false,search:false, beforeRefresh:function(){
	var no_faktur = jQuery("#no_faktur").val('');
			var nama_plg = jQuery("#nama_plg").val('');
			var no_polisi = jQuery("#no_polisi").val('');
			jQuery("#datagrid").jqGrid('setGridParam',{url:"grid/tagihan/listfaktur.php",page:1});
			jQuery("#datagrid").trigger('reloadGrid');
		}},{jqModal:false,closeOnEscape:true,height:250}); 
function gridReload1(){
	var no_faktur = jQuery("#no_faktur").val();
	var nama_plg = jQuery("#nama_plg").val();
var no_polisi = jQuery("#no_polisi").val();
	jQuery("#datagrid").jqGrid('setGridParam',{url:"grid/tagihan/listfaktur.php?no_faktur="+no_faktur+"&nama_plg="+nama_plg+"&no_polisi="+no_polisi,page:1}).trigger("reloadGrid");
}

function pilih(a){
var width  = 500;
 	var height = 200;
 	var left   = (screen.width  - width)/2;
 	var top    = (screen.height - height)/2;
 	var params = 'width='+width+', height='+height+',scrollbars=yes';
 	params += ', top='+top+', left='+left;
	
window.open('grid/insertfaktur.php?id='+a+'','',params);
}
</script> 
