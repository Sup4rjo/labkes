<style type="text/css">
<!--
.head_tbl {
	font-size: 14px;
	font-weight: bold;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	text-transform: uppercase;
	color: #FFFFFF;
	background-color: #FF0000;
}

.style9 {	color: #000000;
	font-size: 9pt;
	font-weight: normal;
	font-family: Arial;
}

-->
</style>
<script type="text/javascript">
function ambil(a)
{
	window.opener.location.href="formfaktur.php?id="+a;
	window.close();
};

</script>

<table width="200" border="0" align="center">
  <tr>
    <td colspan="3"><form id="form1" name="form1" method="post" action="popfakturservice.php?flag=1">
      <label>
      No Polisi
      <input type="text" name="cari" id="cari" />
      </label>
      <label>
      <input type="button" name="button" id="button" value="cari" onclick="pencarian()"/>
      </label>
    </form></td>
  </tr>
  <tr>
    <td colspan="3">
    <table border="1"width="850" align="center">
      <tr class="head_tbl">
        <div id="abc">
          <td width="110"><div align="center">No PKB</div></td>
          <td width="100"><div align="center">Nama Pelanggan</div></td>
          <td width="70"><div align="center">No polisi</div></td>
          <td width="200"><div align="center">Type</div></td>
          <td width="50"><div align="center">Telp</div></td>
          <td width="100"><div align="center">Alamat</div></td>
        </div>
      </tr>
      <?php
	  error_reporting(0);
	include"../../../koneksi/koneksi.php";
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
	$sql=mysql_query("select * from pkb a
left join registrasi as b on b.id_registrasi = a.id_registrasi
left join kendaraan as c on c.no_polisi = b.no_polisi
left join pelanggan as d on d.id_plg = c.id_plg where faktur='0' and c.no_polisi LIKE '%".$cari."%' order by a.id_pkb desc limit $offset, $jmlperhalaman") or die (mysql_error());

}
else
{

	$sql=mysql_query("select * from pkb a
left join registrasi as b on b.id_registrasi = a.id_registrasi
left join kendaraan as c on c.no_polisi = b.no_polisi
left join pelanggan as d on d.id_plg = c.id_plg where faktur='0' order by a.id_pkb desc  limit $offset, $jmlperhalaman") or die (mysql_error());

}

$i=1;
while($rs=mysql_fetch_array($sql))
{

	if($i%2==0)
	{
		echo("<tr onclick=\"ambil('$rs[id_pkb]')\" bgcolor=\"#FFEEEE\" class=\"style9\">");
	}
	else
	{
		echo("<tr onclick=\"ambil('$rs[id_pkb]')\" class=\"style9\">");
	}
?>
     
        <td width="120" id="no_pkb<?=$rs[1];?>"><?=$rs['id_pkb'];?></td>
         <td width="180" id="nama<?=$rs[1];?>"><?=$rs['nama'];?></td>
          <td width="100" id="no_pol<?=$rs[1];?>"><?=$rs['no_polisi'];?></td>
        <td width="100" id="type<?=$rs[1];?>"><?=$rs['type'];?></td>
        <td width="100" id="tgl<?=$rs[1];?>"><?=$rs['tlp'];?></td>
        <td width="300" id="alamat<?=$rs[1];?>"><?=$rs['alamat'];?></td>
      </tr>
      <?php
	  $i++;
}
?>
    </table></td>
  </tr>
</table>
<?

if($_GET['flag']==1)
{
	$cari=$_GET['cari'];
	$total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM  pkb a
left join registrasi as b on b.id_registrasi = a.id_registrasi
left join kendaraan as c on c.no_polisi = b.no_polisi
left join pelanggan as d on d.id_plg = c.id_plg where faktur='0' and c.no_polisi LIKE '%".$cari."%' "),0);

}
else
{
	$total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM pkb a
left join registrasi as b on b.id_registrasi = a.id_registrasi
left join kendaraan as c on c.no_polisi = b.no_polisi
left join pelanggan as d on d.id_plg = c.id_plg where faktur='0'"),0);
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
	document.form1.action="popfaktur.php?flag=1&cari="+cari;
	document.form1.submit();
}	
</script>
