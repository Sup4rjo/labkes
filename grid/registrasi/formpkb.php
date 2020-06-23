<link rel="stylesheet" type="text/css" href="../../css/styles.css" />
<?php
include("../../../koneksi/koneksi.php");
$sql = mysql_query("SELECT * FROM registrasi a
LEFT JOIN kendaraan b ON a.no_polisi = b.no_polisi
LEFT JOIN pelanggan c ON c.id_plg = b.id_plg WHERE a.id_registrasi= '".$_GET['id']."'")or die (mysql_error());
		$rs = mysql_fetch_array($sql);
echo"<table width='100%' border='0'>
  <tr>
    <td class='fontjudul'>PERINTAH KERJA BENGKEL</td>
  </tr>
</table>
    <hr />    
		<form id='form2' name='form2' action='' method='post' >
			<input type='hidden' name='id_plg' id='id_plg'/>
      		<input type='hidden' name='jum' id='jum' value='' />
      		<input type='hidden' name='jum1' id='jum1' value='' />
     
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
<div id='myDiv2'></div>
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
	
	document.form2.tlp.value='<?=$rs['tlp'];?>';
	document.form2.kota.value='<?=$rs['kota'];?>';
	document.form2.no_polisi.value='<?=$rs['no_polisi'];?>';
	document.form2.type.value='<?=$rs['type'];?>';
	document.form2.no_rangka.value='<?=$rs['no_rangka'];?>';
	document.form2.odometer.value='<?=$rs['odometer'];?>';

var baris1=1;
addNewRow1();
function addNewRow1() {
var tbl = document.getElementById("tbl_1");
var row = tbl.insertRow(tbl.rows.length);
row.id = 't1'+baris1;

var td1 = document.createElement("td");
var td2 = document.createElement("td");
var td3 = document.createElement("td");
var td4 = document.createElement("td");

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
		window.open('popjasaservice.php?row='+a+'','',params);
};
function popmekanik(a){
	
	var width  = 500;
 	var height = 400;
 	var left   = (screen.width  - width)/2;
 	var top    = (screen.height - height)/2;
  	var params = 'width='+width+', height='+height+',scrollbars=yes';
 	params += ', top='+top+', left='+left;
		window.open('popmekanik.php?row='+a+'','',params);
};

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



function delRow1(id){ 
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
	document.form2.action="insertregis.php?idregis=<?=$_GET['id']?>&flag=pkb";
	document.form2.submit();
	
}
</script>

