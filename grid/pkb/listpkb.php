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
if(isset($_GET["no_pkb"]))$no_pkb = $_GET['no_pkb'];
else $no_pkb = "";
if(isset($_GET["nama_plg"]))$nama_plg = $_GET['nama_plg'];
else $nama_plg = "";
if(isset($_GET["no_polisi"]))$no_polisi = $_GET['no_polisi'];
else $no_polisi = "";


$where = "WHERE 1=1";
if($no_pkb!='')$where.= " AND id_pkb LIKE '%$no_pkb%'";
if($nama_plg!='')$where.= " AND nama LIKE '%$nama_plg%'";
if($no_polisi!='')$where.= " AND b.no_polisi LIKE '%$no_polisi%'";
	
$result = mysql_query("SELECT COUNT(*) AS count FROM pkb".$where);
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
$SQL = "SELECT * FROM pkb a,registrasi b,kendaraan c,pelanggan d ".$where." and a.id_registrasi=b.id_registrasi and b.no_polisi=c.no_polisi and c.id_plg=d.id_plg  ORDER BY $sidx $sord LIMIT $start , $limit";
$result = mysql_query($SQL) or die("Couldn't execute query2.".mysql_error());
$responce->page = $page;
$responce->total = $total_pages;
$responce->records = $count;
$i=0;
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
	$responce->rows[$i]['id']=$row[id_pkb]; 
    $responce->rows[$i]['cell']=array($row[id_pkb],$row[tgl_pkb],$row[id_registrasi],$row[tgl],$row[nama],$row[alamat],$row[no_polisi]); 
    $i++;
} 
echo $json->encode($responce);

?>