<?php
include"../../../koneksi/koneksi.php";
$id = $_GET['id_part'];
$sql = mysql_query("Select * FROM part where barcode  = '".$id."' LIMIT 1");
$row = mysql_fetch_array($sql);
	
echo json_encode($row);

?>
