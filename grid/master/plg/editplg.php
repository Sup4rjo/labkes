<?php 
 error_reporting(0);
  session_start();
    $id_user=$_SESSION['id_user'];
include("../../../../koneksi/koneksi.php");
$id_plg = $_REQUEST['id'];
$nama = $_REQUEST['nama'];
$tlp = $_REQUEST['tlp'];
$kota = $_REQUEST['kota'];
$alamat = str_replace(array("\r", "\n"), ' ', $_REQUEST['alamat']);
$tlp = $_REQUEST['tlp'];

if($_POST['oper']=='edit'){ 
	 mysql_query("update pelanggan set nama = '".$nama."',alamat = '".$alamat."',tlp = '".$tlp."',kota = '".$kota."' where id_plg = '".$id_plg."'") or die("Connection Error: " . mysql_error());  
	 mysql_close($db);
} 
else if($_POST['oper']=='add'){ 
	mysql_query("insert into pelanggan(nama,alamat,tlp,kota,id_user)values('".$nama."','".$alamat."','".$tlp."','".$kota."','".$id_user."')");
	mysql_close($db);
} 
else if($_POST['oper']=='del'){ 
	mysql_query("delete from pelanggan where id_plg = '".$id_plg."'");
	mysql_query("delete from kendaraan where id_plg = '".$id_plg."'");
	mysql_close($db);
} 
?>