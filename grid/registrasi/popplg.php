<style type="text/css">
.head_tbl {
	font-size: 14px;
	font-weight: bold;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	text-transform: uppercase;
	color: #FFFFFF;
	background-color: #FF0000;
}
</style>
<script type="text/javascript">
var a = "<?php echo $_GET['row'];?>";
function ambil(a){
window.opener.document.form2.id_plg.value = document.getElementById("id_plg"+a+"").innerHTML;
window.opener.document.form2.nama.value = document.getElementById("nama"+a+"").innerHTML;
window.opener.document.form2.alamat.value = document.getElementById("alamat"+a+"").innerHTML;
window.opener.document.form2.type.value = document.getElementById("type"+a+"").innerHTML;
window.opener.document.form2.no_polisi.value = document.getElementById("no_polisi"+a+"").innerHTML;
		window.close();
}
</script>
<table width="57%" border="0">
  <tr>
    <td><form id="form1" name="form1" method="post" action="">
      <label>
        No Polisi
        <input type="text" name="cari" id="cari" />
        </label>
      <label>
        <input type="submit" name="button" id="button" value="cari" onclick="pencarian()"/>
        </label>
    </form></td>
  </tr>
</table>
<table width="719" border="1">
<tr class="head_tbl">
    <td width="51" bgcolor="#FF0000">Id </td>
    <td width="156" bgcolor="#FF0000"><div align="center">Nama</div></td>
        <td width="156" bgcolor="#FF0000"><div align="center">Alamat</div></td>
    <td width="136" bgcolor="#FF0000"><div align="center">No Polisi</div></td>
	<td width="187" bgcolor="#FF0000"><div align="center">Type</div></td>
  </tr>
<?php
error_reporting(0);
include("../../../koneksi/koneksi.php");
	$hal = $_GET[hal];
if(!isset($_GET['hal'])){ 
    $page = 1; 
} else { 
    $page = $_GET['hal']; 
}
$jmlperhalaman = 20;  // jumlah record per halaman
$offset = (($page * $jmlperhalaman) - $jmlperhalaman);  


if($_GET['flag']==1)
{
	$cari=$_GET['cari'];
	
	$sql=mysql_query("select kendaraan.id_plg,no_polisi,nama,type,alamat from pelanggan,kendaraan where kendaraan.id_plg=pelanggan.id_plg and no_polisi LIKE '%".$cari."%' order by nama limit $offset, $jmlperhalaman") or die (mysql_error());

}
else
{

	$sql=mysql_query("select kendaraan.id_plg,no_polisi,nama,type,alamat from pelanggan,kendaraan where kendaraan.id_plg=pelanggan.id_plg order by nama limit $offset, $jmlperhalaman") or die (mysql_error());
}
$i=1;
while($rs=mysql_fetch_array($sql))
{
if($i%2==0)
	{
		echo("<tr onclick=\"ambil('$rs[0]')\" bgcolor=\"#FFEEEE\">");
	}
	else
	{
		echo("<tr onclick=\"ambil('$rs[0]')\">");
	}
?>



<td width="51" id="id_plg<?=$rs[0];?>"><?=$rs[id_plg];?></td>
<td width="156" id="nama<?=$rs[0];?>"><?=$rs[nama];?></td>
<td width="156" id="alamat<?=$rs[0];?>"><?=$rs[alamat];?></td>
<td width="136" id="no_polisi<?=$rs[0];?>"><?=$rs[no_polisi];?></td>
<td width="187" id="type<?=$rs[0];?>"><?=$rs[type];?></td>
</tr>
<?php
  $i++;
}
?>
</table>
<?

if($_GET['flag']==1)
{
	$cari=$_GET['cari'];
	$total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM pelanggan,kendaraan,alamat where kendaraan.id_plg=pelanggan.id_plg where no_polisi LIKE '%".$cari."%'"),0);
}
else
{
	$total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM pelanggan,kendaraan,alamat where kendaraan.id_plg=pelanggan.id_plg"),0);
}


$total_halaman = ceil($total_record / $jmlperhalaman);
echo "<center>"; 
$perhal=4;
if($hal > 1){ 
    $prev = ($page - 1); 
    if($_GET['flag']==1)
	{
		echo "<a href=$_SERVER[PHP_SELF]?hal=$prev&cari=$_GET[cari]&flag=1> << </a> "; 
	}
	else
	{
		echo "<a href=$_SERVER[PHP_SELF]?hal=$prev> << </a> "; 
	} 
}
if($total_halaman<=10){
$hal1=1;
$hal2=$total_halaman;
}else{
$hal1=$hal-$perhal;
$hal2=$hal+$perhal;
}
if($hal<=5){
$hal1=1;
}
if($hal<$total_halaman){
$hal2=$hal+$perhal;
}else{
$hal2=$hal;
}
for($i = $hal1; $i <= $hal2; $i++){ 
    if(($hal) == $i){ 
        echo "[<b>$i</b>] "; 
        } else { 
    if($i<=$total_halaman){
        if($_GET['flag']==1)
		{
			echo "<a href=$_SERVER[PHP_SELF]?hal=$i&cari=$_GET[cari]&flag=1>$i</a> "; 
		}
		else
		{
			echo "<a href=$_SERVER[PHP_SELF]?hal=$i>$i</a> "; 
		}  
    }
    } 
}
if($hal < $total_halaman){ 
    $next = ($page + 1); 
    if($_GET['flag']==1)
	{
		echo "<a href=$_SERVER[PHP_SELF]?hal=$next&cari=$_GET[cari]&flag=1> >> </a>"; 
	}
	else
	{
		echo "<a href=$_SERVER[PHP_SELF]?hal=$next> >> </a>"; 
	} 
} 
echo "</center>"; 
?>
<script type="text/javascript">


function pencarian()
{
	var cari=document.getElementById('cari').value;
	document.form1.action="popplg.php?flag=1&cari="+cari;
	document.form1.submit();
}	
</script>