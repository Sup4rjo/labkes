<?php
include"../../../koneksi/koneksi.php";
$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = mysql_query("select * from kendaraan where no_polisi LIKE '%$q%'");
while($r = mysql_fetch_array($sql)) {
$no_polisi = $r['no_polisi'];
	echo "$no_polisi \n";
}
?>
