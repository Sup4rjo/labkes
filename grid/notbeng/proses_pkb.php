<?php
include"../../../koneksi/koneksi.php";
$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = mysql_query("select * from pkb where id_pkb LIKE '%$q%'");
while($r = mysql_fetch_array($sql)) {
$id_pkb = $r['id_pkb'];
	echo "$id_pkb \n";
}
?>
