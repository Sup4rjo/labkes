<link rel="stylesheet" type="text/css" href="../../css/styles.css" />
<script src="../../js/jsbilangan.js" type="text/javascript"></script>
<?php
error_reporting(0);
include("../../../koneksi/koneksi.php");
	$no_transaksi = $_REQUEST['id'];
?>

<style type="text/css">
#total {
	font-weight:bold;
	font-size:16px;
}
</style>
<?php
echo"<table width='100%' border='0'>
  <tr>
    <td class='fontjudul'>RETUR NOTA BENGKEL</td>
  </tr>
</table><hr /><form id='form2' name='form2' action='' method='post'>
<table width='100%'>
	<tr>
		<td class='fonttext'>Id NS</td>
      	<td><input type='text' class='inputform' name='id_ns' id='id_ns' /> <input name='cari2' type='button' value='...' onClick='popns()' /></td>
      	<td class='fonttext'>Id PKB</td>
      	<td><input type='text' class='inputform' name='id_pkb' id='id_pkb' /></td>
    </tr>
    <tr>
      	<td class='fonttext'>Nama</td>
      	<td><input type='text' class='inputform' name='nama' id='nama' /></td>
      	<td class='fonttext'>Id Registrasi</td>
      	<td><input type='text' class='inputform' name='id_registrasi' id='id_registrasi' /></td>
    </tr>
    <tr>
      	<td class='fonttext'>No.Polisi</td>
      	<td><input type='text' class='inputform' name='no_polisi' id='no_polisi' /></td>
    </tr>
</table>

<p>	<input type='hidden' name='jum' value='' />
	<input  type='hidden' name='temp_limit' id='temp_limit' value='' />
</p>



<table width='100%' id='tbl_dtl'>
<thead>
	<tr>
		<td align='center' width='5%' class='fonttext'>No</td>
      	<td align='center' width='25%' class='fonttext'>ID Part</td>
      	<td align='center' width='25%' class='fonttext'>Nama Part</td>
      	<td align='center' width='10%' class='fonttext'>Qty</td>
       	<td align='center' width='15%' class='fonttext'>Harga</td>
        <td align='center' width='12%' class='fonttext'>Jumlah</td>
      	<td align='center' width='8%' class='fonttext'>Retur</td>
    </tr>
</thead>
</table>

<table width='100%'>
	<tr>
    	<td align='center' width='5%'>&nbsp;</td>
      	<td align='center' width='25%'>&nbsp;</td>
      	<td align='center' width='25%'>&nbsp;</td>
      	<td align='center' width='10%'>&nbsp;</td>
       	<td align='center' width='15%'>&nbsp;</td>
        <td align='center' width='12%'><div id='total'></div></td>
      	<td align='center' width='8%'>&nbsp;</td>
    </tr>
</table></form>";?>


<p align="center"><input name="print" type="image" src="../../../img/cetak2.png" value="Cetak" id="print" onClick="cetak()" onMouseOver="this.src='../../../img/cetak.png'" onMouseOut="this.src='../../../img/cetak2.png'" /></p>
<script type="text/javascript">
var baris = 1;

function popns() //fungsi popup utk ns
{
	var width  = 400;
 	var height = 300;
 	var left   = (screen.width  - width)/2;
 	var top    = (screen.height - height)/2;
 	var params = 'width='+width+', height='+height+',scrollbars=yes';
 	params += ', top='+top+', left='+left;
	window.open('popns.php','',params);
};

function addNewRow() 
{
	var tbl = document.getElementById("tbl_dtl");
	var row = tbl.insertRow(tbl.rows.length);
	row.id = baris;
	
	var td0 = document.createElement("td");
	var td2 = document.createElement("td");
	var td3 = document.createElement("td");
	var td4 = document.createElement("td");
	var td5 = document.createElement("td");
	var td6 = document.createElement("td");
	var td7 = document.createElement("td");
	
	td0.appendChild(generateIndex(baris));
	td2.appendChild(generateKd(baris));
	td2.appendChild(generateId_Part(baris));
	td3.appendChild(generateNama_Part(baris));
	td4.appendChild(generateQty(baris));
	td5.appendChild(generateHarga(baris));
	td6.appendChild(generateJumlah(baris));
	td7.appendChild(generateRetur(baris));
	
	
	row.appendChild(td0);
	row.appendChild(td2);
	row.appendChild(td3);
	row.appendChild(td4);
	row.appendChild(td5);
	row.appendChild(td6);
	row.appendChild(td7);
	
	document.getElementById('Qty['+baris+']').setAttribute('onChange', 'hitungjml('+baris+')');
	
	document.getElementById('Harga['+baris+']').setAttribute('onChange', 'hitungjml('+baris+')');
	
	document.getElementById('row['+baris+']').setAttribute('onChange', 'cekretur('+baris+')');

	baris++;

}
function generateIndex(index) 
{
	var idx = document.createElement("input");
	idx.type = "text";
	idx.name = "index"+index+"";
	idx.id = "index["+index+"]";
	idx.value = index;
	idx.size = "3";
	idx.readOnly = "readonly";
	return idx;
}

function generateKd(index) 
{
	var idx = document.createElement("input");
	idx.type = "hidden";
	idx.name = "Kd"+index+"";
	idx.id = "Kd["+index+"]";
	return idx;
}

