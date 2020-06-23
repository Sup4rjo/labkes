<?php
error_reporting(0);
include("../../../koneksi/koneksi.php");

	mysql_query("update pkb set keluhan='".$_POST['keluhan']."', perintah='".$_POST['perintah']."', odometer='".$_POST['odometer']."' where id_pkb='".$_GET['idpkb']."'") or die (mysql_error());

	$row=$_POST['jum'];
	
	
	for ($i=1; $i<$row; $i++)
	{
		//---mengambil parameter---
		$delete = $_POST['delete1'.$i];
		$Id_dtl_pkb = $_POST['Id_dtl_pkb'.$i];
		$Id_Jasa = $_POST['Id_Jasa'.$i];
		$HargaLabor = $_POST['HargaLabor'.$i];
			$Id_Mekanik = $_POST['Id_Mekanik'.$i];
		
		if($Id_Jasa==''){
		}
		else{
		
		
			if($delete=='' && $Id_dtl_pkb==''){
				mysql_query("insert into pkb_detail(id_jasa, id_pkb,harga,id_karyawan) VALUES ('".$Id_Jasa."','".$_GET['idpkb']."','".$HargaLabor."','".$Id_Mekanik."')") ;
			}
			else if($delete=='' && $Id_dtl_pkb!=''){
			mysql_query("update pkb_detail set id_jasa = '".$Id_Jasa."', harga= '".$HargaLabor."', id_karyawan= '".$Id_Mekanik."' where id_dtl_pkb = '".$Id_dtl_pkb."'")or die (mysql_error());
			//continue;
			}
			else if($delete!='' && $Id_dtl_pkb==''){
			mysql_query("delete from pkb_detail where id_dtl_pkb ='".$Id_dtl_pkb."'")or die (mysql_error());
			}
		}
	
	}
header("location:cetakpkb.php?pkb=".$_GET['idpkb']."");
			?>