<?php 
error_reporting(0);
include("../../../../koneksi/koneksi.php");
$id = $_REQUEST['id'];
$id_menu = $_REQUEST['id_menu'];
$level = $_REQUEST['level'];

if($_POST['oper']=='add'){ 
	mysql_query("insert into submenu_dtl(id_menu,id_level)values('".$id_menu."','".$level."')");
	mysql_close($db);
} 
else if($_POST['oper']=='del'){ 
	mysql_query("delete from submenu_dtl where id_submenu_dtl = '".$id."'");
	mysql_close($db);
} 
?>