function generateId_Part(index) 
{
	var idx = document.createElement("input");
	idx.type = "text";
	idx.name = "Id_Part"+index+"";
	idx.id = "Id_Part["+index+"]";
	idx.size = "27";
	idx.readOnly = "readonly";
	return idx;
}
function generateNama_Part(index)
{
	var idx = document.createElement("input");
	idx.type = "text";
	idx.name = "Nama_Part[]";
	idx.id = "Nama_Part["+index+"]";
	idx.size = "27";
	idx.readOnly = "readonly";
	return idx;
}
function generateQty(index) 
{
	var idx = document.createElement("input");
	idx.type = "text";
	idx.name = "Qty"+index+"";
	idx.id = "Qty["+index+"]";
	idx.size = "8";
	return idx;
}
function generateHarga(index) 
{
	var idx = document.createElement("input");
	idx.type = "text";
	idx.name = "Harga"+index+"";
	idx.id = "Harga["+index+"]";
	idx.size = "15";
	return idx;
}
function generateJumlah(index) 
{
	var idx = document.createElement("input");
	idx.type = "text";
	idx.name = "Jumlah"+index+"";
	idx.id = "Jumlah["+index+"]";
	idx.size = "15";
	idx.readOnly= "readOnly";
	return idx;
}

function generateQtyRetur(index) 
{
	var idx = document.createElement("input");
	idx.type = "text";
	idx.name = "QtyRetur"+index+"";
	idx.id = "QtyRetur["+index+"]";
	idx.size = "1";
	return idx;
}

function generateRetur(index) 
{
	var idx = document.createElement("input");
	idx.type = "checkbox";
	idx.name = "row"+index+"";
	idx.id = "row["+index+"]";
	idx.size = "10";
	return idx;
}

	<?php
	if($_GET['ns']==""){
	}
	else{
	
		$query=mysql_query("SELECT * FROM ns a 
	left join pkb b on b.id_pkb=a.id_pkb
	left join registrasi c on c.id_registrasi=b.id_registrasi
	left join kendaraan d on d.no_polisi=c.no_polisi
	left join pelanggan e on e.id_plg=d.id_plg
	WHERE id_ns='".$_GET['ns']."'");
				
		$rs=mysql_fetch_array($query);
		
		}
		?>
	document.form2.id_ns.value='<?=$rs['id_ns'];?>';
	document.form2.id_pkb.value='<?=$rs['id_pkb'];?>';
	document.form2.id_registrasi.value='<?=$rs['id_registrasi'];?>';
	document.form2.nama.value='<?=$rs['nama'];?>';
	document.form2.no_polisi.value='<?=$rs['no_polisi'];?>';



	<?php $sql1 = mysql_query("SELECT a.id_ns_dtl,a.id_part,nama_part,qty_ns,qty_retur,harga_ns FROM ns_dtl a
INNER JOIN  part b ON a.id_part=b.id_part 
LEFT JOIN retur_dtl c ON c.id_ns_dtl=a.id_ns_dtl
WHERE id_ns='".$_GET['ns']."'");
		
	$i = 1;
	while ($rs1 = mysql_fetch_array($sql1))
	{	
	?>
	
		addNewRow();
		document.getElementById('Kd['+<?=$i;?>+']').value = '<?=$rs1['id_ns_dtl'];?>';
		document.getElementById('Id_Part['+<?=$i;?>+']').value = '<?=$rs1['id_part'];?>';
		document.getElementById('Nama_Part['+<?=$i;?>+']').value = '<?=$rs1['nama_part'];?>';
		document.getElementById('Qty['+<?=$i;?>+']').value = '<?=$rs1['qty_ns']-$rs1['qty_retur'];?>';
		document.getElementById('Harga['+<?=$i;?>+']').value = getNumber('<?=$rs1['harga_ns'];?>');
		hitungjml(<?=$i;?>);
		<?php
		$i++;
	}
	?>
hitungtotal();

function hitungjml(a)
{
	var ke1 = document.getElementById("Qty["+a+"]").value;
	var ke2 = getNumber(document.getElementById("Harga["+a+"]").value);
	var jml=0;
		
	jml=ke1*ke2;
	
 	
	document.getElementById("Jumlah["+a+"]").value = jml;
	hitungtotal();
}

function hitungtotal()
{
	var total = 0;
	for (var i=1;i<baris;i++)
	
	{
		if(document.getElementById("Jumlah["+i+"]")!=null)
		{
			total += getNumber(document.getElementById("Jumlah["+i+"]").value);
		}
		else
		{
			continue;
		}
		
	}
	
	document.getElementById("total").innerHTML = formatCurrency(total);
	
}

function cekretur()
{
	var flag=0;
	var tes = baris;
	
	for(var a=1;a<=tes-1;a++)
	{
		if(document.getElementById('row['+a+']').checked==true) 
		{
			flag++;
		}
		
	}	
		
	if(flag==0)
	{	
		document.getElementById('print').disabled=true;
	}
	else
	{
		document.getElementById('print').disabled=false;
	}

}

function hitungrow() 
{
	document.form2.jum.value= baris;
}

function cetak() // fungsi utk mencetak
{
	hitungrow();
	document.form2.action="actreturns.php";
	document.form2.submit();
}
</script>

