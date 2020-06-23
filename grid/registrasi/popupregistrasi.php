<link rel="stylesheet" type="text/css" href="../../css/jquery.autocomplete.css" />
<link rel="stylesheet" type="text/css" href="../../css/styles.css" />
<script type="text/javascript" src="../../js/jquery-1.4.js"></script>
<script type='text/javascript' src='../../js/jquery.autocomplete.js'></script>
<script language="javascript">
$().ready(function() {	
		$("#no_polisi").autocomplete("proses_nopol.php", {
		width: 158
  });
   $("#no_polisi").result(function(event, data, formatted) {
	var no_polisi = document.getElementById("no_polisi").value;
	$.ajax({
		url : 'ambilDataPlg.php?nama='+nama,
		dataType: 'json',
		data: "no_polisi="+formatted,
		success: function(data) {
		var alamat  = data.alamat;
			$('#alamat').val(alamat);
			var nama  = data.nama;
			$('#nama').val(nama);
				var id_plg  = data.id_plg;
			$('#id_plg').val(id_plg);
				var type  = data.type;
			$('#type').val(type);
			
        }
	});	
			
	});
  });

</script>
<form id="form2" name="form2" action="insertregis.php" method="post" >
<?php
echo"<table width='100%'>
  	<tr>
    	<td  class='fontjudul'>REGISTRASI SERVICE</td>
    </tr>
</table>
    <hr />
<table width='100%' cellspacing='0' cellpadding='0'>
    <tr>
        <td class='fonttext'>No.Polisi</td>
        <td><input type='text' class='inputform' name='no_polisi' id='no_polisi' placeholder='Autosuggest'  /></td>
        <td class='fonttext'>Type</td>
        <td><input type='text' class='inputform' name='type' id='type' disabled='disabled'/></td>
     </tr>
     <tr height='5'>
     <td colspan='6'></td>
     </tr>
     <tr>
        <td class='fonttext'>Nama</td>
        <td><input type='text' class='inputform' name='nama' id='nama' disabled='disabled'/></td>
        <td class='fonttext'>Odometer</td>
        <td><input type='text' class='inputform' name='odometer' id='odometer' value='' /></td>
     </tr>
     <tr height='5'>
     <td colspan='6'></td>
     </tr>
     <tr>
        <td class='fonttext'>Alamat</td>
        <td><textarea name='textarea' id='alamat' cols='34' rows='4' disabled='disabled'></textarea></td>
        <td align='center' valign='bottom' colspan='3'><input type='submit' value='SUBMIT'/></td>
     </tr>
</table>
</form>";?>

<script type="text/javascript">
<?php
include("../../koneksi/koneksi.php");
if($cek !=''){
$query=mysql_query("select * from registrasi a, kendaraan b, pelanggan c where a.no_polisi=b.no_polisi and b.id_plg=c.id_plg and id_registrasi='".$_GET['ids']."'"); 
$rs=mysql_fetch_array($query);
?>
	
	document.form2.id_plg.value='<?=$rs['id_plg'];?>';
	document.form2.nama.value='<?=$rs['nama'];?>';
	document.form2.alamat.value='<?=$rs['alamat'];?>';
	document.form2.id_registrasi.value='<?=$rs['id_registrasi'];?>';
	document.form2.type.value='<?=$rs['type'];?>';
	document.form2.odometer.value='<?=$rs['odometer'];?>';
	document.form2.no_polisi.value='<?=$rs['no_polisi'];?>';

<?php
} ?>
</script>

