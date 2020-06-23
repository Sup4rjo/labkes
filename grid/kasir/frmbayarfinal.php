<link rel="stylesheet" type="text/css" href="../../css/styles.css" />
<script src="../../js/jsbilangan.js" type="text/javascript"></script>
<?php
error_reporting(0);
	include"../../../koneksi/koneksi.php";
echo"<form id='form2' name='form2' action='' method='post'>
  <table width='670' border='0' align='center'>
    <tr>
      <td class='fonttext'>ID Pelanggan</td>
      <td><input type='text' name='id_plg' id='id_plg' value=''/></td>
      <td class='fonttext'>Tanggal</td>
      <td><input type='text' name='tgl' id='tgl' value='' readonly='readonly'/></td>
    </tr>
    <tr>
      <td class='fonttext'>Nama Pelanggan</td>
      <td><input type='text' name='nama_pelanggan' id='nama_pelanggan' value=''/></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td class='fonttext'>Alamat Pelanggan</td>
      <td>  <label>
  <textarea name='alamat' id='alamat' cols='15' rows='3' ></textarea>
  </label></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <table width='748' align='center' id='rincian'>
    <tr>
      <td width='17'><input type='hidden' name='jum' value='' /></td>
      <td width='119'><strong>Jumlah Transaksi</strong></td>
      <td width='10'>&nbsp;</td>
      <td width='144'>&nbsp;</td>
      <td width='9'>&nbsp;</td>
      <td><strong>Jenis Bayar</strong></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><input type='hidden' name='id_sales' id='id_sales' value='<?=$id_user?>' /></td>
      <td width='119'><strong>Jumlah</strong></td>
      <td width='10'>:</td>
      <td width='144'><label>
        <input type='text' name='jumlah' id='jumlah' readonly='readonly' />
      </label></td>
      <td>&nbsp;</td>
      <td class='fonttext'>Pembayaran</td>
      <td>:</td>
      <td><select name='jenis_bayar' id='jenis_bayar' onChange='jenis()'>";
         
           $tampil=mysql_query("SELECT * FROM jenis_bayar ORDER BY id_jenis_bayar");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_jenis_bayar]>$r[nama_jenis_bayar]</option>";
            }
    echo "
        </select>
          <select name='bank' id='bank'>
            <option value='0' selected='selected'>- Pilih Bank -</option>
            ";
         
        
          $tampil=mysql_query("SELECT * FROM jenis_bank ORDER BY nama_bank");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_jenis_bank]>$r[nama_bank]</option>";
            }
              
    echo "
          </select>";
	echo"</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><strong>Jumlah Diskon</strong></td>
      <td>:</td>
      <td><label>
        <input type='text' name='diskon' id='diskon' value='0' onChange='hitungjumlahbayar()' readonly='readonly'/>
      </label></td>
      <td>&nbsp;</td>
      <td class='fonttext'>No Kartu</td>
      <td>:</td>
      <td><input type='text' name='no_kartu' id='no_kartu' /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><strong>Jumlah Bayar</strong></td>
      <td>:</td>
      <td><label>
        <input type='text' name='jumlah_bayar' id='jumlah_bayar' readonly='readonly'/>
      </label></td>
      <td>&nbsp;</td>
      <td class='fonttext'>No Giro</td>
      <td>:</td>
      <td><input type='text' name='no_giro' id='no_giro' /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><strong>Kalkulator</strong></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><label></label></td>
      <td>&nbsp;</td>
      <td class='fonttext'>Terima Tunai</td>
      <td>:</td>
      <td><label>
        <input type='text' name='terima' id='terima' onChange='hitungkembali()'/>
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type='button' name='btn_cetak' id='btn_cetak' value='Cetak' onClick='confirmPrint()'/></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td class='fonttext'>Kembali</td>
      <td>:</td>
      <td><label>
        <input type='text' name='kembali' id='kembali' readonly='readonly'/>
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label></label></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan='7'>&nbsp;</td>
    </tr>
  </table>
  <table border='1' id='tbl_dtl' align='center'>
      <thead> <tr>
      <td width='20' class='fonttext'><div align='center'>No</div></td>
      <td width='200' class='fonttext'><div align='center'>No. Faktur</div></td>
      <td width='50' class='fonttext'><div align='center'>Tanggal</div></td>
      <td width='100' class='fonttext'><div align='center'>No. Polisi</div></td>
      <td width='120' class='fonttext'><div align='center'>Jumlah</div></td>
      <td width='50' class='fonttext'><div align='center'>Diskon</div></td>
      <td width='50' class='fonttext'><div align='center'>Bayar</div></td>
    </tr>   </thead>
  </table>";?>
  <script type="text/javascript">
