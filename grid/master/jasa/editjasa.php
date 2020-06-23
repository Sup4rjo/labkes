<?php 
error_reporting(0);
session_start();
$id_user=$_SESSION['id_user'];
include("../../../../koneksi/koneksi.php");
$nama = $_REQUEST['nama'];
$id_jasa = $_REQUEST['id_jasa'];
$biaya = $_REQUEST['biaya'];

if($_POST['oper']=='edit'){ 
	 mysql_query("update jasa_service set nama_jasa = '".$nama."',biaya = '".$biaya."' where id_jasa = '".$id_jasa."'") or die("Connection Error: " . mysql_error());  
	 mysql_close($db);
} 
else if($_POST['oper']=='add'){ 
	mysql_query("insert into jasa_service(nama_jasa,biaya,id_jasa,id_user)values('".$nama."','".$biaya."','".$id_jasa."','".$id_user."')");
	mysql_close($db);
} 
else if($_POST['oper']=='del'){ 
	mysql_query("delete from jasa_service where id_jasa = '".$id_jasa."'");
	mysql_close($db);
} 
?>