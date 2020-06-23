<link rel="stylesheet" href="css/ui.jqgrid.css" type="text/css" media="all" /> 
<link type="text/css" href="themes/ui-lightness/ui.all.css" rel="stylesheet" />
<script src="js/jquery-1.4.js" type="text/javascript" charset="utf-8"/> </script>
<script src="js/jquery-1.5.2.min.js" type="text/javascript" charset="utf-8"></script> 
<script src="js/jquery-ui-1.8.13.custom.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/i18n/grid.locale-en.js" type="text/javascript" charset="utf-8"></script>
<script src="js/jquery.jqGrid.src.js" type="text/javascript" charset="utf-8"></script> 
<script src="js/jquery.table.addrow.js" type="text/javascript" charset="utf-8"></script>
<script src="js/engineSearch.js" type="text/javascript" charset="utf-8"></script>  
<div style="padding-bottom:20px; float: right;"><a href="javascript: void(0)" 
   onclick="window.open('grid/registrasi/popupregistrasi.php', 
  'windowname1', 
  'width=800, height=250,scrollbars=yes'); 
   return false;">
   <button class="btn btn-success">Tambah</button></a></br></div>
<div style="padding-bottom:20px;">
<table width="844">
	<tr><td width="230" class="text"><font color="#000000">No Registrasi</font>
    <input type="text" id="no_regis" onKeyDown="doSearch1(arguments[0]||event)" size="16" style="border:dotted" />
    </td>
    <td width="274" class="text">
    <font color="#000000">Nama Pelanggan</font>
    <input type="text" id="nama_plg" onKeyDown="doSearch1(arguments[0]||event)" size="20" style="border:dotted"/>    </td>
    <td width="324" class="text"><font color="#000000">No Polisi</font>
      <input type="text" id="no_polisi" onkeydown="doSearch1(arguments[0]||event)" size="20" style="border:dotted"/></td>
	</tr>
    </table>
</div>
<table id="datagrid"></table>  
<div id="navGrid"></div>
<script language="javascript">
jQuery("#datagrid").jqGrid({
   	url:'grid/registrasi/listregistrasi.php',
    datatype: "json",
    colNames:['Id', 'Nama', 'No Polisi', 'Type', 'Odometer','Tgl','Buat PKB'],
    colModel:[ 
		{name:'id_registrasi',index:'id_registrasi', width:60, editable:true,editoptions:{size:15}},
		{name:'nama',index:'nama', width:150, editable:true, editoptions:{size:15}},
		{name:'no_polisi',index:'no_polisi', width:60, align:"center",editable:true,editoptions:{size:10}},
		{name:'type',index:'type', width:60, align:"right",editable:true,editoptions:{size:10}},
		{name:'odometer',index:'odometer', width:60, align:"right",editable:true,editoptions:{size:10}},
		{name:'tgl',index:'tgl', width:60, align:"right",editable:true,editoptions:{size:10}},
	{name:'act2',index:'act2', width:40,align:"center",editable:false,editoptions:{size:10}}
	],
	rowNum:10,
	autowidth:true, 
	pager: '#navGrid', 
	sortname: 'id_registrasi',
	sortorder: "desc", 
	height: 200,   
	caption:"Registrasi",
	gridComplete: function(){
		
		var ids = jQuery("#datagrid").jqGrid('getDataIDs');
		for(var i=0;i < ids.length;i++){
				var c2= ids[i];
		
		
		klik2 = "<input style='height:25px;width:50px;' type='button' value='PKB' onclick=\"pilih('"+c2+"');\" />";
			
			
			jQuery("#datagrid").jqGrid('setRowData',ids[i],{act2:klik2});
		}	
	}
	
})
jQuery("#datagrid").jqGrid('navGrid','#navGrid', {edit:false,add:false,del:false,view:false,search:false, beforeRefresh:function(){
	var no_regis = jQuery("#no_regis").val('');
			var nama_plg = jQuery("#nama_plg").val('');
			var no_polisi = jQuery("#no_polisi").val('');
			jQuery("#datagrid").jqGrid('setGridParam',{url:"grid/registrasi/listregistrasi.php",page:1});
			jQuery("#datagrid").trigger('reloadGrid');
		}},{jqModal:false,closeOnEscape:true,height:250}); 
function gridReload1(){
	var no_regis = jQuery("#no_regis").val();
	var nama_plg = jQuery("#nama_plg").val();
var no_polisi = jQuery("#no_polisi").val();
	jQuery("#datagrid").jqGrid('setGridParam',{url:"grid/registrasi/listregistrasi.php?no_regis="+no_regis+"&nama_plg="+nama_plg+"&no_polisi="+no_polisi,page:1}).trigger("reloadGrid");
}
function pilih(a){
var width  = 990;
 	var height = 700;
 	var left   = (screen.width  - width)/2;
 	var top    = (screen.height - height)/2;
 	var params = 'width='+width+', height='+height+',scrollbars=yes';
 	params += ', top='+top+', left='+left;
	
window.open('grid/registrasi/formpkb.php?id='+a+'','',params);
}
</script> 
