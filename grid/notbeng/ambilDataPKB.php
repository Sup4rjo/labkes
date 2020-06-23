<?php
include"../../../koneksi/koneksi.php";
$id = $_GET['no_polisi'];
$sql = mysql_query("select * from kendaraan a inner join registrasi b on a.no_polisi=b.no_polisi inner join pkb c on c.id_registrasi=b.id_registrasi inner join pelanggan d on d.id_plg=a.id_plg where b.no_polisi = '".$id."' ORDER BY id_pkb DESC LIMIT 1");
$row = mysql_fetch_array($sql);
echo json_encode($row);

?>