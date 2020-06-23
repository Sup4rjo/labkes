<script src="../../js/jsbilangan.js" type="text/javascript"></script>

<style type="text/css">
<!--
.style9 {font-size: 10pt; font-family:Arial}
.style99 {font-size: 13pt; font-family:Arial}
.style10 {font-size: 10pt; font-family:Arial; text-align:right}
.style19 {font-size: 10pt; font-weight: bold; font-family:Arial; font-style:italic}
.style11 {
	color: #000000;
	font-size: 8pt;
	font-weight: normal;
	font-family: Arial;
	font-style:italic;
}
.style20 {font-size: 8pt; font-family:Arial}
.style16 {font-size: 9pt; font-family:Arial}
.style21 {color: #000000;
	font-size: 10pt;
	font-weight: bold;
	font-family: Arial;
}
.style18 {color: #000000;
	font-size: 9pt;
	font-weight: normal;
	font-family: Arial;
}
.style6 {color: #000000;
	font-size: 9pt;
	font-weight: bold;
	font-family: Arial;
}
.style19b {	color: #000000;
	font-size: 11pt;
	font-weight: bold;
	font-family: Arial;
}
-->
</style>
<?php
error_reporting(0);
	include("../../../koneksi/koneksi.php");
$id_faktur=$_GET['id'];
	$sql = mysql_query("SELECT * FROM faktur a 
inner join pkb b on b.id_pkb=a.id_pkb
inner join registrasi c on c.id_registrasi=b.id_registrasi
inner join kendaraan d on d.no_polisi=c.no_polisi
inner join pelanggan e on e.id_plg=d.id_plg
where id_faktur='".$id_faktur."'

");
	$rs = mysql_fetch_array($sql);
?>


<form id="form2" name="form2" action="" method="post"  onSubmit="return validasi(this)">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="21" ><span class="style19b">Bengkel AUTO START</span></td>
    </tr>
    <tr>
      <td height="5" ><hr /></td>
    </tr>
  </table>
  <table width="100%" border="0" align="center">
    <tr>
      <td width="15%" class="style9">No </td>
      <td width="2%" class="style9"><div align="center">:</div></td>
      <td width="18%" class="style9"><div align="left">
          <?=$id_faktur?>
      </div></td>
      <td width="30%" class="style9"><div align="center" class="style99"><strong>FAKTUR SERVICE</strong></div></td>
      <td width="11%" class="style9">Tanggal </td>
      <td width="2%" class="style9"><div align="center">:</div></td>
      <td width="22%" class="style9"><?=date_format(date_create($rs['tgl_faktur']),'d-m-Y');?></td>
    </tr>
    <tr>
      <td colspan="7" class="style9"><hr /></td>
    </tr>
  </table>
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="123" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
            <td class="style9">Nama</td>
            <td class="style9"><div align="center">:</div></td>
            <td class="style9"><?=$rs['nama'];?></td>
            <td width="2%" class="style9">&nbsp;</td>
            <td width="13%" class="style9">No.Polisi</td>
            <td width="2%" class="style9"><div align="center">:</div></td>
            <td width="29%" class="style21"><?=$rs['no_polisi'];?></td>
          </tr>
          <tr>
            <td class="style9">Alamat</td>
            <td class="style9"><div align="center">:</div></td>
            <td class="style9"><?=$rs['alamat'];?></td>
            <td class="style9">&nbsp;</td>
            <td class="style9">Type</td>
            <td class="style9"><div align="center">:</div></td>
            <td class="style9"><?=$rs['type'];?></td>
          </tr>
          <tr>
            <td class="style9">No.Telp</td>
            <td class="style9"><div align="center">:</div></td>
            <td class="style9"><?=$rs['tlp'];?></td>
            <td class="style9">&nbsp;</td>
            <td class="style9">Warna</td>
            <td class="style9"><div align="center">:</div></td>
            <td class="style9"><?=$rs['warna'];?></td>
          </tr>
          <tr>
            <td width="15%" class="style9">&nbsp;</td>
            <td width="2%" class="style9">&nbsp;</td>
            <td width="37%" class="style9">&nbsp;</td>
            <td class="style9">&nbsp;</td>
            <td class="style9">No.Rangka</td>
            <td class="style9"><div align="center">:</div></td>
            <td class="style9"><?=$rs['no_rangka'];?></td>
          </tr>
          
          <tr>
            <td colspan="7" class="style9"><hr /></td>
          </tr>
    
  </table>
   

  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="19%" class="style21"><div align="right">
          <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td width="95%" class="style21">PERINCIAN SPAREPART</td>
              <td width="5%">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2" class="style21"><hr /></td>
            </tr>
          </table>
      </div></td>
    </tr>
  </table>
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="19%" class="style21"></td>
    </tr>
  </table>
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="2%" height="17" class="style21"><div align="left">No</div></td>
      <td width="13%" class="style21">Id Part</td>
      <td width="40%" class="style21"><div align="left">Nama Sparepart</div></td>
      <td width="7%" class="style21"><div align="left">Qty</div></td>
      <td width="9%" class="style21"><div align="right">Hrg. Satuan</div></td>
      <td width="2%" class="style21">&nbsp;</td>
      <td width="8%" class="style21"><div align="center">Disk(%)</div></td>
      <td width="19%" class="style21"><div align="right">Jumlah(Rp)</div></td>
    </tr>
    <tr>
      <td colspan="8" class="style9"><hr /></td>
    </tr>
    <?php $sql3 = mysql_query("select id_part,nama_part,qty_faktur,harga_faktur,disk_faktur,(qty_faktur*harga_faktur)-disk_faktur as jumlah from faktur_dtl a
inner join part b on b.id_part=a.id
where id_faktur ='".$_GET['id']."'");
		$j = 1;
		$totalpart=0;
		while($rs3=mysql_fetch_array($sql3)){
	
		$no++;
  ?>
    <tr>
      <td class="style9"><span class="style16">
        <?=$no;?>
      </span></td>
      <td class="style9"><?=$rs3['id_part'];?></td>
      <td class="style9">
	 <?=$rs3['nama_part'];?>      </td>
      <td class="style9">
        <div align="left">
          <?=$rs3['qty_faktur'];?>
        </div></td>
      <td class="style9"><div align="right">
        <?=number_format($rs3['harga_faktur'],0);?>
      </div></td>
      <td class="style9">&nbsp;</td>
      <td class="style9"><div align="center">
        <?=$rs3['disc'];?>
      </div>
      <div align="center"></div></td>
      <td class="style9"><div align="right">
          <?=number_format($rs3['jumlah'],0);?>
      </div></td>
    </tr>
    <?
	$total+=$rs3['jumlah'];
	}

  ?>
  </table>
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="4" colspan="3"><div align="left">
        <hr width="100%" />
      </div>      </td>
    </tr>
    <tr> <td width="67%">&nbsp;</td>
      <td width="22%" class="style9"><div align="right">Total Rp</div></td>
      <td width="11%" class="style9"><div id="jmlpart">
          <div align="right">
             <? echo number_format($total,0);?>
            </span></div>
      </div></td>
    </tr>
  </table>
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="19%" class="style21"><div align="right">
          <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td width="95%" height="17" class="style21">PERINCIAN JASA</td>
              <td width="5%">&nbsp;</td>
            </tr>
            <tr>
              <td height="4" colspan="2" class="style21"><div align="left">
                <hr width="100%" />
              </div>              </td>
            </tr>
          </table>
      </div></td>
    </tr>
  </table>
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="2%" class="style21"><div align="left">No.</div></td>
      <td width="13%" class="style21">Id Jasa</td>
      <td width="39%" class="style21"><div align="left">Uraian Jasa</div></td>
      <td width="9%" class="style21"><div align="right">Harga</div></td>
      <td width="20%" class="style21"><div align="right">Jumlah(Rp)</div></td>
    </tr>
    <tr>
      <td colspan="5" class="style16"><hr /></td>
    </tr>
    <?
		
  $sq2 = mysql_query("select * from faktur_dtl a
inner join  jasa_service b on b.id_jasa=a.id
where id_faktur ='".$_GET['id']."'");
	$i=1;
	$nomer=0;
	while($rs2=mysql_fetch_array($sq2)){$nomer++;

  ?>
    <tr>
      <td class="style9"><span class="style16">
        <?=$nomer;?>
      </span></td>
      <td class="style9"><?=$rs2['id_jasa'];?></td>
      <td class="style9"><?=$rs2['nama_jasa'];?></td>
      <td class="style9"><div align="right">
        <?=number_format($rs2['harga_faktur'],0);?>
      </div></td>
      <td class="style9"><div align="right">
          <?=number_format($rs2['harga_faktur'],0);?>
      </div></td>
    </tr>  <?
	$total2+=$rs2['harga_faktur'];
  }
  ?>
    <tr>
      <td height="2" colspan="5" class="style9"><hr /></td>
      </tr>
  </table>
   
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="67%">&nbsp;</td>
      <td width="22%"><div align="right" class="style9"> Total Rp</div></td>
      <td width="11%"><div id="jmljasa">
        <div align="right" class="style9">
          <?  echo number_format($total2,0);?>
          </span></div>
      </div></td>
    </tr>
  </table> 
 
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="75%" height="27"><table width="99%" border="0">
          <tr>
            <td width="14%" class="style19">Terbilang </td>
            <td width="2%"><div align="center">:</div></td>
            <td width="84%"><div class="style11" id="terbilang"></div></td>
          </tr>
      </table></td>
      <td width="15%" class="style9"><div align="right"><strong>Grand Total</strong></div></td>
      <td width="10%" class="style10"><div id="total" class="style21"><? echo number_format($total2+$total,0);?></div> </td>
    </tr>
    <tr>
      <td height="2" colspan="3"><hr /></td>
    </tr>
    
    <tr>
      <td height="27" colspan="3"><p><span class="style20">Ketentuan </span> :<br />
          <span class="style20">1. Pembayarandengan giro/cek dianggap sah setelah dapat dicairkan/dikliringkan</span>. <br />
          <span class="style20">2. Jaminan jasa perbaikan selama 2 minggu.</span> <br />
          <span class="style20">3. Kami tidak bertanggung jawab atas barang bekas yang tidak diambil dalam waktu 2 hari sejak tanggal selesainya perbaikan.</span><br />
           <span class="style20">4. Barang yang  sudah dibeli tidak dapat ditukar/dikembalikan.</span></p>
       <span class="style20">Pembayaran ditransfer ke:</span>
        <table width="647" border="0" align="left" cellpadding="0" cellspacing="0" id="tbl_dtl2">
          <tr>
            <td colspan="7" class="style6"></td>
          </tr>
          <tr>
            <td width="115" class="hd_tbl" id="td2"><div align="left"><span class="style20">Nama Bank</span></div></td>
            <td width="145" class="hd_tbl" id="td2"><span class="style20">Cabang</font>
                </div></td>
            <td width="134" class="hd_tbl" id="td2"><div align="left"><span class="style20">No Rekening</span></div>
                </div></td>
            <td width="235" class="hd_tbl" id="td2"><div align="left"><span class="style20">Atas Nama</span></div>
                </div></td>
          </tr>
          <tr>
            <td colspan="7" class="style6"></td>
          </tr>
   
          <tr>
            <td width="115" class="hd_tbl" id="td2"><div align="left">
              <span class="style20">  </span>
            </div></td>
            <td width="145" class="hd_tbl" id="td2"><div align="left">
              <span class="style20">  </span>
            </div></td>
            <td width="134" class="hd_tbl" id="td2"><div align="left">
                <span class="style20"></span>
            </div></td>
            <td width="235" class="hd_tbl" id="td2"><div align="left">
              <span class="style20"> </span>
            </div></td>
          </tr>
        
          <tr>
            <td colspan="7" class="style6"></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td height="2" colspan="3"><hr /></td>
    </tr>
  </table>
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="159"><div align="center" class="style9">Penerima,</div></td>
      <td width="600">&nbsp;</td>
      <td colspan="3"><div align="center" class="style9">Hormat Kami,</div></td>
    </tr>
    <tr>
      <td height="56">&nbsp;</td>
      <td>&nbsp;</td>
      <td width="5">&nbsp;</td>
      <td width="167" valign="top">  </td>
      <td width="5">&nbsp;</td>
    </tr>
    <tr>
      <td height="34"><div align="center">(.....................................)</div></td>
      <td><p align="center" class="style20">&nbsp;</p>
      </td>
      <td>(</td>
      <td><div align="center">Adi Chandra Setiawan</div></td>
      <td>)</td>
    </tr>
  </table>
  <div align="center"></div>
</form>

<script language="javascript">
var total=getNumber(document.getElementById("total").innerHTML);
document.getElementById("terbilang").innerHTML = terbilang(total);

window.print();
</script>
  <div align="center"><span class="style20">
   
  </span> </div>
