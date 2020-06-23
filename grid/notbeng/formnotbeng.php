<link rel="stylesheet" type="text/css" href="../../css/styles.css" />
<link rel="stylesheet" type="text/css" href="../../css/jquery.autocomplete.css" />
<script src="../../js/jsbilangan.js" type="text/javascript"></script>
<script type="text/javascript" src="../../js/jquery-1.4.js"></script>
<script type='text/javascript' src='../../js/jquery.autocomplete.js'></script>
<script language="javascript">
$().ready(function() {	
		$("#no_polisi").autocomplete("../registrasi/proses_nopol.php", {
		width: 158
  });
 

   $("#no_polisi").result(function(event, data, formatted) {
	var no_polisi = document.getElementById("no_polisi").value;
	$.ajax({
		url : 'ambilDataPKB.php',
		dataType: 'json',
		data: "no_polisi="+formatted,
		success: function(data) {
		var alamat  = data.alamat;
			$('#alamat').val(alamat);
				var type  = data.type;
			$('#type').val(type);
			var no_rangka  = data.no_rangka;
			$('#no_rangka').val(no_rangka);
				
			var tgl  = data.tgl;
			$('#tgl').val(tgl);
			var id_pkb  = data.id_pkb;
			$('#id_pkb').val(id_pkb);
			addNewRow() ;
        }
	});	
			
	});
	
  });
   $().ready(function() {	
		$("#id_pkb").autocomplete("proses_pkb.php", {
		width: 158
		  });
		 $("#id_pkb").result(function(event, data, formatted) {
	var id_pkb = document.getElementById("id_pkb").value;
	$.ajax({
		url : 'ambilDataPKB_bypkb.php',
		dataType: 'json',
		data: "id_pkb="+formatted,
		success: function(data) {
		var alamat  = data.alamat;
			$('#alamat').val(alamat);
				var type  = data.type;
			$('#type').val(type);
			var no_rangka  = data.no_rangka;
			$('#no_rangka').val(no_rangka);
				
			var tgl  = data.tgl;
			$('#tgl').val(tgl);
			var no_polisi  = data.no_polisi;
			$('#no_polisi').val(no_polisi);
			 addNewRow() ;
        }
	});	
  });
 
    });

</script>
<?php
include("../../../koneksi/koneksi.php");
echo"<table width='100%' border='0'>
  <tr>
    <td class='fontjudul'>NOTA BENGKEL</td>
  </tr>
</table>
    <hr />  <form id='form2' name='form2' action='' method='post'>
<table width='100%'>
	<tr>
		<td class='fonttext'>No. PKB</td>
      	<td><input type='text' class='inputform' name='id_pkb' id='id_pkb' placeholder='Autosuggest'/></td>
      	<td class='fonttext'>Tanggal</td>
      	<td><input type='text' class='inputform' name='tgl' id='tgl' /></td>
    </tr>
    <tr height='5'>
     	<td colspan='4'></td>
    </tr>
    <tr>
      	<td class='fonttext'>No.Polisi</td>
      	<td><input type='text' class='inputform' name='no_polisi' id='no_polisi' /></td>
      	<td class='fonttext'>No. Rangka</td>
      	<td><input type='text' class='inputform' name='no_rangka' id='no_rangka' /></td>
    </tr>
    <tr height='5'>
     	<td colspan='4'></td>
    </tr>
    <tr>
      	<td class='fonttext'>Type</td>
      	<td><input type='text' class='inputform' name='type' id='type' /></td>
      	<td>&nbsp;</td>
      	<td>&nbsp;</td>
    </tr>
</table>
  
<table width='100%' id='tbl_dtl' style='margin-top:20px;'>
<thead>
    <tr>
      	<td align='center' width='15%' class='fonttext'>Barcode</td>
    	<td align='center' width='32%' class='fonttext'>Kode Part</td>
      	<td align='center' width='15%' class='fonttext'>Nama Part</td>
      	<td align='center' width='3%' class='fonttext'>Qty</td>
      	<td align='center' width='15%' class='fonttext'>Harga</td>
      	<td align='center' width='15%' class='fonttext'>Jumlah</td>
      	<td align='center' width='5%' class='fonttext'>Del</td>
    </tr>
</thead>
</table>
  
<p><input type='hidden' name='jum' value='' /><input  type='hidden' name='temp_limit' id='temp_limit' value='' /></p>

<p align='center'><input name='print' type='image' src='../../../img/cetak2.png' value='Cetak' id='print' onClick='Print()' onMouseOver='this.src='../../../img/cetak.png'' onMouseOut='this.src='../../../img/cetak2.png'' /></p>
</form>"; ?>


<script type="text/javascript">
var baris=1;

function poppart(a) //fungsi popup utk part
{
	var width  = 630;
 	var height = 300;
 	var left   = (screen.width  - width)/2;
 	var top    = (screen.height - height)/2;
 	var params = 'width='+width+', height='+height+',scrollbars=yes';
 	params += ', top='+top+', left='+left;
	window.open('poppartns.php?row='+a+'','',params);
}


function hitungjml(a)
{
	var ke1 = document.getElementById("Qty["+a+"]").value;
	var ke2 = getNumber(document.getElementById("Harga["+a+"]").value);

	var jml=0;
	
		jml=ke1*ke2;
	
	document.getElementById("Jumlah["+a+"]").innerHTML =jml;
	
}


