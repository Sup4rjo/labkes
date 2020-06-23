<script src="../../js/jsbilangan.js" type="text/javascript"></script>

 <style type="text/css">
@media print
{
  .break{ display:block; page-break-before:always; }
}

.st_total {	font-size: 7pt;
	font-weight: bold;
	font-family:Verdana, Arial, Helvetica, sans-serif;
}
.style9 {	color: #000000;
	font-size: 10pt;
	font-weight: normal;
	font-family: Arial;
}
 .style6 {	color: #000000;
	font-size: 10pt;
	font-weight: bold;
	font-family: Arial;
}
.style11 {
	color: #FF0000;
	font-weight: bold;
}
 .style12 {color: #FF0000}
.style13 {color: #FF0000; font-size: 7pt; font-weight: normal; font-family: Arial; }
 </style>

<?php
	include"../../../koneksi/koneksi.php";
?>

 <form id="form2" name="form2" action="" method="post">
  <?php 
  	$no_transaksi = $_GET['id'];

	$sql1 = mysql_query("SELECT id_buktibayar,tgl_buktibayar,nama,jumlah_diskon,nama_jenis_bayar,a.id_jenis_bank,nama_bank from buktibayar_hdr a 
	inner join pelanggan b on b.id_plg= a.id_plg
	left join jenis_bayar c on c.id_jenis_bayar= a.id_jenis_bayar
	left join jenis_bank d on d.id_jenis_bank= a.id_jenis_bank WHERE id_buktibayar= '".$no_transaksi."'");
	
	$rs1 = mysql_fetch_array($sql1);
	
?>
 
 <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    
    <tr>
      <td colspan="3" class="style9"><hr /></td>
    </tr>
    <tr>
      <td width="22%" class="st_total"><div align="left">No.</div></td>
      <td width="4%" class="st_total"><div align="center">:</div></td>
      <td width="74%" class="st_total">
        <?=$rs1['id_buktibayar'];?>     </td>
    </tr>
    <tr>
      <td class="st_total"><div align="left">Tgl</div></td>
      <td class="st_total"><div align="center">:</div></td>
      <td class="st_total">
          <?=date_format(date_create($rs1['tgl_buktibayar']),'d-m-Y / H:i:s');?>     </td>
    </tr>
    <tr>
      <td class="st_total"><div align="left" class="style12">Pelanggan</div></td>
      <td class="st_total"><div align="center" class="style12">:</div></td>
      <td class="st_total">
          <div align="left" class="style12"><?=$rs1['nama'];?></div></td>
    </tr>
    
    <tr>
      <td class="st_total">Kasir</td>
      <td class="st_total"><div align="center">:</div></td>
      <td class="st_total">&nbsp;</td>
    </tr>
  </table>
 <table width="100%" border="0" align="center">
   <tr>
     <td width="100%" class="style6"><hr /></td>
   </tr>
 </table>
 <table width="100%" border="0" align="center" cellpadding="1" cellspacing="0" id="tbl_dtl">
    <tr>

      <td width="20" class="st_total"><div align="left" class="style9">
        No.
      </div></td>
      <td width="121" class="st_total">
    No Faktur     </td>
      <td width="113" class="st_total">
      <div align="left">No Polisi</div>      </td>
      <td width="128" class="st_total"><div align="center" class="style6">
        <div align="right" class="st_total">Jumlah</div>
      </div></td>
    </tr>
      <tr>
      <td colspan="4" class="st_total">
      <hr />      </td>
    </tr>
      <?php $sql2 = mysql_query("select * from buktibayar_hdr , buktibayar_dtl where buktibayar_hdr.id_buktibayar=buktibayar_dtl.id_buktibayar and buktibayar_hdr.id_buktibayar='".$no_transaksi."'" ) or die(mysql_error());
		
		$i=1;
		while ($rs2 = mysql_fetch_array($sql2)){	
		?>
      <tr>
        <td id="no[<?=$i;?>]" class="st_total"><?=$i;?></td>
        <td id="faktur[<?=$i;?>]" class="st_total"><?=$rs2['id_faktur'];?></td>
        <td id="no_polisi[<?=$i;?>]" class="st_total"><?=$rs2['no_polisi'];?></td>
        <td id="jumlah[<?=$i;?>]" align="right" class="st_total"><?=number_format ($rs2['biaya']+$rs2['diskon'],2);?> </td>
    </tr>
      <?php 
	  $totaltmbh=+$rs2['biaya']+$rs2['diskon'];
	  $i++;
	  }
	
	  	 ?>
         <tr>
      <td colspan="4"><hr /></td>
    </tr>
  </table>
  
   <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="615" class="style9">&nbsp;</td>
      <td width="266" class="st_total">TOTAL</td>
      <td width="10" class="st_total">:</td>
      <td width="389" class="st_total"><div id="total" class="st_total" align="right"><?php echo number_format($totaltmbh,2); ?></div></td>
    </tr>
    <tr>
      <td class="style9">&nbsp;</td>
      <td class="st_total">Discount</td>
      <td class="st_total">:</td>
      <td class="st_total"><div id="diskon" class="st_total" align="right"><?=number_format ($rs1['jumlah_diskon'],2);?> </div></td>
    </tr>
    
    <tr>
      <td class="style9">&nbsp;</td>
      <td class="st_total">Grand Total</td>
      <td class="st_total">:</td>
      <td class="st_total"><div id="grand" class="st_total" align="right"><?=number_format ($totaltmbh-$rs1['jumlah_diskon'],2);?> </div></td>
    </tr>
    <tr>
      <td class="style9">&nbsp;</td>
      <td class="st_total">&nbsp;</td>
      <td class="st_total">&nbsp;</td>
      <td class="st_total">&nbsp;</td>
    </tr>
    <tr>
      <td class="style9">&nbsp;</td>
      <td class="st_total">Jenis Bayar</td>
      <td class="st_total">:</td>
      <td class="st_total"><div id="tunai" class="st_total" align="right">
        <?=$rs1['nama_jenis_bayar'];?>
      </div></td>
    </tr>
    <?php
	$cekbank=$rs1['id_jenis_bank'];
	if($cekbank=='0'){
	}
	else{
	?>
    <tr>
      <td class="style9">&nbsp;</td>
      <td class="st_total">Bank</td>
      <td class="st_total">:</td>
      <td class="st_total"><div id="tunai2" class="st_total" align="right">
        <?=$rs1['nama_bank'];?>
      </div></td>
    </tr>
  </table>
  <?php
  }
  ?>
  
   <table width="100%" border="0" align="center">
     <tr>
       <td width="100%" class="style6"><hr /></td>
     </tr>
   </table><p align="center" class="style6">Cetak format Dot matrix
 </form>

 <script type="text/javascript">
var total=getNumber(document.getElementById("total").innerHTML);
hitungtotal();
function hitungtotal()
{
	var baris=<?=$i;?>;
	var total = 0;
	for (var i=1;i<baris;i++)
	{
			total += getNumber(document.getElementById("jumlah["+i+"]").innerHTML);	
	}
	document.getElementById("total").innerHTML = formatNumber(total);
	
}
  window.print();	
   </script>
 