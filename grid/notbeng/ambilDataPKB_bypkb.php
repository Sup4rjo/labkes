<?php
include"../../../koneksi/koneksi.php";
$id = $_GET['id_pkb'];
$sql = mysql_query("select * from pkb a left join registrasi b on a.id_registrasi=b.id_registrasi left join kendaraan c on c.no_polisi=b.no_polisi where id_pkb = '".$id."'");
$row = mysql_fetch_array($sql);
echo json_encode($row);

?>