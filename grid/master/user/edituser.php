<?php 
error_reporting(0);
include("../../../../koneksi/koneksi.php");
$nama = $_REQUEST['nama'];
$id_user = $_REQUEST['id'];
$tlp = $_REQUEST['tlp'];
$username = $_REQUEST['username'];
$level = $_REQUEST['level'];
$password = md5($_REQUEST['password']);

if($_POST['oper']=='edit'){ 
	 mysql_query("update user set nama = '".$nama."',username = '".$username."',id_level = '".$level."' where id_user = '".$id_user."'") or die("Connection Error: " . mysql_error());  
	 mysql_close($db);
} 
else if($_POST['oper']=='add'){ 
	mysql_query("insert into user(nama,password,username,id_level)values('".$nama."','".$password."','".$username."','".$level."')");
	mysql_close($db);
} 
else if($_POST['oper']=='del'){ 
	mysql_query("delete from user where id_user = '".$id_user."'");
	mysql_close($db);
} 
?>