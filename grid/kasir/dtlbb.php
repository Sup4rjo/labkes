<?php
include("../../../koneksi/koneksi.php");
include("../../js/JSON.php");
$json = new Services_JSON();

$page = $_GET['page']; // get the requested page
$limit = $_GET['rows']; // get how many rows we want to have into the grid
$sidx = $_GET['sidx']; // get index row - i.e. user click to sort
$sord = $_GET['sord']; // get the direction
$id = $_REQUEST['id'];
if(!$sidx) $sidx =1;

$result = mysql_query("select count(*) as count from buktibayar_dtl
where id_buktibayar= '".$id."' ");
$row = mysql_fetch_array($result,MYSQL_ASSOC);  
	$count = $row['count']; 
	$total_pages = ( $count >0 )?ceil($count/$limit):0;
	if ($page > $total_pages) $page=$total_pages;  
	if ($limit<0) $limit = 0;
		$start = $limit*$page - $limit; // do not put $limit*($page - 1)  

	if ($start<0) $start = 0; 
$SQL = "SELECT id_faktur,no_polisi,biaya,diskon,biaya+diskon as total from buktibayar_dtl where id_buktibayar='".$id."' ORDER BY $sidx $sord LIMIT $start , $limit";

$result = mysql_query( $SQL ) or die("Couldn't execute query2.".mysql_error());
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
  		header("Content-type: application/xhtml+xml;charset=utf-8"); } else {
  		header("Content-type: text/xml;charset=utf-8");
		}
	  	$et = ">";
  		echo "<?xml version='1.0' encoding='utf-8'?$et\n";
		echo "<rows>";
		// be sure to put text data in CDATA
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			echo "<row>";		
			echo "<cell>". $row[id_faktur]."</cell>";	
			echo "<cell>". $row[no_polisi]."</cell>";
			echo "<cell>". number_format($row[total],0)."</cell>";
			echo "<cell>". number_format($row[diskon],0)."</cell>";
			echo "<cell>". number_format($row[biaya],0)."</cell>";
			echo "</row>";
		}
		echo "</rows>";	
?>


