<?php 
 error_reporting(0);
  session_start();
    $id_user=$_SESSION['id_user'];
include("../../../../koneksi/koneksi.php");
$nama = $_REQUEST['nama'];
$id_kry = $_REQUEST['id'];
$tlp = $_REQUEST['tlp'];
$alamat = $_REQUEST['alamat'];
$jabatan = $_REQUEST['jabatan'];


if($_POST['oper']=='edit'){ 
	 mysql_query("update karyawan set nm_kry = '".$nama."',tlp = '".$tlp."',alamat = '".$alamat."',jabatan = '".$jabatan."' where id_kry = '".$id_kry."'") or die("Connection Error: " . mysql_error());  
	 mysql_close($db);
} 
else if($_POST['oper']=='add'){ 
	mysql_query("insert into karyawan(nm_kry,tlp,id_kry,alamat,jabatan,id_user)values('".$nama."','".$tlp."','".$id_kry."','".$alamat."','".$jabatan."','".$id_user."')");
	mysql_close($db);
} 
else if($_POST['oper']=='del'){ 
	mysql_query("delete from karyawan where id_kry = '".$id_kry."'");
	mysql_close($db);
} 
?>