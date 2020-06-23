<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
@media print
{
  .break{ display:block; page-break-before:always; }
}
.pala_judul {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	letter-spacing: normal;
	text-align: center;
	word-spacing: normal;
	list-style-type: none;
	vertical-align: baseline;
}
.style9 {color: #000000;
	font-size: 9pt;
	font-weight: normal;
	font-family: Arial;
}

.style9b {color: #000000;
	font-size: 9pt;
	font-weight: bold;
	font-family: Arial;
}

.style6 {	color: #000000;
	font-size: 9pt;
	font-weight: bold;
	font-family: Arial;
}
-->
</style>
</head>

<body>
 <?php 
 error_reporting(0);
include"../../../koneksi/koneksi.php";

if(isset($_GET["dari"]))$dari = $_GET['dari'];
else $dari = "";

if(isset($_GET["sampai"]))$sampai = $_GET['sampai'];
else $sampai = "";


//construct where clause
$where = "WHERE 1=1";
if($dari!='')$where.= " AND date(tgl_faktur) >= '$dari'";
if($sampai!='')$where.= " AND date(tgl_faktur) <= '$sampai'";
?>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td width="67%" height="56" valign="top">&nbsp;</td>
        <td width="33%"><table width="100%" border="0">
            <tr>
              <td class="pala_judul"><div align="center">Laporan Piutang</div></td>
            </tr>
            <tr>
              <td height="28" class="pala_judul"><div align="center">(Service)</div></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
      <tr class="style9">
        <td>&nbsp;Dari Tanggal:
          <?=$_GET["dari"]?>
&nbsp;&nbsp;&nbsp;&nbsp;Sampai Tanggal:
<?=$_GET["sampai"]?></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr class="style6">
    <td width="10%"><div align="center">No</div></td>
    <td width="15%"><div align="center">No PKB</div></td>
    <td width="18%"><div align="center">No Faktur</div></td>
    <td width="16%"><div align="center">No Polisi</div></td>
    <td width="29%"><div align="center">Pemilik</div></td>
    <td width="12%"><div align="center">Total</div></td>
  </tr>
  
   <?php $sql2 = mysql_query("SELECT a.id_faktur,a.id_pkb,nama,d.no_polisi,total FROM faktur a 
INNER JOIN pkb b ON b.id_pkb=a.id_pkb
INNER JOIN registrasi c ON c.id_registrasi=b.id_registrasi
INNER JOIN kendaraan d ON d.no_polisi=c.no_polisi
INNER JOIN pelanggan e ON e.id_plg=d.id_plg
".$where." and lunas=0") or die(mysql_error());
		$i = 1;
		while ($rs2 = mysql_fetch_array($sql2)){	
		?>
  <tr>
    <td class="style9" align="center"><?=$i;?></td>
    <td class="style9"><?=$rs2['id_pkb'];?></td>
    <td class="style9"><?=$rs2['id_faktur'];?></td>
    <td class="style9"><?=$rs2['no_polisi'];?></td>
    <td class="style9"><?=$rs2['nama'];?></td>
     <td class="style9" align="right"><?=number_format($rs2['total']);?></td>
  </tr>
  
   <?php 
  
	$jml_grand += $rs2['total'];
	  $i++;
	  }
	  
	  ?>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="1" cellpadding="0" cellspacing="0">
      <tr class="style9">
        <td width="88%"><div align="center"><strong>JUMLAH</strong></div></td>
        <td width="12%" align="right"><strong>
          <?=number_format($jml_grand);?>
        </strong></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>

<script type="text/javascript">
window.print();
</script>
</html>
