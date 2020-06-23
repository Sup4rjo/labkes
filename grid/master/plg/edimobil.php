<?php 
 error_reporting(0);
  session_start();
    $id_user=$_SESSION['id_user'];
include("../../../../koneksi/koneksi.php");
$id_plg = $_REQUEST['id_plg'];
	$no_polisi = $_REQUEST['no_polisi']; 
	 $no_rangka = $_REQUEST['no_rangka']; 
	  $type = $_REQUEST['type']; 
	   $warna = $_REQUEST['warna']; 
if($_POST['oper']=='edit'){ 
	
	 mysql_query("update kendaraan set no_rangka = '".$no_rangka."',type = '".$type."',warna = '".$warna."' where no_polisi = '".$no_polisi."'");
	 mysql_close($db);
} 
else if($_GET['oper']=='add'){ 
   
	mysql_query("insert into kendaraan(id_plg,no_polisi,no_rangka,type,warna,id_user)values('".$id_plg."','".$no_polisi."','".$no_rangka."','".$type."','".$warna."','".$id_user."')");
	mysql_close($db);
} 
else if($_POST['oper']=='del'){ 
	mysql_query("delete from kendaraan where no_polisi = '".$no_polisi."'");
	mysql_close($db);
} 

?>