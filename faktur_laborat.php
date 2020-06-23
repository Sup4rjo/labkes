<?php
error_reporting(0);
	include("../../../koneksi/koneksi.php");
?>

<style type="text/css">
@media print
{
  .break{ display:block; page-break-before:always; }
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
.style9 {
	color: #000000;
	font-size: 9pt;
	font-weight: normal;
	font-family: Arial;
}
.style9b {
	color: #000000;
	font-size: 9pt;
	font-weight: bold;
	font-family: Arial;
}
.style19b {
	color: #000000;
	font-size: 11pt;
	font-weight: bold;
	font-family: Arial;
}
.style10b {
	color: #000000;
	font-size: 11pt;
	font-weight: bold;
	font-family: Arial;
}
</style>
<script src="../../js/jsbilangan.js" type="text/javascript"></script>

<?php
	$query=mysql_query("SELECT * FROM ns a 
	left join pkb b on b.id_pkb=a.id_pkb
	left join registrasi c on c.id_registrasi=b.id_registrasi
	left join kendaraan d on d.no_polisi=c.no_polisi
	left join pelanggan e on e.id_plg=d.id_plg
	WHERE id_ns='".$_GET['id']."'");
	$rs=mysql_fetch_array($query);

		?>
<form id="form2" name="form2" action="" method="post">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="7"><div align="center">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="74%" rowspan="3" valign="top" class="style19b">LABKES KAB. SEMARANG</td>
            <td colspan="3"><div align="center" class="style9b">
              <div align="left" class="style19b"><strong><u>FAKTUR/NOTA LABORAT</u></strong></div>
            </div></td>
            </tr>
          <tr>
            <td width="11%" height="18" class="style9">Nomor </td>
            <td width="1%" class="style9"><div align="center">:</div></td>
            <td width="14%" class="style9">
              <?=$rs['id_ns'];?>           </td>
          </tr>
          <tr>
            <td class="style9">Tanggal</td>
            <td><div align="center">:</div></td>
            <td><span class="style9">
              <?=date_format(date_create($rs['tgl_ns']),'d-m-Y');?>
            </span></td>
          </tr>
        </table>
          </div></td>
    </tr>
    
   <tr>
      <td colspan="7">
       <hr />      </td>
   </tr>
    <tr>
      <td width="157"><font size="2" class="style9">Pelanggan/Perusahan</font></td>
      <td width="19"><div align="center">:</div></td>
      <td width="383" class="style9"><?=$rs['id_pkb'];?></td>
      <td width="26">&nbsp;</td>
      <td width="238" class="style9">Id Pelanggan</td>
      <td width="15"><div align="center">:</div></td>
      <td width="228"><span class="style9">
        <?=$rs['no_rangka'];?>
      </span></td>
    </tr> 
    <tr>
      <td class="style9">Alamat</td> 
      <td><div align="center">:</div></td>
      <td><div id="kontak" class="style9">
          <?=$rs['nama'];?>
      </div></td>
      <td width="26">&nbsp;</td>
      <td width="238" class="style9">No. Kunjungan</td>
      <td width="15"><div align="center">:</div></td>
      <td width="228"><div id="id_pkb" class="style9"><?=$rs['type'];?>
      </div></td>
    </tr>
    <tr>
      <td><font size="2 class="style9="style9""">Telpon</font></td>
      <td><div align="center">:</div></td>
      <td><div id="no_polisi" class="style9">
        <?=$rs['no_polisi'];?>
      </div></td>
      <td width="26"><input type="hidden" name="jum" value="" /></td>
      <td><font size="2" class="style9">No. Sampel</font></td>
      <td><div align="center">:</div></td>
      <td><span class="style9">
        <?=$rs['warna'];?>
      </span></td>
    </tr>
  </table>
   
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" id="tbl_dtl">
    <tr>
      <td colspan="7">
      <hr />      </td>
    </tr>
    <tr>
    	<td width="24" class="style6"><div align="center">No</div></td>
      <td width="166" class="style6"><div align="left">Kode</div></td>
      <td width="254" class="style6"><div align="left">Nama/Jenis Pemeriksaan</div></td>
      <td width="38" class="style6"><div align="center">Qty</div></td>
      <td width="94" class="style6"><div align="right">Harga</div></td>
      <td width="117" class="style6"><div align="right">Jumlah</div></td>
    </tr>
      <tr>
      <td colspan="7">
      <hr />      </td>
      </tr>
      <?
	  $sql1 = mysql_query("select a.id_part,nama_part,qty_ns,harga_ns,(qty_ns*harga_ns) as jumlah from ns_dtl a
left join part b on b.id_part=a.id_part
where id_ns='".$_GET['id']."' order by id_ns_dtl asc");
		
	$i = 1;
	while ($rs1 = mysql_fetch_array($sql1))
	{	
	  ?>
      <tr>
        <td class="style9" align="center"><?=$i;?></td>
        <td class="style9"><?=$rs1['id_part'];?></td>
        <td class="style9"><?=$rs1['nama_part'];?></td>
        <td class="style9"><?=$rs1['qty_ns'];?></td>
        <td class="style9" align="right"><?=number_format($rs1['harga_ns'],2);?></td>
        <td class="style9" align="right"><?=number_format($rs1['jumlah'],2);?></td>
      </tr>
      <?
	  $total=$total+$rs1['jumlah'];
	  $baris++;
	  $i++;
	  }
	
	  ?>
      <tr>
      <td colspan="7">
      <hr />      </td>
      </tr>
  </table>
 
  <table width="98%" align="center">
   
    <tr>
      <td width="86"><label for="name"></label>
          <label for="name"></label>
      <label for="name"><span class="st_total">TERBILANG</span></label></td>
      <td width="15">&nbsp;</td>
      <td width="371"><div class="style9" id="terbilang"></div></td>
      <td width="44">&nbsp;</td>
      <td width="47" class="st_total">TOTAL</td>
      <td width="152"><div id="total" class="st_total" align="right"><?=number_format($total,2);?>
      </div></td>
    </tr>
  </table>
  
   <table width="98%" border="0" align="center">
   <tr>
     <td colspan="3">&nbsp;</td>
     <td colspan="3">&nbsp;</td>
     <td colspan="3">&nbsp;</td>
   </tr>
   <tr>
     <td colspan="3"><div align="center" class="style9">Administrasi</div></td>
     <td colspan="3">&nbsp;</td>
     <td colspan="3"><div align="center" class="style9">Pelanggan / Perusahaan</div></td>
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

   <script type="text/javascript">

//---yang load di awal

var baris=1;
document.getElementById('terbilang').innerHTML=terbilang(getNumber(document.getElementById('total').innerHTML));

window.print();	

 </script>

