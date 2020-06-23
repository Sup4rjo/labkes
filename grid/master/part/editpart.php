<?php  
error_reporting(0);
session_start();
$id_user=$_SESSION['id_user'];
include("../../../../koneksi/koneksi.php");
$id_part = $_REQUEST['id_part'];
$nama = $_REQUEST['nama'];
$qty = $_REQUEST['qty'];
$beli = $_REQUEST['beli'];
$jual = $_REQUEST['jual'];
$barcode = $_REQUEST['barcode'];

if($_POST['oper']=='edit'){ 
	 mysql_query("update part set nama_part = '".$nama."',qty = '".$qty."',harga_beli = '".$beli."',harga_jual = '".$jual."', 	barcode = '".$barcode."' where id_part = '".$id_part."'") or die("Connection Error: " . mysql_error());  
	 mysql_close($db);
} 
else if($_POST['oper']=='add'){ 
	mysql_query("insert into part(nama_part,qty,harga_beli,harga_jual,barcode,id_part,id_user)values('".$nama."','".$qty."','".$beli."','".$jual."','".$barcode."','".$id_part."','".$id_user."')");
	mysql_close($db);
} 
else if($_POST['oper']=='del'){ 
	mysql_query("delete from part where id_part = '".$id_part."'");
	mysql_close($db);
} 
?>