<?php
error_reporting(0);
include("../../../../koneksi/koneksi.php");
include("../../../js/JSON.php");
$json = new Services_JSON();
$examp = $_GET["q"]; 
$page = $_GET['page']; 
$limit = $_GET['rows']; 
$sidx = $_GET['sidx']; 
$sord = $_GET['sord']; 
if(!$sidx) $sidx =1;		
$result = mysql_query("SELECT COUNT(*) AS count FROM submenu_dtl");
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
$SQL = "SELECT * FROM submenu_dtl,level where submenu_dtl.id_level=level.id_level ORDER BY level.id_level asc LIMIT $start , $limit";
$result = mysql_query($SQL) or die("Couldn't execute query2.".mysql_error());
$responce->page = $page;
$responce->total = $total_pages;
$responce->records = $count;
$i=0;
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
	$responce->rows[$i]['id']=$row[id_submenu_dtl]; 
    $responce->rows[$i]['cell']=array($row[id_submenu_dtl],$row[nama_level],$row[id_menu]); 
    $i++;
} 
echo $json->encode($responce);

?>


