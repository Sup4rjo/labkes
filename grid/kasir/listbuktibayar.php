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
if(isset($_GET["id_bb"]))$id_bb = $_GET['id_bb'];
else $id_bb = "";
if(isset($_GET["nama_plg"]))$nama_plg = $_GET['nama_plg'];
else $nama_plg = "";

$where = "WHERE 1=1";
if($id_bb!='')$where.= " AND id_buktibayar LIKE '%$id_bb%'";
if($nama_plg!='')$where.= " AND nama LIKE '%$nama_plg%'";
$result = mysql_query("SELECT COUNT(*) AS count FROM buktibayar_hdr".$where);
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
$SQL = "SELECT * FROM buktibayar_hdr a,pelanggan b ".$where." and a.id_plg =b.id_plg ORDER BY $sidx $sord LIMIT $start , $limit";
$result = mysql_query($SQL) or die("Couldn't execute query2.".mysql_error());
$responce->page = $page;
$responce->total = $total_pages;
$responce->records = $count;
$i=0;
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
	$responce->rows[$i]['id']=$row[id_buktibayar]; 
    $responce->rows[$i]['cell']=array($row[id_buktibayar],$row[nama],$row[alamat],$row[tlp]); 
    $i++;
} 
echo $json->encode($responce);

?>