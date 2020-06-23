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
if(isset($_GET["no_faktur"]))$no_faktur = $_GET['no_faktur'];
else $no_faktur = "";
if(isset($_GET["nama_plg"]))$nama_plg = $_GET['nama_plg'];
else $nama_plg = "";
if(isset($_GET["no_polisi"]))$no_polisi = $_GET['no_polisi'];
else $no_polisi = "";


$where = "WHERE 1=1";
if($no_faktur!='')$where.= " AND id_faktur LIKE '%$no_faktur%'";
if($nama_plg!='')$where.= " AND nama LIKE '%$nama_plg%'";
if($no_polisi!='')$where.= " AND c.no_polisi LIKE '%$no_polisi%'";	
$result = mysql_query("SELECT COUNT(*) AS count FROM faktur");
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
$SQL = "SELECT * FROM faktur a,pkb b,registrasi c,kendaraan d,pelanggan e ".$where." and a.id_pkb=b.id_pkb and b.id_registrasi=c.id_registrasi and c.no_polisi=d.no_polisi and d.id_plg=e.id_plg  ORDER BY $sidx $sord LIMIT $start , $limit";
$result = mysql_query($SQL) or die("Couldn't execute query2.".mysql_error());
$responce->page = $page;
$responce->total = $total_pages;
$responce->records = $count;
$i=0;
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
	$responce->rows[$i]['id']=$row[id_faktur]; 
    $responce->rows[$i]['cell']=array($row[id_faktur],$row[tgl_faktur],$row[id_pkb],$row[tgl_pkb],$row[nama],$row[alamat],$row[no_polisi]); 
    $i++;
} 
echo $json->encode($responce);

?>