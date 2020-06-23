<?php 
error_reporting(0);
session_start();
$id_user=$_SESSION['id_user'];
include("../../../koneksi/koneksi.php");

	//----fungsi cari no baru ----
	function getincrementnumber()
	{
		$q = mysql_fetch_array( mysql_query('select id_ns from ns order by id_ns desc limit 0,1'));
		
		$kode=substr($q['id_ns'], -4);
		$bulan=substr($q['id_ns'], -6,2);
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
		$id="NS".$temp."".str_pad($temp2, 4, 0, STR_PAD_LEFT);	
		return $id;
		
	}
	//-----------akhir cari no baru----------------
	
	
	//--------tarik parameter utk simpan---------------
	$id_ns = getnewnotrxwait();
	$id_pkb = $_POST['id_pkb'];
	
	$row=$_POST['jum'];
	//--------akhir tarik parameter utk simpan------------
	

	
	//--- simpan header----
	mysql_query("insert into ns(id_ns,tgl_ns,id_pkb,id_user)values('".$id_ns."',NOW(),'".$id_pkb."','".$id_user."')") or die (mysql_error());
	//---akhir simpan header---
	
	for ($i=1; $i<$row; $i++)
	{
		//---tarik parameter detail---
		$Id_Part = $_POST['Id_Part'.$i];
		$Qty = $_POST['Qty'.$i];
		$Harga = str_replace(",","", $_POST['Harga'.$i]);
		
		//---akhir tarik parameter detail---
			if($Id_Part==''){
		}
		else{
		//---simpan detail---
		$query = "INSERT INTO ns_dtl(id_part, qty_ns, harga_ns,id_ns) VALUES ('".$Id_Part."','".$Qty."','".$Harga."','".$id_ns."')";
		$hasil = mysql_query($query) or die (mysql_error());
	
	$q = mysql_fetch_array( mysql_query("select * from part where id_part='".$Id_Part."'"));
	$qtypart=$q['qty'];
	$stok=$qtypart-$Qty;
	mysql_query("update part set qty='".$stok."' where id_part='".$Id_Part."'") or die ("update stok1 error".mysql_error());
		
		header("location:cetaknotasukucadang.php?id=".$id_ns);
		//--- END simpan detail---
		}
	}

?>