jenis();
function jenis(){
var jenis=document.getElementById('jenis_bayar').value;
if(jenis==1){
document.getElementById('no_kartu').disabled =true;
document.getElementById('bank').disabled =true;
document.getElementById('no_giro').disabled =true;
document.getElementById('terima').disabled =false;
document.getElementById('kembali').disabled =false;

}
else if(jenis==2){
document.getElementById('no_kartu').disabled =false;
document.getElementById('no_giro').disabled =true;
document.getElementById('bank').disabled =false;
document.getElementById('terima').disabled =true;
document.getElementById('kembali').disabled =true;
}
else if(jenis==3){
document.getElementById('no_kartu').disabled =false;
document.getElementById('no_giro').disabled =true;
document.getElementById('bank').disabled =false;
document.getElementById('terima').disabled =true;
document.getElementById('kembali').disabled =true;
}
else if(jenis==4){
document.getElementById('bank').disabled =false;
document.getElementById('no_kartu').disabled =true;
document.getElementById('no_giro').disabled =true;
document.getElementById('terima').disabled =true;
document.getElementById('kembali').disabled =true;

}
else if(jenis==5){
document.getElementById('bank').disabled =false;
document.getElementById('no_kartu').disabled =true;
document.getElementById('no_giro').disabled =false;
document.getElementById('terima').disabled =true;
document.getElementById('kembali').disabled =true;
}
}
//---yang load di awal

var baris=1;
isi();
isidetail();
hitungjumlah();

function confirmPrint(a) 
{
	
	var answer = confirm("Lanjutkan Print??")
	if (answer){
		
		cetak(a); //memanggil function cetak
	}
	else
	{
		
	}
	
}

function cetak(b) // fungsi utk mencetak
{
	hitungrow();
	document.form2.action="insertbuktibayar.php";
	document.form2.submit();
	window.opener.location.href=window.opener.location.href;
	if(window.opener.progressWindow)
	{
		window.opener.progressWindow.close();
	}
}

function hitungrow() //function untuk menagambil jumlah baris, disimpan pada input text jum.
{
	document.form2.jum.value= baris; 
}

function isi()
{	//memasukkan value dengan method post
	document.form2.id_plg.value='<?=$_POST['id_plg'];?>';
	document.form2.nama_pelanggan.value='<?=$_POST['nama_pelanggan'];?>';
	document.form2.alamat.value='<?=$_POST['alamat'];?>';
	document.form2.tgl.value='<?=date('d-m-Y');?>';
			
}

function isidetail() //fungsi detail bb
{
	<?php
	$row=$_POST['jum'];
	$i=1;
	for($i;$i<$row;$i++)
	{
	
	if($_POST['Pilih'.$i]=='')
	{
	continue;
	}
	else
	{
	?>
	addNewRow();
	var temp=baris-1;
	document.getElementById('No_Faktur['+temp+']').value='<?=$_POST['No_Faktur'.$i];?>';
	document.getElementById('Tanggal['+temp+']').value='<?=date_format(date_create($_POST['Tanggal'.$i]),'d-m-Y');?>';
	document.getElementById('No_Polisi['+temp+']').value='<?=$_POST['No_Polisi'.$i];?>';
	document.getElementById('Jumlah['+temp+']').value='<?=$_POST['Jumlah'.$i];?>';
	document.getElementById('Bayar['+temp+']').value='<?=$_POST['Jumlah'.$i];?>';
	<?
	}
	}
	?>
		
}


