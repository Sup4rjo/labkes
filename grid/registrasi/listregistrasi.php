<?php
error_reporting(0);
include("../../../koneksi/koneksi.php");
include("../../js/JSON.php");
$json = new Services_JSON();
$examp = $_GET["q"]; 
$page = $_GET['page']; 
$limit = $_GET['rows']; 
$sidx = $_GET['sidx']; 
$sord = $_GET['sord']; 
if(!$sidx) $sidx =1;		
if(isset($_GET["no_regis"]))$no_regis = $_GET['no_regis'];
else $no_regis = "";
if(isset($_GET["nama_plg"]))$nama_plg = $_GET['nama_plg'];
else $nama_plg = "";
if(isset($_GET["no_polisi"]))$no_polisi = $_GET['no_polisi'];
else $no_polisi = "";


$where = "WHERE 1=1";
if($no_regis!='')$where.= " AND id_registrasi LIKE '%$no_regis%'";
if($nama_plg!='')$where.= " AND nama LIKE '%$nama_plg%'";
if($no_polisi!='')$where.= " AND a.no_polisi LIKE '%$no_polisi%'";
$result = mysql_query("SELECT COUNT(*) AS count FROM registrasi ".$where." and flag_pkb=0");
$row = mysql_fetch_array($result,MYSQL_ASSOC);  
	$count = $row['count']; 
	if( $count >0 ) {  
		$total_pages = ceil($count/$limit);  
	}  
	else {  
		$total_pages = 0;  
	}  
	if ($page > $total_pages) $page=$total_pages;  
	if ($limit<0) $limit = 0;
		$start = $limit*$page - $limit; 

	if ($start<0) $start = 0; 
$SQL = "SELECT * FROM registrasi a,kendaraan b,pelanggan c ".$where." and flag_pkb=0 and a.no_polisi=b.no_polisi and c.id_plg=b.id_plg  ORDER BY $sidx $sord LIMIT $start , $limit";
$result = mysql_query($SQL) or die("Couldn't execute query2.".mysql_error());
$responce->page = $page;
$responce->total = $total_pages;
$responce->records = $count;
$i=0;
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
	$responce->rows[$i]['id']=$row[id_registrasi]; 
    $responce->rows[$i]['cell']=array($row[id_registrasi],$row[nama],$row[no_polisi],$row[type],$row[odometer],$row[tgl]); 
    $i++;
} 
echo $json->encode($responce);

?>