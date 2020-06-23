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
if($no_pkb!='')$where.= " AND b.id_pkb LIKE '%$no_pkb%'";
if($nama_plg!='')$where.= " AND nama LIKE '%$nama_plg%'";
if($no_polisi!='')$where.= " AND c.no_polisi LIKE '%$no_polisi%'";		
$result = mysql_query("SELECT COUNT(*) AS count FROM ns");
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
$SQL = "SELECT a.id_retur_ns,tgl_retur_ns, d.id_ns,e.id_pkb FROM retur_dtl a
inner join retur_ns b on b.id_retur_ns=a.id_retur_ns
inner join ns_dtl c on c.id_ns_dtl=a.id_ns_dtl
inner join ns d on d.id_ns=c.id_ns
inner join pkb e on e.id_pkb=d.id_pkb
".$where."  group by a.id_retur_ns ORDER BY $sidx $sord LIMIT $start , $limit";
$result = mysql_query($SQL) or die("Couldn't execute query2.".mysql_error());
$responce->page = $page;
$responce->total = $total_pages;
$responce->records = $count;
$i=0;
while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
	$responce->rows[$i]['id']=$row[id_retur_ns]; 
    $responce->rows[$i]['cell']=array($row[id_retur_ns],date_format(date_create($row[tgl_retur_ns]),'d-m-Y'),$row[id_ns],$row[id_pkb]); 
    $i++;
} 
echo $json->encode($responce);

?>