function addNewRow() //fungsi addrow
{
	var tbl = document.getElementById("tbl_dtl");
	var row = tbl.insertRow(tbl.rows.length);
	row.id = baris;
	
	var td0 = document.createElement("td");
	var td1 = document.createElement("td");
	var td2 = document.createElement("td");
	var td3 = document.createElement("td");
	var td4 = document.createElement("td");
	var td5 = document.createElement("td");
	var td6 = document.createElement("td");
	
	td0.appendChild(generateIndex(baris));
	td1.appendChild(generateNoFaktur(baris));
	td2.appendChild(generateTanggal(baris));
	td3.appendChild(generateNoPolisi(baris));
	td4.appendChild(generateJumlah(baris));
	td5.appendChild(generateDiskon(baris));
	td6.appendChild(generateBayar(baris));
	
	
	row.appendChild(td0);
	row.appendChild(td1);
	row.appendChild(td2);
	row.appendChild(td3);
	row.appendChild(td4);
	row.appendChild(td5);
	row.appendChild(td6);
	
	
	
	document.getElementById('Bayar['+baris+']').setAttribute('onChange', 'hitungjumlah('+baris+')');
	document.getElementById('Disc['+baris+']').setAttribute('onChange', 'jmlhitungdisk('+baris+')');
	
	baris++;
	
}
function generateIndex(index) 
{
	var idx = document.createElement("div");
	idx.type = "hidden";
	idx.name = "index"+index+"";
	idx.id = "index["+index+"]";
	idx.innerHTML = index;
	return idx;
}

function generateNoFaktur(index) 
{
	var idx = document.createElement("input");
	idx.type = "text";
	idx.name = "No_Faktur"+index+"";
	idx.id = "No_Faktur["+index+"]";
	idx.readOnly = "readonly";
	return idx;
}
function generateTanggal(index)
{
	var idx = document.createElement("input");
	idx.type = "text";
	idx.name = "Tanggal"+index+"";
	idx.id = "Tanggal["+index+"]";
	idx.readOnly = "readonly";
	idx.size = "10";
	return idx;
}
function generateNoPolisi(index) 
{
	var idx = document.createElement("input");
	idx.type = "text";
	idx.name = "No_Polisi"+index+"";
	idx.id = "No_Polisi["+index+"]";
	idx.readOnly = "readonly";
	idx.size = "15";
	return idx;
}

function generateJumlah(index) 
{
	var idx = document.createElement("input");
	idx.type = "text";
	idx.name = "Jumlah"+index+"";
	idx.id = "Jumlah["+index+"]";
	idx.align="right";
	idx.readOnly = "readonly";
	idx.size = "16";
	return idx;
}

function generateDiskon(index) 
{
	var idx = document.createElement("input");
	idx.type = "text";
	idx.name = "Disc"+index+"";
	idx.id = "Disc["+index+"]";
	idx.align="right";
	idx.value=0;
	idx.size = "16";
	return idx;
}

function generateBayar(index) 
{
	var idx = document.createElement("input");
	idx.type = "text";
	idx.name = "Bayar"+index+"";
	idx.id = "Bayar["+index+"]";
	idx.align="right";
	idx.size = "16";
	return idx;
}


	
	function hitungjumlah()
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
	
	
	document.getElementById("jumlah").value = formatNumber(total);
	hitungjumlahbayar()
}
	function jmlhitungdisk(a)
{

	
	var ke2 =  getNumber(document.getElementById("Jumlah["+a+"]").value);
	var Disc =  getNumber(document.getElementById("Disc["+a+"]").value);
	
	var jml=0;
	if(document.getElementById("Disc["+a+"]").value !=0)
	{
		
		jml=ke2-Disc;
	}
	else
	{
		jml=ke2;
	}
	
	document.getElementById("Bayar["+a+"]").value = formatNumber(jml);
	hitungdisk();
}
function hitungdisk(i)
{
	var total = 0;
	for (var i=1;i<baris;i++)
	
	{
		if(document.getElementById("Disc["+i+"]")!=null)
		{
			total += getNumber(document.getElementById("Disc["+i+"]").value);
		}
		else
		{
			continue;
		}
		
	}
	
	
	document.getElementById("diskon").value = formatNumber(total);
	hitungjumlahbayar();
}

function hitungjumlahbayar()
{
	
	var jml=getNumber(document.getElementById("jumlah").value);
	var disc=getNumber(document.getElementById("diskon").value);
	var jml_bayar=jml-disc;
	document.getElementById("jumlah_bayar").value = formatNumber(jml_bayar);
		
}

function hitungkembali()
{
	var jumlah=getNumber(document.getElementById("jumlah_bayar").value);
	var terima=getNumber(document.getElementById("terima").value);
	var kembali=terima-jumlah;
	document.getElementById("kembali").value=formatNumber(kembali);
	document.getElementById("terima").value=formatNumber(terima);
	
}

  </script>
    
</form>