function addNewRow() 
{
	var tbl = document.getElementById("tbl_dtl");
	var row = tbl.insertRow(tbl.rows.length);
	row.id = 't1'+baris;
	
	var td4 = document.createElement("td");
	var td5 = document.createElement("td");
	var td6 = document.createElement("td");
	var td7 = document.createElement("td");
	
	var td9 = document.createElement("td");
	var td10 = document.createElement("td");
	var td11 = document.createElement("td");
	

	td4.appendChild(generateBarcode(baris));
	td5.appendChild(generateId_Part(baris));
	td5.appendChild(generateCari(baris));
	td6.appendChild(generateNama_Part(baris));
	td7.appendChild(generateQty(baris));
	
	td9.appendChild(generateHarga(baris));
	td10.appendChild(generateJumlah(baris));
	td11.appendChild(generateDel1(baris));
	
	row.appendChild(td4);
	row.appendChild(td5);
	row.appendChild(td6);
	row.appendChild(td7);
	
	row.appendChild(td9); 
	row.appendChild(td10); 
	row.appendChild(td11); 
	
	document.getElementById('Barcode['+baris+']').focus();
	document.getElementById('btn['+baris+']').setAttribute('onclick', 'poppart('+baris+')'); //akan memanggil fungsi poppart setelah ada action click
	document.getElementById('del1['+baris+']').setAttribute('onclick', 'delRow1('+baris+')'); //akan memanggil fungsi delRow1 setelah ada action click
	document.getElementById('Barcode['+baris+']').setAttribute('onChange', 'ceksss('+baris+')'); //akan memanggil fungsi ceksss setelah ada perubahan
	document.getElementById('Qty['+baris+']').setAttribute('onChange', 'hitungjml('+baris+')'); //akan memanggil fungsi hitungjml setelah ada perubahan
	document.getElementById('Harga['+baris+']').setAttribute('onChange', 'hitungjml('+baris+')'); //akan memanggil fungsi hitungjml setelah ada perubahan

	baris++;

}
function ceksss(a) //fungsi mengambil data part
{
var ke1 = document.getElementById("Barcode["+a+"]").value;
	$.ajax({
		url : 'ambildataparts.php',
		dataType: 'json',
		data: "id_part="+ke1,
		success: function(data) {
		var Id_Part  = data.id_part;
		var Nama_Part  = data.nama_part;	
		var Harga  = data.harga_jual;	
		var Jumlah  = data.harga_jual;	
		document.getElementById('Id_Part['+a+']').value = Id_Part;
		document.getElementById('Nama_Part['+a+']').value = Nama_Part;
		document.getElementById('Harga['+a+']').value = Harga;
			document.getElementById('Jumlah['+a+']').innerHTML = Jumlah;
			
			document.getElementById('Qty['+a+']').value = '1';
			
        }
	});	

addNewRow();
}
function generateBarcode(index) 
{
	var idx = document.createElement("input");
	idx.type = "text";
	idx.name = "Barcode"+index+"";
	idx.id = "Barcode["+index+"]";
	idx.size = "15";
	idx.focus;
	return idx;
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

function generateKd(index)
{
	var idx = document.createElement("input");
	idx.type = "hidden";
	idx.name = "kd"+index+"";
	idx.id = "kd["+index+"]";
	return idx;
}

function generateNama(index)
{
	var idx = document.createElement("input");
	idx.name = "Nama"+index+"";
	idx.id = "Nama["+index+"]";
	idx.readOnly = true;
	idx.size = "30";
	return idx;
} 
function generateId_Part(index) 
{
	var idx = document.createElement("input");
	idx.type = "text";
	idx.name = "Id_Part"+index+"";
	idx.id = "Id_Part["+index+"]";
	idx.size = "20";
	idx.readOnly = "readonly";
	return idx;
}
function generateNama_Part(index)
{
	var idx = document.createElement("input");
	idx.type = "text";
	idx.name = "Nama_Part"+index+"";
	idx.id = "Nama_Part["+index+"]";
	idx.size = "30";
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
	return idx;
}

function generateHarga(index) 
{
	var idx = document.createElement("input");
	idx.type = "text";
	idx.name = "Harga"+index+"";
	idx.id = "Harga["+index+"]";
	idx.size = "13";
	
	return idx;
}
function generateJumlah(index) 
{
	var idx = document.createElement("div");
	idx.name = "Jumlah"+index+"";
	idx.id = "Jumlah["+index+"]";
	idx.align= "right";
	idx.readOnly = "readonly";
	return idx;
}
function generatePO(index) 
{
	var idx = document.createElement("input");
	idx.type = "checkbox";
	idx.name = "NS"+index+"";
	idx.id = "NS["+index+"]";
	idx.size = "15";
	return idx;
}

function generateSupply(index) 
{
	var idx = document.createElement("input");
	idx.type = "text";
	idx.name = "Supply"+index+"";
	idx.id = "Supply["+index+"]";
	idx.size = "6";
	idx.readOnly = "readonly";
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
	document.form2.jum.value= baris;
}
function Print(a)
{
	var answer = confirm("Lanjutkan Print??")
	if (answer){
		
	hitungrow();
	document.form2.action="actnotasukucadangsr.php";
	document.form2.submit();
	}
	else
	{
		
	}
	
}

</script>


