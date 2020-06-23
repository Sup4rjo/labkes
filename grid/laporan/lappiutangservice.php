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
<style type="text/css">
<!--

.style9 {color: #000000;
	font-size: 9pt;
	font-weight: normal;
	font-family: Arial;
}

.style9b {color: #000000;
	font-size: 9pt;
	font-weight: bold;
	font-family: Arial;
}
.style23 {
	color: #000000;
	font-size: 14pt;
	font-weight: bold;
	font-family: Arial;
}
.style24 {color: #000000}
.style25 {font-size: 12pt}

-->
</style>
<div>
<table width="941">
	<tr><td width="168" class="text">
    <font color="#000000">Tgl cari</font>
    <input type="text" id="bb_dari"  class="datepicker" onChange="doSearch1(arguments[0]||event)" size="12" style="border:dotted" />    </td>
    <td width="179" class="text">
    <font color="#000000">Sampai</font>
    <input type="text" id="bb_sampai" class="datepicker" onChange="doSearch1(arguments[0]||event)" size="12" style="border:dotted"/>    </td>
      <td><button class="btn btn-info" type="submit" name="button7" id="button7" value="CETAK" onClick="viewest()">Cetak</button></td>
    </tr>
    
  </table>
</div><br/>
<table id="datagrid"></table>  
<div id="navGrid"></div>
<script language="javascript">
jQuery("#datagrid").jqGrid({
   	url:'grid/laporan/listlaporanpiutang.php',
    datatype: "json",
    colNames:['PKB', 'Faktur','Nama','No Polisi','Total'],
    colModel:[ 
		{name:'no_pkb',index:'no_pkb',width:80,editable:false,editoptions:{readonly:true,size:10}},
		{name:'id_faktur',index:'id_faktur', width:60, align:"left",editable:true,editoptions:{size:10}},
		{name:'nama',index:'nama', width:80,editable:true,editoptions:{size:10}, editrules:{required:true}}, 
		{name:'no_polisi',index:'no_polisi', width:90,editable:true,editoptions:{size:25}}, 
		{name:'total',index:'total', width:60, align:"left",editable:true,editoptions:{size:10}}
		
	],
	rowNum:10,
	autowidth:true, 
	rowList:[10,20,30,40], 
	pager: '#navGrid', 
	sortname: 'id_faktur',
	sortorder: "desc", 
	height: 260,   
	viewrecords: true,
	editurl: 'edit.php',
	caption:"Laporan Piutang",
	gridComplete: function(){
		
		var ids = jQuery("#datagrid").jqGrid('getDataIDs');
		for(var i=0;i < ids.length;i++){
			var cl = ids[i];			
		be = "<input style='height:25px;width:50px;' type='button' value='View' onclick=\"window.open(\'form/frmpenjualan.php?id="+cl+"\',\'Penjualan Part Shop\', \'width=820,height=900,scrollbars=yes\');\" />";
			jQuery("#datagrid").jqGrid('setRowData',ids[i],{act:be});
		}	
	}
	
});


jQuery("#datagrid").jqGrid('navGrid','#navGrid',{edit:false,add:false,del:false,search:false, beforeRefresh:function(){
			var nama_plg = jQuery("#nama_plg").val('');
			var bb_dari = jQuery("#bb_dari").val('');
			var bb_sampai = jQuery("#bb_sampai").val('');
			jQuery("#datagrid").jqGrid('setGridParam',{url:"grid/laporan/listlaporanpiutang.php",page:1});
			jQuery("#datagrid").trigger('reloadGrid');
		}},
{closeAfterEdit:true,width:500}, {closeAfterAdd:true,width:500},{});  

function gridReload1(){
			var nama_plg = jQuery("#nama_plg").val();
	var bb_dari = jQuery("#bb_dari").val();
	var bb_sampai = jQuery("#bb_sampai").val();
	jQuery("#datagrid").jqGrid('setGridParam',{url:"grid/laporan/listlaporanpiutang.php?bb_dari="+bb_dari+"&bb_sampai="+bb_sampai+"&nama_plg="+nama_plg,page:1}).trigger("reloadGrid");
}

$(document).ready(function(){
  $(function() {
		$( ".datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});
	});
});

 
jQuery("#ms1").click( function() {
	var s;
	s = jQuery("#list10_d").jqGrid('getGridParam','selarrrow');
	alert(s);
	
});
</script> 
<script language="javascript">

$(document).ready(function(){
  $(function() {
		$( ".datepicker1" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});
	});
});


function viewest() 
{
	var width  = 1000;
 	var height = 500;
 	var left   = (screen.width  - width)/2;
 	var top    = (screen.height - height)/2;
 	var params = 'width='+width+', height='+height+',scrollbars=yes';
 	params += ', top='+top+', left='+left;
	var bb_dari = jQuery("#bb_dari").val();
	var bb_sampai = jQuery("#bb_sampai").val();
	window.open('grid/laporan/cetaklappiutang.php?dari='+bb_dari+'&sampai='+bb_sampai,'',params);
};


</script>