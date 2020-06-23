<?php 
error_reporting(0);
session_start();
$id_user=$_SESSION['id_user'];
	include"../../../koneksi/koneksi.php";

	function getincrementnumber()
	{
		$q = mysql_fetch_array( mysql_query('select id_buktibayar from buktibayar_hdr order by id_buktibayar desc limit 0,1'));
		
		$kode=substr($q['id_buktibayar'], -4);
		$bulan=substr($q['id_buktibayar'], -6,2);
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
		$id="BB".$temp."".str_pad($temp2, 4, 0, STR_PAD_LEFT);	
		return $id;
		
	}
	
	//--------mengambil parameter utk disimpan---------------
	$id_buktibayar = getnewnotrxwait();
	$id_plg = $_POST['id_plg'];
	$jumlah = str_replace(",","", $_POST['jumlah_bayar']);
	$diskon = str_replace(",","", $_POST['diskon']);
		$jenis_bayar = str_replace(",","", $_POST['jenis_bayar']);

	$bank = (!empty($_POST['bank'])) ? $_POST['bank'] : 0 ;
		$no_kartu = $_POST['no_kartu'];
		$no_giro = $_POST['no_giro'];
	
	$row=$_POST['jum'];
	
		mysql_query("insert into buktibayar_hdr(id_buktibayar,id_plg,jumlah_bayar,jumlah_diskon,tgl_buktibayar,no_kartu,no_giro,id_jenis_bayar,id_jenis_bank,id_user)values('".$id_buktibayar."','".$id_plg."','".$jumlah."','".$diskon."',NOW(),'".$no_kartu."','".$no_giro."','".$jenis_bayar."','".$bank."','".$id_user."')") or die (mysql_error());
	
	
	for ($i=1; $i<$row; $i++)
	{
		//---tarik parameter detail bb---
		$Jumlah = str_replace(",","", $_POST['Jumlah'.$i]);
		$Faktur = $_POST['No_Faktur'.$i];
		$Polisi = $_POST['No_Polisi'.$i];
		$Disc = str_replace(",","", $_POST['Disc'.$i]);
		
			
		
		//---simpan detail bb---
		$query = "INSERT INTO buktibayar_dtl(id_faktur,id_buktibayar, biaya,no_polisi,diskon) VALUES ('".$Faktur."','".$id_buktibayar."','".$Jumlah."','".$Polisi."','".$Disc."')";
		$hasil = mysql_query($query) or die (mysql_error());
	mysql_query("update faktur set lunas=1 where id_faktur='".$Faktur."'");
		//--- END simpan detail b---
		

	}
header("location:cetakbuktibayar.php?id=".$id_buktibayar.""); //---pindah ke halaman cetak bb---	




?>