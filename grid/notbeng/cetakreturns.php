
<style type="text/css">
@media print
{
  .page-break  { display:block; page-break-before:always; }
}

.st_total {
	font-size: 9pt;
	font-weight: bold;
	font-family:Verdana, Arial, Helvetica, sans-serif;
}
.style6 {
	color: #000000;
	font-size: 9pt;
	font-weight: bold;
	font-family: Arial;
}
.style16 {
	color: #000000;
	font-size: 11pt;
	font-weight: bold;
	font-family: Arial;
}
.style7 {
	font-size: 14px;
	color: #000000;
}
.style9 {
	color: #000000;
	font-size: 9pt;
	font-weight: normal;
	font-family: Arial;
}
.style10 {font-size: 14px}

</style>
<script src="../../js/jsbilangan.js" type="text/javascript"></script>
<?php
	error_reporting(0);
	include("../../../koneksi/koneksi.php");
	$rns = $_GET['trx'];
	
	$sql = mysql_query("SELECT * FROM retur_dtl a
inner join retur_ns b on b.id_retur_ns=a.id_retur_ns
inner join ns_dtl c on c.id_ns_dtl=a.id_ns_dtl
inner join ns d on d.id_ns=c.id_ns
inner join pkb e on e.id_pkb=d.id_pkb
where a.id_retur_ns='".$rns."' group by a.id_retur_ns");
		$rs = mysql_fetch_array($sql);
?>

<form id="form2" name="form2" action="" method="post">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="7"><div align="center">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="82%" rowspan="3" valign="top">&nbsp;</td>
            <td colspan="3" class="style6"><div align="center" class="style16"><u>RETUR</u> NS</div></td>
            </tr>
          <tr>
            <td width="5%" class="style9">Nomor</td>
            <td width="1%"><div align="center">:</div></td>
            <td width="12%" class="style9"><?=$rs['id_retur_ns'];?></td>
          </tr>
          <tr>
            <td class="style9">Tanggal</td>
            <td><div align="center">:</div></td>
            <td class="style9"><?php echo date_format(date_create($rs['tgl_retur_ns']),'d-m-Y');?></td>
          </tr>
        </table>
            <hr />
      </div></td>
    </tr>
    <tr>
      <td width="166"><label for="name" class="style9">No. NS </label></td>
      <td width="14"><div align="center">:</div></td>
      <td width="351" class="style9">
      <?=$rs['id_ns'];?></td>
      <td width="30"><input type="hidden" name="jum" value="" /></td>
      <td width="70" class="style9">&nbsp;</td>
      <td width="14">&nbsp;</td>
      <td width="286" class="style9">&nbsp;</td>
    </tr>
    <tr>
      <td><label for="name" class="style9">No PKB</label></td>
      <td><div align="center">:</div></td>
      <td class="style9"><?=$rs['id_pkb'];?></td>
      <td width="30">&nbsp;</td>
      <td class="style9">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
    <td colspan="7"><hr/>    </td>
    </tr>
  </table>
  
  <table width="98%" border="0" align="center" cellpadding="1" cellspacing="0" id="tbl_dtl">
    <tr>
      <td width="20" class="style6"><div align="left" class="style6">
        No
      </div></td>
      <td width="143" class="style6">
        <div align="left" class="style6">ID Part</div>     </td>
      <td width="228" class="style6">
        <div align="left">Nama Part</div>      </td>
      <td width="26" class="style6"><div align="center" class="style6">
        <div align="right">Qty</div>
      </div></td>
      <td width="129" class="style6">&nbsp;</td>
    </tr>
      <tr>
      <td colspan="7">
      <hr />      </td>
      </tr>
  </table>
  <table width="98%" align="center">
    <tr>
      <td width="715" colspan="6"><hr /></td>
    </tr>
  </table>
  
  <table width="98%" border="0" align="center">
   <tr>
     <td colspan="3"><div align="center" class="style9">Sales</div></td>
     <td colspan="3">&nbsp;</td>
     <td colspan="3"><div align="center" class="style9">Pelanggan</div></td>
   </tr>
   <tr>
     <td colspan="3">&nbsp;</td>
     <td colspan="3">&nbsp;</td>
     <td colspan="3">&nbsp;</td>
   </tr>
   <tr>
     <td colspan="3">&nbsp;</td>
     <td colspan="3">&nbsp;</td>
     <td colspan="3">&nbsp;</td>
   </tr>
   <tr>
     <td width="82"><div align="right">(</div></td>
     <td width="89">
     <div align="center" class="style9"><?=$user;?></div></td>
     <td width="76">)</td>
     <td width="57">&nbsp;</td>
     <td width="86">&nbsp;</td>
     <td width="51">&nbsp;</td>
     <td width="79"><div align="right">( </div></td>
     <td width="88">&nbsp;</td>
     <td width="79">)</td>
   </tr>
 </table>

</form>

 <p>
   <script type="text/javascript">

//---yang load di awal

var baris=1;
//var trans='';


	
		
	<?php $sql1 = mysql_query("select * from retur_dtl,ns_dtl,part where 
retur_dtl.id_ns_dtl=ns_dtl.id_ns_dtl and 
part.id_part=ns_dtl.id_part

 and id_retur_ns='".$rns."'" ) or die(mysql_error());
	
	$i = 1;
	while ($rs1 = mysql_fetch_array($sql1)){	
	?>
	
	addNewRow();
	document.getElementById('index['+<?=$i;?>+']').innerHTML = '<?=$i;?>';
	document.getElementById('Id_Part['+<?=$i;?>+']').innerHTML = '<?=$rs1['id_part'];?>';
	document.getElementById('Nama_Part['+<?=$i;?>+']').innerHTML = '<?=$rs1['nama_part'];?>';
	document.getElementById('Qty['+<?=$i;?>+']').innerHTML = '<?=$rs1['qty_retur'];?>';
	
	document.getElementById('index['+<?=$i;?>+']').className = 'style9';
	document.getElementById('Id_Part['+<?=$i;?>+']').className ='style9';
	document.getElementById('Nama_Part['+<?=$i;?>+']').className ='style9';
	document.getElementById('Qty['+<?=$i;?>+']').className ='style9';
	<?php 
		$i++;
	}	
	?>

//---akhir--------






function addNewRow() {
	var tbl = document.getElementById("tbl_dtl");
	var row = tbl.insertRow(tbl.rows.length);
	row.id = baris;
	
	var td0 = document.createElement("td");
	var td2 = document.createElement("td");
	var td3 = document.createElement("td");
	var td4 = document.createElement("td");
	
	td0.appendChild(generateBaris(baris));
	td2.appendChild(generateId_Part(baris));
	td3.appendChild(generateNama_Part(baris));
	td4.appendChild(generateQty(baris));
	
	
	
	row.appendChild(td0);
	row.appendChild(td2);
	row.appendChild(td3);
	row.appendChild(td4);
	
	

baris++;

}
function generateBaris(index) {
	var idx = document.createElement("div");
	idx.name = "index"+index+"";
	idx.id = "index["+index+"]";
	idx.align = "left";
	return idx;
}

function generateId_Part(index) {
	var idx = document.createElement("div");
	
	idx.name = "Id_Part"+index+"";
	idx.id = "Id_Part["+index+"]";
	idx.size = "12";
	return idx;
}
function generateNama_Part(index) {
	var idx = document.createElement("div");
	
	idx.name = "Nama_Part[]";
	idx.id = "Nama_Part["+index+"]";
	idx.size = "20";	
	return idx;
}
function generateQty(index) {
	var idx = document.createElement("div");
	
	idx.name = "Qty"+index+"";
	idx.id = "Qty["+index+"]";
	idx.size = "1";
	idx.align = "right";
	return idx;
}

window.print();	

 </script>


