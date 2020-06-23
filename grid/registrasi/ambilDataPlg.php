<?php
include"../../../koneksi/koneksi.php";
$id = $_GET['no_polisi'];
$sql = mysql_query("select a.id_plg,nama,alamat,type,tlp,warna,kota,no_rangka,warna from kendaraan a left join pelanggan b on a.id_plg=b.id_plg where no_polisi = '".$id."' LIMIT 1");
$row = mysql_fetch_array($sql);
echo json_encode($row);

?>