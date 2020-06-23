<?php
 error_reporting(0);
?>
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
var b = "<?php echo $_GET['row'];?>";
function ambil(a)
{
	window.opener.location.href="formreturns.php?ns="+a;
	
	window.close();
};

</script>

<table width="200" border="0" align="center">
  <tr>
    <td colspan="3"><form id="form1" name="form1" method="post" action="">
      <label>
      ID NS
      <input type="text" name="cari" id="cari" />
      </label>
      <label>
      <input type="submit" name="button" id="button" value="cari" onClick="pencarian()"/>
      </label>
    </form></td>
  </tr>
  <tr>
    <td colspan="3">
    <table border="1"width="330" align="center">
      <tr class="head_tbl">
        <div id="abc">
          <td width="152"><div align="center">No Nota bengkel</div></td>
          <td width="162"><div align="center">tgl nota</div></td>
          </div>
      </tr>
      <?php
	 
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
	$sql=mysql_query("SELECT * from  ns where id_ns LIKE '%".$cari."%' order by ns.id_ns desc limit $offset, $jmlperhalaman") or die (mysql_error());

}
else
{

	$sql=mysql_query("SELECT * from  ns order by ns.id_ns desc limit $offset, $jmlperhalaman") or die (mysql_error());
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
     
        <td width="152" id="no_ns<?=$rs[0];?>"><?=$rs['id_ns'];?></td>
        <td width="162" id="tgl_ns<?=$rs[0];?>"><?=date_format(date_create($rs['tgl_ns']),'d-m-Y');?></td>
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
	$total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num from ns where id_ns LIKE '%".$cari."%'"),0);

}
else
{

	$total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num from ns"),0);
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
<script type="text/javascript">
function pencarian()
{
	var cari=document.getElementById('cari').value;
	document.form1.action="popns.php?flag=1&row="+b+"&cari="+cari;
	document.form1.submit();
}	
</script>

