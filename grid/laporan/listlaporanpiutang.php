<?php
error_reporting(0);
ini_set('max_execution_time', 600);
include("../../../koneksi/koneksi.php");
include("../../js/JSON.php");
$json = new Services_JSON();
$examp = $_GET["q"]; //query number

$page = $_GET['page']; // get the requested page
$limit = $_GET['rows']; // get how many rows we want to have into the grid
$sidx = $_GET['sidx']; // get index row - i.e. user click to sort
$sord = $_GET['sord']; // get the direction
if(!$sidx) $sidx =1;

if(isset($_GET["bb_dari"]))$bb_dari = $_GET['bb_dari'];
else $bb_dari = "";
if(isset($_GET["bb_sampai"]))$bb_sampai = $_GET['bb_sampai'];
else $bb_sampai = "";
//construct where clause

$where = "WHERE 1=1";
if($bb_dari!='')$where.= " AND date(tgl_faktur) >= '$bb_dari'";
if($bb_sampai!='')$where.= " AND date(tgl_faktur) <= '$bb_sampai'"; 

$result = mysql_query("SELECT COUNT(*) AS count FROM faktur a 
INNER JOIN pkb b ON b.id_pkb=a.id_pkb
INNER JOIN registrasi c ON c.id_registrasi=b.id_registrasi
INNER JOIN kendaraan d ON d.no_polisi=c.no_polisi
INNER JOIN pelanggan e ON e.id_plg=d.id_plg
".$where." and lunas=0");
$row = mysql_fetch_array($result,MYSQL_ASSOC);
$count = $row['count'];

if( $count >0 ) {
	$total_pages = ceil($count/$limit);
} else {
	$total_pages = 0;
}
if ($page > $total_pages) $page=$total_pages;
if ($limit<0) $limit = 0;
$start = $limit*$page - $limit; // do not put $limit*($page - 1)
if ($start<0) $start = 0;
$SQL = "SELECT a.id_faktur,a.id_pkb,nama,d.no_polisi,total FROM faktur a 
INNER JOIN pkb b ON b.id_pkb=a.id_pkb
INNER JOIN registrasi c ON c.id_registrasi=b.id_registrasi
INNER JOIN kendaraan d ON d.no_polisi=c.no_polisi
INNER JOIN pelanggan e ON e.id_plg=d.id_plg
".$where." and lunas=0 ORDER BY $sidx $sord LIMIT $start , $limit";
$result = mysql_query( $SQL ) or die("Couldn't execute query.".mysql_error());
$responce->page = $page;
$responce->total = $total_pages;
$responce->records = $count;
$i=0;
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
	$responce->rows[$i]['id']=$row[id_faktur]; 
    $responce->rows[$i]['cell']=array($row[id_pkb],$row[id_faktur],$row[nama],$row[no_polisi],number_format($row[total],0)); 
    $i++;
} 
echo $json->encode($responce); // coment if php 5
//echo json_encode($responce);
mysql_close($db);
?>