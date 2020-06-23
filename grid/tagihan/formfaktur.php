<link rel="stylesheet" type="text/css" href="../../css/styles.css" />
<script src="../../js/jsbilangan.js" type="text/javascript"></script>
<?php
error_reporting(0);
echo"<table width='100%' border='0'>
  <tr>
    <td class='fontjudul'>FAKTUR</td>
  </tr>
</table><hr /> <form id='form2' name='form2' action='' method='post'>
<input type='hidden' name='id_kendaraan' value=''/>
<input type='hidden' name='id_pelanggan' value=''/>
 <table width='100%' border='0'>
      <tr>
        <td class='fonttext'>No PKB</td>
       
        <td><input type='text' class='inputform' name='id_pkb' id='id_pkb' value=''/>
            <input name='cari2' type='button' id='cari2' onClick='popfaktur()' value='...' /></td>
      
        <td class='fonttext'>No.Polisi</td>
        <td><input type='text' class='inputform' name='no_polisi' id='no_polisi'  value=''/></td>
        <td></td>
      </tr>
      <tr>
        <td class='fonttext'>Nama Pemilik</td>
       
        <td><input type='text' class='inputform' name='nama_pelanggan' id='nama_pelanggan'  value='' /></td>
      
        <td class='fonttext'>Merk</td>
        <td><input type='text' class='inputform' name='nama_merk' id='nama_merk'  value='' /></td>
      </tr>
      <tr>
        <td class='fonttext'>Alamat</td>
      
        <td><textarea name='alamat' id='alamat' cols='20' rows='3'></textarea>        </td>
       
        <td class='fonttext'>Type</td>
    
        <td><input type='text' class='inputform' name='nama_type' id='nama_type'  value=''/></td>
    
      </tr>
      <tr>
        <td class='fonttext'>Telp</td>
      
        <td><input type='text' class='inputform' name='telp_pelanggan' id='telp_pelanggan'  value='' /></td>
       
        <td class='fonttext'>Tahun</td>
      
        <td><input type='text' class='inputform'  name='tahun' id='tahun'  value='' /></td>
      
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
<hr>
	  <table width='100%' border='0'>
      <tr>
       <td class='fonttext'>PERGANTIAN PART</td>
	     <td>  <input type='hidden' name='jum' id='jum' value='' /> <input type='hidden' name='jum1' id='jum1' value='' /></td>
   </tr>
    </table>
      <table width='100%'>
        <tr>
          <td width='687'><table border='1' width='100%' id='tbl_dtl'>
           <thead>
		    <tr>
              <td width='94' class='fonttext'>ID Part</td>
              <td width='463' class='fonttext'>Nama Part</td>
              <td width='30' class='fonttext'>Qty</td>
              <td width='125' class='fonttext'>Harga</td>
              <td width='120' class='fonttext'>Disc</td>
              <td width='133' class='fonttext'>Jumlah</td>
            </tr></thead>
          </table></td>
        </tr>
        <tr>
          <td><table width='100%' >
            <tr> 
              <td width='83%' class='fonttext'><div align='right'>TOTAL PART</div></td>
              <td width='3%'><div align='center'>:</div></td>
              <td width='14%'><label>
                <input name='total' type='text'  id='total' readonly>
              </label></td>
            </tr>
          </table></td>
        </tr>
      </table>
      <table width='100%' border='0'>
      <tr>
       <td class='fonttext'>JASA PERBAIKAN</td>
   </tr>
    </table>
      <table width='100%'>
        <tr>
          <td><table width='100%' border='1' id='tb2_dt2' align='left'>
            <thead><tr>
              <td width='25%' class='fonttext'>Id Jasa</td>
              <td width='50%' class='fonttext'>Uraian Jasa</td>
              <td width='25%'class='fonttext'>Jumlah</td>
            </tr></thead>
          </table></td>
        </tr>
        <tr>
          <td><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='82%' class='fonttext'><div align='right'>SUBTOTAL JASA</div></td>
              <td width='3%'><div align='center'>:</div></td>
              <td width='15%'><label>
                <input name='total2' type='text' class='number' id='total2' readonly>
              </label></td>
            </tr>
          </table></td>
        </tr>
      </table>
      <br>
      <table width='100%' border='0' cellspacing='0' cellpadding='0'>
        <tr>
          <td width='37%'>&nbsp;</td>
          <td width='45%'class='fonttext' ><div align='right'>PART</div></td>
          <td width='3%'><div align='center'>:</div></td>
          <td width='15%'><input name='tot_part' type='text' class='number' id='tot_part' readonly='readonly' /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><div align='right'class='fonttext'>JASA</div></td>
          <td><div align='center'>:</div></td>
          <td><input name='tot_jasa' type='text' class='number' id='tot_jasa' readonly /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><div align='right' class='fonttext'>TOTAL</div></td>
          <td><div align='center'>:</div></td>
          <td><input name='tot_total' type='text' class='number' id='tot_total' readonly /></td>
        </tr>
      </table>
      <input type='hidden' name='Dis' id='Dis' value='' />
