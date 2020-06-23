<?php
error_reporting(0);
include("../../../koneksi/koneksi.php");
$id_pkbservice = $_GET['trx'];

	$sql = mysql_query("select * from pkb a,registrasi b,kendaraan c,pelanggan d 
	where a.id_registrasi=b.id_registrasi and b.no_polisi=c.no_polisi and c.id_plg=d.id_plg and id_pkb='".$_GET['pkb']."'");
	$rs = mysql_fetch_array($sql);
?>


<style type="text/css">
<!--
.style9 {font-size: 10pt; font-family:Arial}
.style14 {font-size: 9pt; color: #000000; }
.style15 {font-size: 11pt; font-family:Arial}
.style17 {font-size: 12pt; font-weight: bold; }
.style19 {font-size: 12pt; font-weight: bold; color: #FF0000; }
.style20 {font-size: 10pt; font-family:Arial; font-weight:bold}
.style10 {font-size: 10pt; font-family:Arial;color: #3A5FCD; }
.style30 {font-size: 15pt; font-family:tahoma;color:#FF0000}
.style31 {font-size: 8pt; font-family:tahoma;font-weight: bold}
</style>
<form id="form2" name="form2" action="" method="post"  onSubmit="return validasi(this)">
<table width="776" border="0" align="center">
  <tr>
    <td width="766" height="780" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="71%" valign="bottom"></td>
        <td width="29%" valign="middle"><div align="center"><span class="style17">Perintah Kerja Bengkel</span></div>          <div align="center"><span class="style19">Service</span></div></td>
      </tr>
      
    </table>
      <table width="766" border="0" align="left">
        <tr>
          <td colspan="10"><hr /></td>
          </tr>
        <tr>
          <td width="30" class="style9">No</td>
          <td width="10"><div align="center">: </div></td>
          <td width="76"><div class="style9" id="id_mobilmasuk2"><?=$_GET['pkb']?></div></td>
          <td width="59">&nbsp;</td>
          <td width="26" class="style9">Tgl</td>
          <td width="3"><div align="center">:</div></td>
          <td width="114" class="style9">
            <?=date_format(date_create($rs['tgl_pkb']),'d-m-Y');?>          </td>
          <td width="27" class="style9">SA</td>
          <td width="4"><div align="center">:</div></td>
          <td width="141" class="style9"></td>
        </tr>
        <tr>
          <td height="4" colspan="13"><hr /></td>
          </tr>
      </table>
   
      <p><br />
      </p>
      <table width="766" border="0">
        <tr>
          <td width="130" class="style9">No.Polisi</td>
          <td width="10"><div align="center">:</div></td>
          <td width="243" class="style9"><?=$rs['no_polisi'];?></td>

          <td width="111" class="style9">Warna</td>
          <td width="18"><div align="center">:</div></td>
          <td width="228" class="style9"><?=$rs['warna'];?></td>
          </tr>
        <tr>
          <td class="style9">Type</td>
          <td><div align="center">:</div></td>
          <td class="style9"><?=$rs['type'];?></td>
          <td width="111" class="style9">No.Rangka</td>
          <td><div align="center">:</div></td>
          <td><span class="style9">
            <?=$rs['no_rangka'];?>
          </span></td>
          </tr>
        <tr>
          <td class="style10">Nama Pemilik</td>
          <td class="style10"><div align="center">:</div></td>
          <td class="style10"><?=$rs['nama'];?></td>
          <td class="style10">Alamat</td>
          <td class="style10"><div align="center">:</div></td>
          <td class="style10"><?=$rs['alamat'];?></td>
        </tr>
        <tr>
          <td class="style10">No.Telp/Hp</td>
          <td class="style10"><div align="center">:</div></td>
          <td class="style10"><?=$rs['tlp'];?></td>
          <td class="style9">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table> 
      <table width="528" border="0">
        <tr>
          <td width="259" class="style9">Keluhan :</td>
          <td width="259" class="style9">Perintah Kerja :</td>
        </tr>
        <tr>
          <td><textarea name="keluhan" id="keluhan" class="text ui-widget-content ui-corner-all" cols="45"  rows="10"><?=$rs['keluhan'];?>
      </textarea></td>
          <td><div align="right">
            <textarea name="perintah" id="perintah" class="text ui-widget-content ui-corner-all" cols="45" rows="10"><?=$rs['perintah'];?>
          </textarea>
          </div></td>
        </tr>
      </table>
      <BR />        <span class="style9">URAIAN JASA      </span>
        <table width="100%" border="1" cellspacing="0" cellpadding="0">
        <tr>
          <td width="4%" height="29" class="style9"><div align="center">No
                
          </div></td>
          <td width="20%" class="style9"><div align="center">Mekanik
           
          </div></td>
          <td width="23%" class="style9"><div align="center">Nama Jasa
              
          </div></td>
          <td width="13%" class="style9"><div align="center">Harga
               
          </div></td>
          <td width="17%" class="style9"><div align="center">Disc(%)
            
          </div></td>
          <td width="23%" class="style9"><div align="center">Jumlah(Rp)
          
          </div></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
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
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
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
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
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
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>       
     <span class="style9">URAIAN PART </span><br />
     <table width="100%" border="1" cellspacing="0" cellpadding="0">
       <tr>
         <td width="4%" height="28" class="style9"><div align="center">No </div></td>
         <td width="18%" class="style9"><div align="center">Id Part</div></td>
         <td width="39%" class="style9"><div align="center">Nama Part</div></td>
         <td width="4%" class="style9"><div align="center">Qty</div></td>
         <td width="14%" class="style9"><div align="center">Harga </div></td>
         <td width="7%" class="style9"><div align="center">Disc(%) </div></td>
         <td width="14%" class="style9"><div align="center">Jumlah(Rp) </div></td>
       </tr>
       <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
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
         <td>&nbsp;</td>
       </tr>
       <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
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
         <td>&nbsp;</td>
       </tr>
       <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
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
         <td>&nbsp;</td>
       </tr>
       <tr>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
       </tr>
     </table></td>
  </tr>
</table>
<table width="84%" border="0" align="center">
  <tr>
    <td width="5">&nbsp;</td>
    <td width="105" class="style9"><div align="center">Dibuat Oleh </div></td>
    <td width="5">&nbsp;</td>
    <td width="491">&nbsp;</td>
    <td width="5">&nbsp;</td>
    <td width="126"><div align="center" class="style9">Pelanggan</div></td>
    <td width="7">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
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
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>(</td>
    <td class="style9"><div align="center"></div></td>
    <td>)</td>
    <td>&nbsp;</td>
    <td>(</td>
    <td>&nbsp;</td>
    <td>)</td>
  </tr>
  <tr>
    <td colspan="7"><span class="style9">Dengan ini kami memberi kuasa kepada 
        Bengkel Auto Start
      untuk mengerjakan segala pekerjaan yang tertulis pada Perintah Kerja dan memberikan izin untuk memeriksa kendaraan tersebut di luar area Bengkel Auto Start.</span></td>
  </tr>
</table>
<p align="center" class="style9">&nbsp;</p>
<p align="center" class="style9">&nbsp;</p>
</form>

<script language="javascript">
window.print();
</script>
  

