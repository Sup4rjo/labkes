<style type="text/css">
<!--
.style9 {font-size: 10pt}
-->
</style>
</head>
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

-->
</style>
<script type="text/javascript">

var b = <?php echo $_GET['row'];?>;
function ambil(a){
	window.opener.document.getElementById("Id_Mekanik["+b+"]").value = document.getElementById("id_kry"+a+"").innerHTML;
		window.opener.document.getElementById("Mekanik["+b+"]").value = document.getElementById("nm_kry"+a+"").innerHTML;
	window.close();
	
};

</script>

<body>
<table width="464" border="0">
  <tr>
    <td width="523"><form id="form1" name="form1" method="post" action="" >
      <label>Nama Mekanik
      <input type="text" name="cari" id="cari" value="" />
      </label>
      <label>
      <input type="submit" name="button" id="button" value="cari" onClick="pencarian()"/>
      </label>
    </form></td>
  </tr>
  <tr>
    <td>
    <table border="1" width="458" align="left">
      <tr class="head_tbl">
        <td width="47"><div align="center">ID  </div></td>
        <td width="395"><div align="center">Nama Mekanik</div></td>
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
$jmlperhalaman = 10;  // jumlah record per halaman
$offset = (($page * $jmlperhalaman) - $jmlperhalaman);  

	
	
if($_GET['flag']==1)
{
	$cari=$_GET['cari'];
	$sql=mysql_query("select * from karyawan where nm_kry LIKE '%".$cari."%' and jabatan='mekanik' limit $offset, $jmlperhalaman") or die (mysql_error());

}
else
{

	$sql=mysql_query("select * from karyawan where jabatan='mekanik' limit $offset, $jmlperhalaman") or die (mysql_error());

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
        <td width="47" id="id_kry<?=$rs[0];?>"><?=$rs[id_kry];?></td>
        <td width="395" id="nm_kry<?=$rs[0];?>"><?=$rs[nm_kry];?></td>
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
	$total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM karyawan where nm_kry LIKE '%".$cari."%'  and jabatan='mekanik'"),0);

}
else
{
	$total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM karyawan where jabatan='mekanik'"),0);
}


$total_halaman = ceil($total_record / $jmlperhalaman);
echo "<center>"; 
$perhal=4;
if($hal > 1){ 
    $prev = ($page - 1); 
    if($_GET['flag']==1)
	{
		echo "<a href=$_SERVER[PHP_SELF]?hal=$prev&row=$_GET[row]&cari=$_GET[cari]&flag=1> << </a> "; 
	}
	else
	{
		echo "<a href=$_SERVER[PHP_SELF]?hal=$prev&row=$_GET[row]> << </a> "; 
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
			echo "<a href=$_SERVER[PHP_SELF]?hal=$i&row=$_GET[row]&cari=$_GET[cari]&flag=1>$i</a> "; 
		}
		else
		{
			echo "<a href=$_SERVER[PHP_SELF]?hal=$i&row=$_GET[row]>$i</a> "; 
		} 
    }
    } 
}
if($hal < $total_halaman){ 
    $next = ($page + 1); 
    if($_GET['flag']==1)
	{
		echo "<a href=$_SERVER[PHP_SELF]?hal=$next&row=$_GET[row]&cari=$_GET[cari]&flag=1> >> </a>"; 
	}
	else
	{
		echo "<a href=$_SERVER[PHP_SELF]?hal=$next&row=$_GET[row]> >> </a>"; 
	}
} 
echo "</center>"; 
?>
<p>&nbsp;</p>
<script type="text/javascript">
function pencarian()
{  	var cari=document.getElementById('cari').value;
	document.form1.action="popmekanik.php?flag=1&row="+b+"&cari="+cari;
	document.form1.submit();
}	
</script>
