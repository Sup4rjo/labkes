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
<table id="list10_d"></table>
<div id="pager10_d"></div>

<script language="javascript">
jQuery("#datagrid").jqGrid({
 	
   	url:'grid/master/plg/listplg.php',
    datatype: "json",
    colNames:['Id Plg','Nama','Alamat','Tlp','Kota'],
    colModel:[ 
		 {name:'id_plg',index:'id_plg', width:10,editable:true,hidden:true,editoptions:{size:30}}, 
		{name:'nama',index:'nama', width:120,editable:true,editoptions:{size:30}, editrules:{required:true}}, 
			{name:'alamat',index:'alamat', width:120,editable:true,editoptions:{size:30},edittype:"textarea", editrules:{required:true}}, 
		{name:'tlp',index:'tlp', width:120,editable:true,editoptions:{size:20}, editrules:{required:true}}, 
		{name:'kota',index:'kota', width:120,editable:true,editoptions:{size:20}}, 
	],
	rowNum:10,
	autowidth:true,
	rownumbers: true,
	loadonce:true,
	rownumWidth: 40,
	rowList:[10,20,30,40], 
	pager: '#navGrid', 
	sortname: 'id_plg',  
	sortorder: "asc", 
	height: 100,
	viewrecords: true,
	editurl: 'grid/master/plg/editplg.php',
	caption:"Pelanggan",
	mtype:"GET",
	
	onSelectRow:function(ids){
		if(ids == null) {
			ids=0;
			
			if(jQuery("#list10_d").jqGrid('getGridParam','records') >0 )
			{	
				jQuery("#list10_d").jqGrid('setGridParam',{url:"grid/master/plg/subplg.php?q=1&id="+ids,page:1});
				jQuery("#list10_d").jqGrid('setCaption',"Kendaraan: "+ids)
				.trigger('reloadGrid');
			}
		} else {
			selName = jQuery('#datagrid').getRowData(ids);
			jQuery("#list10_d").jqGrid('setGridParam',{url:"grid/master/plg/subplg.php?q=1&id="+ids,page:1});
			jQuery("#list10_d").jqGrid('setCaption',"Kendaraan Dengan Nomor Pelanggan: "+ids)
			.trigger('reloadGrid');			
		}
	}
}); 

jQuery("#datagrid").jqGrid('navGrid','#navGrid',{edit:true,add:true,del:true,view:true,search:false},
{closeAfterEdit:true,width:500}, {closeAfterAdd:true},{},{},{width:500});  
jQuery("#datagrid").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false}); 


function gridReload1(){
	var id_plg = jQuery("#id_plg").val();
	var nama_plg = jQuery("#nama_plg").val();
	var alamat_plg = jQuery("#alamat_plg").val();
	var tlp_plg = jQuery("#tlp_plg").val();
	var hp_plg = jQuery("#hp_plg").val();
	jQuery("#datagrid").jqGrid('setGridParam',{url:"grid/master/plg/listplg.php?id_plg="+id_plg+"&nama_plg="+nama_plg+"&alamat_plg="+alamat_plg+"&tlp_plg="+tlp_plg+"&hp_plg="+hp_plg+"&q=1",page:1}).trigger("reloadGrid");
}

var temp = "--:--";
jQuery("#list10_d").jqGrid({
	height: 100,
	
   	url:'grid/master/plg/subplg.php?q=2',
	datatype: "json",
   	colNames:['No Polisi','No Rangka','Type','Warna'],
   	colModel:[
   		
		{name:'no_polisi',index:'no_polisi', width:110, editable:true},
		{name:'no_rangka',index:'no_rangka', width:130, editable:true},
		{name:'type',index:'type', width:130, editable:true},
		{name:'warna',index:'warna', width:130, editable:true},
   	],
   	rowNum:10,
   	rowList:[10,20,30,40],
   	rownumbers: true,
	rownumWidth: 40,
/*	loadonce:true,*/
		autowidth:true,
   	pager: '#pager10_d',
   	sortname: 'no_polisi',
    viewrecords: true,
    sortorder: "desc",
	caption:"Kendaraan",
	editurl: "grid/master/plg/edimobil.php",
	mtype: "GET",
	onSelectRow:function(ids){
    	
		if(ids == null) {
			//ids=0;
			
			if(jQuery("#datagrid").jqGrid('getGridParam','records') >0 )
			{	
				jQuery("#datagrid").jqGrid('setGridParam',{url:"grid/listplg?q=1&id="+ids,page:1,datatype: "json"});
				jQuery("#datagrid").jqGrid('setCaption',"Pelanggan: "+ids)
				.trigger('reloadGrid');
			}
		} else {
			//selName = jQuery('#datagrid').getRowData(ids);
			
			jQuery("#datagrid").jqGrid('setGridParam',{url:"grid/master/plg/listplg.php?q=2&id="+ids,page:1,datatype: "json"});
			jQuery("#datagrid").jqGrid('setCaption',"Pelanggan Dengan Nomor Kendaraan: "+ids)
			.trigger('reloadGrid');			
		}
	}

}).navGrid('#pager10_d',{add:true,edit:true,del:true, view:true, search:false},
		{mtype:"POST", reloadAfterSubmit:true, closeAfterEdit:true,width:500,serializeEditData: function (postdata) {
      var rowdata = jQuery('#list10_d').getRowData(postdata.id);
      // edit data
      return {id: rowdata.id_plg, oper: postdata.oper, no_polisi:postdata.no_polisi,no_rangka:postdata.no_rangka,type:postdata.type,warna:postdata.warna};
 }}, {mtype:"GET", reloadAfterSubmit:true, closeAfterAdd:true,width:500,serializeEditData: function (postdata) { 
      // add data
      return {id_plg: selName.id_plg, oper: postdata.oper,no_polisi:postdata.no_polisi,no_rangka:postdata.no_rangka,type:postdata.type,warna:postdata.warna};
 }},{mtype:"POST", reloadAfterSubmit:true, serializeDelData: function (postdata) {
 		var rowdata = jQuery('#list10_d').getRowData(postdata.id);
      
      // delete data
      return {id_plg: rowdata.id_plg, oper: postdata.oper, no_polisi: postdata.id};
 }},
 {},{width:500});

jQuery("#list10_d").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false}); 


jQuery("#ms1").click( function() {
	
	var s;
	s = jQuery("#list10_d").jqGrid('getGridParam','selarrrow');
	alert(s);
	
});
</script> 