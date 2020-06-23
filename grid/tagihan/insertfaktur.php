<?php 
error_reporting(0);
session_start();
$id_user=$_SESSION['id_user'];
include("../../../koneksi/koneksi.php");

	//----fungsi cari no baru----
	function getincrementnumber()
	{
		$q = mysql_fetch_array( mysql_query('select id_faktur from faktur order by id_faktur desc limit 0,1'));
		
		$kode=substr($q['id_faktur'], -4);
		$bulan=substr($q['id_faktur'], -6,2);
		$bln_skrng=date('m');
		$num=(int)$kode;
		if($num==0 || $num==null || $bulan!=$bln_skrng)
		{
			$temp = 1;
		}
		else
		{
			$temp=$num+1;
		}
		return $temp;
	}

	function getmonthyeardate()
	{
		$today = date('ym');
		return $today;
	}

   function getnewnotrxwait()
	{
		
		$temp=getmonthyeardate();
		$temp2=getincrementnumber();
		$id="FS".$temp."".str_pad($temp2, 4, 0, STR_PAD_LEFT);	
		return $id;
		
	}
	//-----------akhir cari no baru----------------
	
	
	//--------tarik parameter utk simpan---------------
	$id_faktur = getnewnotrxwait();
		
	$id_pkb = $_POST['id_pkb'];
	
	$tot_total = str_replace(",","",$_POST['tot_total']);
	//--------akhir tarik parameter utk simpan------------
	

	
	//--- simpan header----
	
		
			mysql_query("insert into faktur(id_faktur,id_pkb,tgl_faktur,total,id_user)values('".$id_faktur."','".$id_pkb."',NOW(),'".$tot_total."','".$id_user."')") or die (mysql_error());
			
	$row=$_POST['jum'];
	$row2=$_POST['jum1'];
for ($i=1; $i<$row; $i++)
	{
		//---tarik parameter detail---
		$Id_Part = $_POST['Id_Part'.$i];
		$Qty = $_POST['Qty'.$i];
		$Harga = str_replace(",","", $_POST['Harga'.$i]);
		$Disc = str_replace(",","", $_POST['Disc'.$i]);
		//---akhir tarik parameter detail---
			if($Id_Part==''){
		}
		else{
		//---simpan detail---
		$query = "INSERT INTO faktur_dtl(id, qty_faktur, harga_faktur,id_faktur,disk_faktur) VALUES ('".$Id_Part."','".$Qty."','".$Harga."','".$id_faktur."','".$Disc."')";
		$hasil = mysql_query($query) or die (mysql_error());
	
	
		}
	}
	for ($i=1; $i<$row2; $i++)
	{
		//---tarik parameter detail ---
		$Id_Uraian = $_POST['Id_Uraian'.$i];
		$Jumlah2 = str_replace(",","", $_POST['Jumlah2'.$i]);
		//---akhir tarik parameter detail---
			if($Id_Uraian==''){
		}
		else{
		//---simpan detail---
		$query = "INSERT INTO faktur_dtl(id, harga_faktur,id_faktur) VALUES ('".$Id_Uraian."','".$Jumlah2."','".$id_faktur."')";
		$hasil = mysql_query($query) or die (mysql_error());
	
	
		}
	}
	mysql_query("update pkb set faktur='1' where id_pkb='".$id_pkb."'") or die (mysql_error());
	header("location:cetakfaktur.php?id=".$id_faktur);

?>