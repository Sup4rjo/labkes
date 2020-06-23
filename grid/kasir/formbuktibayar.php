<link rel="stylesheet" type="text/css" href="../../css/styles.css" />
<script src="../../js/jsbilangan.js" type="text/javascript"></script>
<?php
error_reporting(0);
	include("../../../koneksi/koneksi.php");
echo"<form id='form2' name='form2' action='' method='post'>
  <table width='670' border='0' align='center'>
    <tr>
      <td class='fonttext'>Nama Pelanggan</td>
      <td width='377'><input type='hidden' name='id_plg' id='id_plg' value=''/>
      <input type='text' name='nama_pelanggan' id='nama_pelanggan' class='inputform' value=''/>
      <input name='cari2' type='button' id='cari2' onClick='popbb()' value='...' /></td>
      <td width='123' colspan='2' rowspan='3'>&nbsp;</td>
    </tr>
    <tr>
      <td class='fonttext'>Alamat Pelanggan</td>
      <td>  <label>
  <textarea name='alamat' id='alamat' cols='15' rows='3'></textarea>
  </label></td>
    </tr>
    <tr>
      <td class='fonttext'>Tlp</td>
      <td><input type='text' name='tlp' id='tlp' class='inputform' value=''/></td>
    </tr>
  </table>
  <table width='633' align='center'>
    <tr>
      <td width='27'>&nbsp;</td>
      <td width='65'>&nbsp;</td>
      <td width='64'><label>
        <input type='button' name='bayar' id='bayar' value='Bayar' onClick='lanjut()' disabled='disabled' />
      </label></td>
      <td width='44'>&nbsp;</td>
      <td width='160'><input type='hidden' name='jum' value='' /></td>
      <td width='61'>&nbsp;</td>
      <td width='180'>&nbsp;</td>
    </tr>
  </table>
  <table border='1' id='tbl_dtl' align='center'>
      <thead><tr>
      <td width='20' class='fonttext'>No</td>
      <td width='150' class='fonttext'><div align='center'>No. Faktur</div></td>
      <td width='50' class='fonttext'>Tanggal</td>
      <td width='100' class='fonttext'>No. Polisi</td>
      <td width='120' class='fonttext'>Jumlah</td>
      <td width='50' class='fonttext'>Cek</td>
    </tr>  </thead>
  </table></form>
";?>
  <script type="text/javascript">

function popbb() //fungsi popup utk bb
{
	var width  = 500;
 	var height = 350;
 	var left   = (screen.width  - width)/2;
 	var top    = (screen.height - height)/2;
 	var params = 'width='+width+', height='+height+',scrollbars=yes';
 	params += ', top='+top+', left='+left;
	window.open('popbb.php','',params);
};

var baris=1;

//---yang load di awal
isi();
isidetail();

function lanjut()
{
	hitungrow();
	document.form2.action="frmbayarfinal.php";
	document.form2.submit();
	
}

function hitungrow() 
{
	document.form2.jum.value= baris;
}

function isi()
{
	<?php
	$sql=mysql_query("SELECT * from pelanggan where id_plg=".$_GET['id'].""); 
	$rs=mysql_fetch_array($sql);
	?>
	document.form2.id_plg.value='<?=$rs['id_plg'];?>';
	document.form2.nama_pelanggan.value='<?=$rs['nama'];?>';
	document.form2.alamat.value='<?=$rs['alamat'];?>';
			document.form2.tlp.value='<?=$rs['tlp'];?>';
}

function isidetail()
{
	<?php
	$sql1=mysql_query("select id_faktur,tgl_faktur,id_plg,total,d.no_polisi from faktur a
inner join pkb b on b.id_pkb=a.id_pkb
inner join registrasi c on c.id_registrasi=b.id_registrasi
inner join kendaraan d on d.no_polisi=c.no_polisi where id_plg=".$_GET['id']." and lunas=0"); 
	$i=1;
	while($rs1=mysql_fetch_array($sql1))
	{
		if($rs1['total']!=0)
		{
	
	?>
	addNewRow();
	
	document.getElementById('No_Faktur['+<?=$i;?>+']').value='<?=$rs1['id_faktur'];?>';
	document.getElementById('Tanggal['+<?=$i;?>+']').value='<?=date_format(date_create($rs1['tgl_faktur']),'d-m-Y');?>';
	document.getElementById('No_Polisi['+<?=$i;?>+']').value='<?=$rs1['no_polisi'];?>';
	document.getElementById('Jumlah['+<?=$i;?>+']').value=formatNumber(<?=$rs1['total'];?>);
	
	<?
		$i++;
		}
	}
	?>
		
}
function cekbayar()
{
	var flag=0;
	var tes = baris;
	
	for(var a=1;a<=tes-1;a++)
	{
		if(document.getElementById('Pilih['+a+']').checked==true) 
		{
			flag++;
		}
		
	}	
		
	if(flag==0)
	{	
		document.getElementById('bayar').disabled=true;
	}
	else
	{
		document.getElementById('bayar').disabled=false;
	}

}

function addNewRow() 
{
	var tbl = document.getElementById("tbl_dtl");
	var row = tbl.insertRow(tbl.rows.length);
	row.id = baris;
	
	var td0 = document.createElement("td");
	var td2 = document.createElement("td");
	var td3 = document.createElement("td");
	var td4 = document.createElement("td");
	var td7 = document.createElement("td");
	var td8 = document.createElement("td");
	
	td0.appendChild(generateIndex(baris));
	td2.appendChild(generateNoFaktur(baris));
	td3.appendChild(generateTanggal(baris));
	td4.appendChild(generateNoPolisi(baris));
	td7.appendChild(generateJumlah(baris));
	td8.appendChild(generatePilih(baris));
	
	
	row.appendChild(td0);
	row.appendChild(td2);
	row.appendChild(td3);
	row.appendChild(td4);
	row.appendChild(td7);
	row.appendChild(td8);
	
	document.getElementById('Pilih['+baris+']').setAttribute('onChange', 'cekbayar('+baris+')');
	
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
	idx.size = "16";
	idx.readOnly = "readonly";
	return idx;
}


function generatePilih(index) 
{
	var idx = document.createElement("input");
	idx.type = "checkbox";
	idx.name = "Pilih"+index+"";
	idx.id = "Pilih["+index+"]";
	return idx;
}
  </script>
    
