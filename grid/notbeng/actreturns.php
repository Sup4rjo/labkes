<?php 
error_reporting(0);
session_start();
$id_user=$_SESSION['id_user'];
include("../../../koneksi/koneksi.php");

	function getincrementnumber()
	{
		$q = mysql_fetch_array( mysql_query('select id_retur_ns from retur_ns order by id_retur_ns desc limit 0,1'));
		
		$kode=substr($q['id_retur_ns'], -4);
		$bulan=substr($q['id_retur_ns'], -6,2);
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
		$id="RNS".$temp."".str_pad($temp2, 4, 0, STR_PAD_LEFT);	
		return $id;
		
	}
	
	$no_retur = getnewnotrxwait();
	$row=$_POST['jum'];
	
	
	
	//--- simpan header----
	mysql_query("insert into retur_ns(id_retur_ns,tgl_retur_ns,id_user)values('".$no_retur."',NOW(),'".$id_user."')") or die (mysql_error());
	//---akhir simpan header---
	
	for ($i=1; $i<=$row; $i++)
	{
		//---tarik parameter detail ---
		$Kd = $_POST['Kd'.$i];
		$Id_Part = $_POST['Id_Part'.$i];
		$QtyRetur = $_POST['Qty'.$i];
		$baris = $_POST['row'.$i];
		//---akhir tarik parameter detail ---
		
		if($baris=='on') //jika baris tidak on, akan dilewat
		{
			//---simpan detail ---
			$query = "INSERT INTO retur_dtl (id_retur_ns, qty_retur,id_ns_dtl) VALUES ('".$no_retur."','".$QtyRetur."','".$Kd."')";
			$hasil = mysql_query($query) or die (mysql_error());
			//--- END simpan detail---
			//mengambil qty ns
			$q = mysql_fetch_array( mysql_query("select * from ns_dtl where id_ns_dtl='".$Kd."'"));
	$temp=$q['qty_ns'];
	$qty=(int)$temp;
	$stok=$qty-$QtyRetur;
	//mengupdate qty ns
	mysql_query("update ns_dtl set qty_ns=".$stok.",flag_retur='1' where id_ns_dtl='".$Kd."'") or die ("update stok1 error".mysql_error());
	//tambah stok
	$q2 = mysql_fetch_array( mysql_query("select * from part where id_part='".$Id_Part."'"));
	$temp2=$q2['qty'];
	$qty2=(int)$temp2;
	$stok2=$qty2+$QtyRetur;
	//mengganti stok part
	mysql_query("update part set qty=".$stok2." where id_part='".$Id_Part."'") or die ("update stok1 error".mysql_error());
		}
		else
		{
			continue;
		}
		
	}
	header("location:cetakreturns.php?trx=".$no_retur);
?>