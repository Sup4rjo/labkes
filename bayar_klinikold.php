<?php
error_reporting(1);
  include_once 'config/db.php';
  include_once 'ceklogin.php';
	
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
<script src="assets/js/jsbilangan.js" type="text/javascript"></script>

<?php
$idp=$_GET['id'];
	$query=mysqli_query($link, "SELECT 
  pk.id,
  pk.norm,
  pk.nama,
  pk.alamat,
  pk.telpon,
  pk.jenis_kelamin,
  pk.status_marital,
  kk.no_kunjungan,
  kk.tgl_kunjungan,
  kk.pasien_lama
  FROM kunjungan_klinik AS kk 
  LEFT JOIN pasienklinik AS pk
  ON kk.no_rm=pk.norm
  WHERE kk.id='$idp'");
  $dtpasien= mysqli_fetch_array($query);
  
	
      ?>
    
<form id="form2" name="form2" action="" method="post">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="7"><div align="center">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="74%" rowspan="3" valign="top" class="style19b">LABKES KAB. SEMARANG</td>
            <td colspan="3"><div align="center" class="style9b">
              <div align="left" class="style19b"><strong><u>FAKTUR / NOTA KLINIK</u></strong></div>
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
      <td width="157"><font size="2" class="style9">No.Kunjungan</font></td>
      <td width="19"><div align="center">:</div></td>
      <td width="383" class="style9"><?=$dtpasien['no_kunjungan'];?></td>
      <td width="26">&nbsp;</td>
      <td width="238" class="style9">Alamat Pasien</td>
      <td width="15"><div align="center">:</div></td>
      <td width="228"><span class="style9">
        <?=$dtpasien['alamat'];?>
      </span></td>
    </tr> 
    <tr>
      <td class="style9">No. Rekam Medis</td> 
      <td><div align="center">:</div></td>
      <td><div id="kontak" class="style9">
          <?=$dtpasien['norm'];?>
      </div></td>
      <td width="26">&nbsp;</td>
      <td width="238" class="style9">Jenis Kelamin</td>
      <td width="15"><div align="center">:</div></td>
      <td width="228"><div id="sex" class="style9"><?=$dtpasien['jenis_kelamin'];?>
      </div></td>
    </tr>
    <tr>
      <td><font size="2 class="style9="style9""">Nama Pasien</font></td>
      <td><div align="center">:</div></td>
      <td><div id="nama" class="style9">
        <?=$dtpasien['nama'];?>
      </div></td>
      <td width="26"><input type="hidden" name="jum" value="" /></td>
      <td><font size="2" class="style9">Nomor Telpon</font></td>
      <td><div align="center">:</div></td>
      <td><span class="style9">
        <?=$dtpasien['telpon'];?>
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
      <td width="166" class="style6"><div align="left">Kode Pemeriksaan</div></td>
      <td width="254" class="style6"><div align="left">Nama/Jenis Pemeriksaan</div></td>
      <td width="38" class="style6"><div align="center">Qty</div></td>
      <td width="94" class="style6"><div align="right">Harga</div></td>
      <td width="117" class="style6"><div align="right">Jumlah</div></td>
    </tr>
      <tr>
      <td colspan="7">
      <hr />      </td>
      </tr>
      <?php
    $sql1 = mysqli_query($link, "SELECT
    kk.no_kunjungan,
    kk.tgl_kunjungan,
    kk.pasien_lama,
    kk.id,
    kt.kode_produk,
    pt.nama_produk,
    kt.totalharga,
    tk.qty,
    tk.total
    FROM kunjungan_klinik AS kk 
    LEFT JOIN transaksi_klinik AS tk
    ON kk.id=tk.id_kunjungan
    LEFT JOIN komponen_tarif AS kt
    ON tk.kode_tarif=kt.kode_produk
    LEFT JOIN produk_tarif AS pt
    ON kt.kode_produk=pt.kode_produk
    WHERE kk.id='$idp'
    ");
		
  $i = 1;
  // $tt=mysqli_fetch_array($sql1);
  // echo $tt['qty'];
	while ($rs1 = mysqli_fetch_array($sql1))
	{	
	  ?>
      <tr>
        <td class="style9" align="center"><?=$i;?></td>
        <td class="style9"><?=$rs1['kode_produk'];?></td>
        <td class="style9"><?=$rs1['nama_produk'];?></td>
        <td class="style9"><?=$rs1['qty'];?></td>
        <td class="style9" align="right"><?=number_format($rs1['totalharga'],2);?></td>
        <td class="style9" align="right"><?=number_format($rs1['total'],2);?></td>
      </tr>
      <?php
	  $total=$total+$rs1['total'];
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
     <td colspan="3"><div align="center" class="style9">Pasien/Customer</div></td>
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