<p align='center'><input name='print' type='image' src='../../../img/cetak2.png' value='Cetak' id='print' onClick='cetakMM()' onMouseOver='this.src='../../../img/cetak.png'' onMouseOut='this.src='../../../img/cetak2.png'' /></p>

</form>"; ?>


<script type="text/javascript">

function popfaktur() //fungsi popup utk faktur
{
	var width  = 700;
 	var height = 450;
 	var left   = (screen.width  - width)/2;
 	var top    = (screen.height - height)/2;
 	var params = 'width='+width+', height='+height+',scrollbars=yes';
 	params += ', top='+top+', left='+left;
	window.open('popfaktur.php','',params);
};

var baris1=1;
var baris2=1;
isi();


function poppart(a) //fungsi popup utk part
{
	var width  = 800;
 	var height = 500;
 	var left   = (screen.width  - width)/2;
 	var top    = (screen.height - height)/2;
 	var params = 'width='+width+', height='+height+',scrollbars=yes';
 	params += ', top='+top+', left='+left;
	window.open('../poppart.php?row='+a+'','',params);
};

function addNewRow1() 
{
	var tbl = document.getElementById("tbl_dtl");
	var row = tbl.insertRow(tbl.rows.length);
	row.id = baris1;
	
	var td2 = document.createElement("td");
	var td3 = document.createElement("td");
	var td4 = document.createElement("td");
	var td5 = document.createElement("td");
	var td6 = document.createElement("td");
	var td7 = document.createElement("td");
	
	td2.appendChild(generateId_Part(baris1));
	
	td3.appendChild(generateNama_Part(baris1));
	td4.appendChild(generateQty(baris1));
	td5.appendChild(generateHarga(baris1));
	td6.appendChild(generateDisc(baris1));
	td7.appendChild(generateJumlah(baris1));
	
	row.appendChild(td2);
	row.appendChild(td3);
	row.appendChild(td4);
	row.appendChild(td5);
	row.appendChild(td6);
	row.appendChild(td7);
	
	document.getElementById('Harga['+baris1+']').setAttribute('onChange', 'hitungjml('+baris1+')');
	document.getElementById('Disc['+baris1+']').setAttribute('onChange', 'hitungjml('+baris1+')');
	baris1++;
}
function generateIndex(index) 
{
	var idx = document.createElement("input");
	idx.type = "hidden";
	idx.name = "index"+index+"";
	idx.id = "index["+index+"]";
	idx.value = index;
	return idx;
}
function generateId_Part(index) 
{
	var idx = document.createElement("input");
	idx.type = "text";
	idx.name = "Id_Part"+index+"";
	idx.id = "Id_Part["+index+"]";
	idx.size = "18";
	idx.readOnly = "readonly";
	return idx;
}
function generateNama_Part(index)
{
	var idx = document.createElement("input");
	idx.type = "text";
	idx.name = "Nama_Part[]";
	idx.id = "Nama_Part["+index+"]";
	idx.size = "35";
	idx.readOnly = "readonly";
	return idx;
}
function generateQty(index) 
{
	var idx = document.createElement("input");
	idx.type = "text";
	idx.name = "Qty"+index+"";
	idx.id = "Qty["+index+"]";
	idx.size = "1";
	idx.readOnly= "readOnly";
	return idx;
}
function generateDisc(index) 
{
	var idx = document.createElement("input");
	idx.type = "text";
	idx.name = "Disc"+index+"";
	idx.id = "Disc["+index+"]";
	idx.size = "15";
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
	idx.value = 0;
	idx.size = "15";
	idx.readOnly= "readOnly";
	idx.align="right";
	return idx;
}
function generateCari(index) 
{
	var idx = document.createElement("input");
	idx.type = "button";
	idx.name = "btn";
	idx.value = "Cari";
	idx.id = "btn["+index+"]";
	idx.size = "10";
	return idx;
}

