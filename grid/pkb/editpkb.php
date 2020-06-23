<?php
error_reporting(0);
session_start();
?>
<link rel="stylesheet" type="text/css" href="../../css/styles.css" />
<?php
include("../../../koneksi/koneksi.php");
$sql = mysql_query("SELECT * FROM pkb a
LEFT JOIN registrasi b ON b.id_registrasi=a.id_registrasi
LEFT JOIN kendaraan c ON c.no_polisi = b.no_polisi
LEFT JOIN pelanggan d ON d.id_plg = c.id_plg WHERE id_pkb= '".$_GET['ids']."'")or die (mysql_error());
		$rs = mysql_fetch_array($sql);

echo"<form id='form2' name='form2' action='' method='post' >
 <input type='hidden' name='id_plg' id='id_plg'/>
      <input type='hidden' name='jum' id='jum' value='' />
<table width='100%' border='0'>
  <tr>
    <td class='fontjudul'>PERINTAH KERJA BENGKEL</td>
  </tr>
</table>
    <hr />    
<table width='96%' border='0'>
	<tr>
		<td class='fonttext'>Nama</td>
        <td><input type='text' class='inputform' name='nama' id='nama' disabled='disabled'/></td>
        <td class='fonttext'>No.Polisi</td>
        <td><input type='text' class='inputform' name='no_polisi' id='no_polisi'  disabled='disabled'/></td>
    </tr>
    <tr>
        <td rowspan='2' class='fonttext'>Alamat</td>
        <td rowspan='2'><textarea name='textarea' id='alamat' cols='34' rows='3'  disabled='disabled'></textarea></td>
        <td class='fonttext'>Type</td>
        <td><input type='text' class='inputform' name='type' id='type' disabled='disabled'/></td>
    </tr>
    <tr>
          <td class='fonttext'>No.Telp</td>
          <td><input type='text' class='inputform' name='tlp' id='tlp'  disabled='disabled'/></td>
    </tr>
    <tr>
          <td class='fonttext'>Kota</td>
          <td><input type='text' class='inputform' name='kota' id='kota'  disabled='disabled'/></td>
          <td class='fonttext'>No.Rangka</td>
          <td><input type='text' class='inputform' name='no_rangka' id='no_rangka'  disabled='disabled'/></td>
    </tr>
    <tr>
          <td class='fonttext'>Warna</td>
          <td><input type='text' class='inputform' name='nama_warna' id='nama_warna' disabled='disabled'/></td>
          <td class='fonttext'>Odometer</td>
          <td><input type='text' class='inputform' name='odometer' id='odometer'  value=''/></td>
    </tr>
    <tr height='5px'>
  	  <td colspan='4'></td>
  	</tr>
</table>

<table width='100%'>
   <tr>
       <td class='fonttext'>Keluhan</td>
   </tr>
   <tr>
       <td><textarea name='keluhan' id='keluhan' cols='117' rows='3'></textarea></td>
   </tr>
   <tr height='5px;'>
   	   <td></td>
   </tr>
   <tr>
       <td class='fonttext'>Perintah Kerja</td>
   </tr>
   <tr>
       <td><textarea name='perintah' id='perintah' cols='117' rows='3'></textarea></td>
   </tr>
   <tr>
       <td align='right'><input name='Cetak' type='submit' value='SIMPAN' id='cetak' onClick='cetakMM()'/></td>
   </tr>
</table>
<div id='myDiv'></div>
<b>JASA PERBAIKAN</b>
    
<table align='center' width='100%' id='tbl_1'>
<thead>
    <tr>
   
        <td align='center' width='45%' height='20px' class='fonttext'>LABOR NAME</td>
        <td align='center' width='15%' height='20px' class='fonttext'>HARGA</td>
        <td align='center' width='33%' height='20px' class='fonttext'>MEKANIK</td>
        <td align='center' width='7%' height='20px' class='fonttext'>Act</td>
    
    </tr>
</thead>
</table>
<p><input type='button' value='TAMBAH'  id='New2' onClick='addNewRow1()'/></p>
</form>";?>
<script type="text/javascript">
document.form2.alamat.value='<?=$rs['alamat'];?>';
	document.form2.nama.value='<?=$rs['nama'];?>';
	document.form2.odometer.value='<?=$rs['odometer'];?>';
	document.form2.tlp.value='<?=$rs['tlp'];?>';
	document.form2.kota.value='<?=$rs['kota'];?>';
	document.form2.no_polisi.value='<?=$rs['no_polisi'];?>';
	document.form2.type.value='<?=$rs['type'];?>';
	document.form2.nama_warna.value='<?=$rs['warna'];?>';
	document.form2.no_rangka.value='<?=$rs['no_rangka'];?>';
	document.form2.keluhan.value='<?=$rs['keluhan'];?>';
	document.form2.perintah.value='<?=$rs['perintah'];?>';
	
var baris1=1;



function addNewRow1() {
var tbl = document.getElementById("tbl_1");
var row = tbl.insertRow(tbl.rows.length);
row.id = 't1'+baris1;

var td1 = document.createElement("td");
var td2 = document.createElement("td");
var td3 = document.createElement("td");
var td4 = document.createElement("td");

td1.appendChild(generateId_dtl_pkb(baris1));
td1.appendChild(generateId_Jasa(baris1));
td1.appendChild(generateNama_Jasa(baris1));
td1.appendChild(generateCari1(baris1));
td2.appendChild(generateHargaLabor(baris1));
td3.appendChild(generateId_Mekanik(baris1));
td3.appendChild(generateMekanik(baris1));
td3.appendChild(generateCari2(baris1));
td4.appendChild(generateDel1(baris1));

row.appendChild(td1);
row.appendChild(td2);
row.appendChild(td3);
row.appendChild(td4);

document.getElementById('Cari1['+baris1+']').setAttribute('onclick', 'popjasa('+baris1+')');
document.getElementById('Cari2['+baris1+']').setAttribute('onclick', 'popmekanik('+baris1+')');
document.getElementById('del1['+baris1+']').setAttribute('onclick', 'delRow1('+baris1+')');
baris1++;
}

function popjasa(a){
	var width  = 550;
 	var height = 400;
 	var left   = (screen.width  - width)/2;
 	var top    = (screen.height - height)/2;
  	var params = 'width='+width+', height='+height+',scrollbars=yes';
 	params += ', top='+top+', left='+left;
		window.open('../registrasi/popjasaservice.php?row='+a+'','',params);
};
function popmekanik(a){
	
	var width  = 500;
 	var height = 400;
 	var left   = (screen.width  - width)/2;
 	var top    = (screen.height - height)/2;
  	var params = 'width='+width+', height='+height+',scrollbars=yes';
 	params += ', top='+top+', left='+left;
		window.open('../registrasi/popmekanik.php?row='+a+'','',params);
};
function generateId_dtl_pkb(index) {
var idx = document.createElement("input");
idx.type = "hidden";
idx.name = "Id_dtl_pkb"+index+"";
idx.id = "Id_dtl_pkb["+index+"]";
idx.size = "3";
idx.readOnly = "readonly";
return idx;
}
function generateId_Jasa(index) {
var idx = document.createElement("input");
idx.type = "hidden";
idx.name = "Id_Jasa"+index+"";
idx.id = "Id_Jasa["+index+"]";
idx.size = "3";
idx.readOnly = "readonly";
return idx;
}
function generateId_Mekanik(index) {
var idx = document.createElement("input");
idx.type = "hidden";
idx.name = "Id_Mekanik"+index+"";
idx.id = "Id_Mekanik["+index+"]";
idx.size = "3";
idx.readOnly = "readonly";
return idx;
}

function generateMekanik(index) {
var idx = document.createElement("input");
idx.type = "text";
idx.name = "Mekanik"+index+"";
idx.id = "Mekanik["+index+"]";
idx.size = "30";
idx.readOnly = "readonly";
return idx;
}
function generateNama_Jasa(index) {
var idx = document.createElement("input");
idx.type = "text";
idx.name = "Nama_Jasa"+index+"";
idx.id = "Nama_Jasa["+index+"]";
idx.size = "45";
idx.readOnly = "readonly";
return idx;
}
function generateHargaLabor(index) {
var idx = document.createElement("input");
idx.type = "text";
idx.name = "HargaLabor"+index+"";
idx.id = "HargaLabor["+index+"]";
idx.size = "14";
return idx;
}

function generateCari1(index) {
	var idx = document.createElement("input");
	idx.type = "button";
	idx.name = "Cari1";
	idx.value = "...";
	idx.id = "Cari1["+index+"]";
	idx.size = "5";
	return idx;
}
function generateCari2(index) {
	var idx = document.createElement("input");
	idx.type = "button";
	idx.name = "Cari2";
	idx.value = "...";
	idx.id = "Cari2["+index+"]";
	idx.size = "5";
	return idx;
}

function generateDel1(index) {
var idx = document.createElement("input");
idx.type = "button";
idx.name = "del1"+index+"";
idx.id = "del1["+index+"]";
idx.size = "10";
idx.value = "X";
return idx;

}
function saveID(id) {
var idx = document.createElement("input");
idx.type = "text";
idx.name = "delete1"+id+"";
idx.id = "delete1["+id+"]";
return idx;
}
var del1 = 1;
function delRow1(id){ 
	document.getElementById("myDiv").appendChild(saveID(id));
	document.getElementById('delete1['+id+']').value = document.getElementById('Id_dtl_pkb['+id+']').value;
	del1++;
	var el = document.getElementById("t1"+id);
	el.parentNode.removeChild(el);
	return false;
}
function hitungrow() 
{
	document.form2.jum.value= baris1;
}

function cetakMM(){
hitungrow() ;
	document.form2.action="updatepkb.php?idpkb=<?=$_GET['ids']?>";
	document.form2.submit();
	
}
<?php 

$sql1 = mysql_query("select * from pkb_detail a, jasa_service b, karyawan c where a.id_jasa=b.id_jasa and a.id_karyawan=c.id_kry and id_pkb = '".$_GET['ids']."'");
$i=1;
			while($rs1=mysql_fetch_array($sql1)){
		?>
			addNewRow1();
			document.getElementById('Id_dtl_pkb['+<?=$i;?>+']').value = '<?=$rs1['id_dtl_pkb'];?>';
			document.getElementById('Id_Jasa['+<?=$i;?>+']').value = '<?=$rs1['id_jasa'];?>';
			document.getElementById('Nama_Jasa['+<?=$i;?>+']').value = '<?=$rs1['nama_jasa'];?>';
			document.getElementById('Id_Mekanik['+<?=$i;?>+']').value = '<?=$rs1['id_karyawan'];?>';
			document.getElementById('Mekanik['+<?=$i;?>+']').value = '<?=$rs1['nm_kry'];?>';
			document.getElementById('HargaLabor['+<?=$i;?>+']').value = '<?=$rs1['harga'];?>';
		<?php 
			$i++;
		}
		?>
</script>
