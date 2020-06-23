<style type="text/css">
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
</style>

<script type="text/javascript">
var b = "<?php echo $_GET['row'];?>";
function ambil(a){
	
	window.opener.document.getElementById("KODEP["+b+"]").value = document.getElementById("kode"+a+"").innerHTML;
	window.opener.document.getElementById("NAMAP["+b+"]").value = document.getElementById("nama"+a+"").innerHTML;
	window.opener.document.getElementById("QTY["+b+"]").value = 1;
	window.opener.document.getElementById("HARGA["+b+"]").value = document.getElementById("harga"+a+"").innerHTML;
	// window.opener.document.getElementById("Barcode["+b+"]").value = document.getElementById("barcode"+a+"").innerHTML;
	window.opener.hitungjml(b);
	window.opener.addNewRow1() ;
	window.close();
	
};
</script>

<table width="594" border="0">
  <tr>
    <td width="588"><form id="form1" name="form1" method="post" action="" >
      <label>
      Nama Part
      <input type="text" name="cari" id="cari" value=""/>
      </label>
      <label>
      <input type="submit" name="button" id="button" value="cari" onClick="pencarian()"/>
      </label>
    </form></td>
  </tr>
  <tr>
    <td>
    <table border="1" width="400" align="left">
      <tr class="head_tbl">
        <td width="5"><div align="center">Kode</div></td>
        <td width="50"><div align="center">Nama Produk </div></td>
        <td width="10"><div align="center">Harga</div></td>
        <!-- <td width="44"><div align="center">Qty</div></td>
        <td width="91"><div align="center">Harga</div></td> -->
      </tr>
     
		  <?php
	  // error_reporting(1);
	include("config/db.php");
	if(!isset($_GET['hal'])){ 
		$page = 1;
		$hal=1; 
	} else { 
		$hal = $_GET['hal'];
    $page = $_GET['hal']; 
	}
$jmlperhalaman = 20;  // jumlah record per halaman
$offset = (($page * $jmlperhalaman) - $jmlperhalaman);  


	if(isset($_GET['flag']) AND $_GET['flag']==1)
{
	$cari=$_GET['cari'];
	$query="SELECT * FROM 
	komponen_tarif k LEFT JOIN
	produk_tarif p on 
	k.kode_produk=p.kode_produk
	where kode_produk LIKE '%".$cari."%' limit $offset, $jmlperhalaman";
	$sql=mysqli_query($link,$query) or die (mysqli_error());
	
}
else
{

	$query="SELECT k.*, p.nama_produk FROM
	komponen_tarif k LEFT JOIN
	produk_tarif p on 
	k.kode_produk=p.kode_produk
 limit $offset, $jmlperhalaman";
	$sql=mysqli_query($link,$query);
}
// echo 'hallo';
// echo $query;
$i=1;
while($rs=mysqli_fetch_array($sql))
{
	if($i%2==0)
	{
		echo("<tr onclick=\"ambil('$rs[0]')\" bgcolor=\"#FFEEEE\" class=\"style9\">");
	}
	else
	{
		echo("<tr onclick=\"ambil('$rs[0]')\" class=\"style9\">");
	}
?>
				<td width="5" id="kode<?=$rs[0];?>"><?=$rs['kode_produk'];?></td>
        <td width="50" id="nama<?=$rs[0];?>"><?=$rs['nama_produk'];?></td>
        <td width="10" id="harga<?=$rs[0];?>"><?=$rs['totalharga'];?></td>
        
     
      </tr>
      <?php
	$i++;
}
?>
    </table></td>
  </tr>
</table>

<?php
if(isset($_GET['flag']) AND $_GET['flag']==1)
{
	$cari=$_GET['cari'];
	$qq=mysqli_query($link,"SELECT COUNT(*) as Num FROM komponen_tarif where nama_produk LIKE '%".$cari."%' ");
	$hh=mysqli_fetch_assoc($qq);
	$total_record = $hh['Num']; 
}
else
{
	$qq=mysqli_query($link,"SELECT COUNT(*) as Num FROM komponen_tarif");
	$hh=mysqli_fetch_assoc($qq);
	$total_record = $hh['Num']; 
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
{
	var cari=document.getElementById('cari').value;
	document.form1.action="poppartns.php?flag=1&row="+b+"&cari="+cari;
	document.form1.submit();
}	
</script>