function addNewRow2() 
{
	var tbl = document.getElementById("tb2_dt2");
	
	var row = tbl.insertRow(tbl.rows.length);
	row.id = baris2;
	
	var td1 = document.createElement("td");
	var td2 = document.createElement("td");
	var td3 = document.createElement("td");

	td1.appendChild(generateId_Uraian(baris2));
	td2.appendChild(generateUraian(baris2));
	td3.appendChild(generateJumlah2(baris2));
	
	row.appendChild(td1);
	row.appendChild(td2);
	row.appendChild(td3);
	
	
	document.getElementById('Jumlah2['+baris2+']').setAttribute('onChange', 'hitungtotal2('+baris2+')');
	
	baris2++;
}

function generateId_Uraian(index) 
{
	var idx = document.createElement("input");
	idx.type = "text";
	idx.name = "Id_Uraian"+index+"";
	idx.id = "Id_Uraian["+index+"]";
	idx.size = "25";
	idx.readOnly = "readonly";
	return idx;
}

function generateUraian(index) 
{
	var idx = document.createElement("input");
	idx.type = "text";
	idx.name = "Uraian"+index+"";
	idx.id = "Uraian["+index+"]";
	idx.readOnly = "readonly";
	idx.size = "70";
	
	return idx;
}
function generateJumlah2(index) 
{
	var idx = document.createElement("input");
	idx.type = "text";
	idx.name = "Jumlah2"+index+"";
	idx.id = "Jumlah2["+index+"]";
	
	idx.value = 0;
	idx.size = "17";

	return idx;
}


function hitungjml(a)
{
	var ke1 = document.getElementById("Qty["+a+"]").value;
	var ke2 =  getNumber(document.getElementById("Harga["+a+"]").value);
	var Disc =  getNumber(document.getElementById("Disc["+a+"]").value);
	
	document.getElementById("Dis").value=Disc;
	var jml=0;
	if(document.getElementById("Disc["+a+"]").value !=0)
	{
		var ke3 = document.getElementById("Disc["+a+"]").value;
		dis=ke3/100;
		jml=(ke1*ke2)-(ke1*ke2*dis);
	}
	else
	{
		jml=ke1*ke2;
	}
	
	document.getElementById("Jumlah["+a+"]").value = formatNumber(jml);
	
hitungtotal();
	totsub();

}






function hitungtotal()
{
	var total = 0;
	for (var i=1;i<baris1;i++)
	
	{
		if(document.getElementById("Jumlah["+i+"]")!=null)
		{
			total +=getNumber(document.getElementById("Jumlah["+i+"]").value);
			
		}
		else
		{
			continue;
		}
		
	}
	
	document.getElementById("total").value = formatNumber(total);
	totpart();
	
	
}

function hitungtotal2()
{

	
	
	var total2 = 0;
	for (var i=1;i<baris2;i++)
	
	{
		if(document.getElementById("Jumlah2["+i+"]")!=null)
		{
			total2 +=getNumber(document.getElementById("Jumlah2["+i+"]").value);
		}
		else
		{
			continue;
		}
		
	}
	document.getElementById("total2").value = formatNumber(total2);
	totjasa();
	
}

function hitungppnpart()
{
	var subtotal=getNumber(document.getElementById("total").value);
	var ppn=subtotal*0.1;
	var net=subtotal+ppn;
	totppn();
	tottotal();
	
}

function totpart()
{
	document.getElementById("tot_part").value=document.getElementById("total").value;
}


function totjasa()
{
	document.getElementById("tot_jasa").value=document.getElementById("total2").value;
	totsub();
}
function totsub()
{

	var part=getNumber(document.getElementById("tot_part").value);
	var jasa=getNumber(document.getElementById("tot_jasa").value);
	var tot=part+jasa;
	
	document.getElementById("tot_total").value=formatNumber(tot);
	
}
function totppn()
{
		
	document.getElementById("tot_ppn").value=formatNumber(0);
}
function totpph()
{
	var jasa=getNumber(document.getElementById("tot_jasa").value);
	var tot=jasa*0.02;
	document.getElementById("tot_pph").value=formatNumber(tot);
}

function totmaterai()
{
	document.getElementById("materai").value = formatNumber(0);
}


function tottotal()
{

if(document.getElementById("cekPPN").checked==true){
		var totparts=getNumber(document.getElementById("tot_part").value);

	var totjasa=getNumber(document.getElementById("tot_jasa").value);
	var totpph=getNumber(document.getElementById("tot_pph").value);
	var totor=getNumber(document.getElementById("tot_or").value);
	var materai=getNumber(document.getElementById("materai").value);
	var tot=totparts+totjasa+totppn-totpph-totor+materai;
	var ppn = tot*10/100;
	document.getElementById("total_ppn").value = formatNumber(ppn);
	document.getElementById("tot_total").value=formatNumber(tot);
	}
	else{
	var totparts=getNumber(document.getElementById("tot_part").value);
	var totjasa=getNumber(document.getElementById("tot_jasa").value);
	var totppn=getNumber(document.getElementById("tot_ppn").value);
	var totpph=getNumber(document.getElementById("tot_pph").value);
	var totor=getNumber(document.getElementById("tot_or").value);
	var materai=getNumber(document.getElementById("materai").value);
	var tot=totparts+totjasa+totppn-totpph-totor+materai;
	document.getElementById("tot_total").value=formatNumber(tot);
	}
	
}

function cekmaterai()
{
	if(document.getElementById("materai2").checked==true)
	{
		var a=getNumber(document.getElementById("tot_total").value);

		if(a>=250000 && a<=1000000)
		{
			document.getElementById("materai").value = formatNumber(3000);
		}
		else if(a>1000000)
		{
			document.getElementById("materai").value = formatNumber(6000);
		}
		else
		{
			document.getElementById("materai").value = formatNumber(0);
		}
		
		
	}
	else
	{
		document.getElementById("materai").value = formatNumber(0);	
	}
	tottotal();
}


function hitungrow() 
{
	document.form2.jum.value= baris1;
	document.form2.jum1.value= baris2;
}

function cetakMM(){
	hitungrow();
	document.form2.action="insertfaktur.php";
	document.form2.submit();
	
}




function isi()
{
	<?php
	include"../../../koneksi/koneksi.php";
	if($_GET['id']!=''){
		$query=mysql_query("select c.no_polisi,type,nama,tlp,alamat from pkb a
left join registrasi as b on b.id_registrasi = a.id_registrasi
left join kendaraan as c on c.no_polisi = b.no_polisi
left join pelanggan as d on d.id_plg = c.id_plg where a.id_pkb = '".$_GET['id']."'");
		$rs=mysql_fetch_array($query);
		?>
	document.form2.id_pkb.value='<?=$_GET['id'];?>';
	document.form2.no_polisi.value='<?=$rs['no_polisi'];?>';
	document.form2.nama_type.value='<?=$rs['type'];?>';
	document.form2.nama_pelanggan.value='<?=$rs['nama'];?>';
	document.form2.telp_pelanggan.value='<?=$rs['tlp'];?>';
	document.form2.alamat.value='<?=$rs['alamat'];?>';
	
	
	
	
	<?php 
		  	$sq2 = mysql_query("select * from pkb_detail a,jasa_service b where a.id_jasa=b.id_jasa and id_pkb='".$_GET['id']."'");
			$i=1;
			while($rs2=mysql_fetch_array($sq2)){
		  ?>
		  	addNewRow2();
			
			document.getElementById('Id_Uraian['+<?=$i;?>+']').value = '<?=$rs2['id_jasa'];?>';
			document.getElementById('Uraian['+<?=$i;?>+']').value = '<?=$rs2['nama_jasa'];?>';
			document.getElementById('Jumlah2['+<?=$i;?>+']').value = formatNumber(<?=$rs2['harga'];?>);
			hitungtotal2();
			//hitungjmlJasa(<?=$i;?>);
          <?php 
		  $i++;
		  }
	
		  ?>
		  
		  <?php
		  $sql3 = mysql_query("SELECT a.id_part,nama_part,qty_ns,harga_ns FROM ns_dtl a
inner join part b on b.id_part=a.id_part
inner join ns c on c.id_ns=a.id_ns
WHERE id_pkb='".$_GET['id']."'");
		$j = 1;
		while($rs3=mysql_fetch_array($sql3)){
			$qty_ns=$rs3['qty_ns'];
			if($qty_ns!=0)
			{
		  ?>
		  	
				addNewRow1();
				document.getElementById('Id_Part['+<?=$j;?>+']').value = '<?=$rs3['id_part'];?>';
				document.getElementById('Nama_Part['+<?=$j;?>+']').value = '<?=$rs3['nama_part'];?>';
				document.getElementById('Qty['+<?=$j;?>+']').value = '<?=$rs3['qty_ns'];?>';
				document.getElementById('Harga['+<?=$j;?>+']').value = '<?=$rs3['harga_ns'];?>';
				document.getElementById('Disc['+<?=$j;?>+']').value = 0;
			

			hitungjml(<?=$j;?>);
		  <?php 
		  	 $j++;
		  	}
		 
		  }
		}
		  ?>
		 
	hitungtotal();
	totsub();
	
}
    </script>
