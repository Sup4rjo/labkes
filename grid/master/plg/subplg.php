<?php
error_reporting(0);
ini_set('max_execution_time', 600);
include("../../../../koneksi/koneksi.php");
include("../../../js/JSON.php");
$json = new Services_JSON();

$examp = $_REQUEST["q"]; //query number
$page = $_GET['page'];  
// get the requested page  
$limit = $_GET['rows'];  
// get how many rows we want to have into the grid  
$sidx = $_GET['sidx'];  
// get index row - i.e. user click to sort  
$sord = $_GET['sord']; // get the direction if(!$sidx)  
if(!$sidx) $sidx =1; // connect to the database  
$id = $_REQUEST['id'];

$totalrows = isset($_REQUEST['totalrows']) ? $_REQUEST['totalrows']: false;
if($totalrows) {
	$limit = $totalrows;
}
switch ($examp) {
    case 1:
		$result = mysql_query("SELECT COUNT(*) AS count FROM kendaraan WHERE id_plg=".$id);
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		$count = $row['count'];

		if( $count >0 ) {
			$total_pages = ceil($count/$limit);
		} else {
			$total_pages = 0;
		}
        if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit; // do not put $limit*($page - 1)
		if ($start<0) $start = 0;
        $SQL = "select*from pelanggan,kendaraan where kendaraan.id_plg=pelanggan.id_plg and pelanggan.id_plg=".$id." ORDER BY $sidx $sord LIMIT $start , $limit";
		$result = mysql_query( $SQL ) or die("Couldn’t execute query.".mysql_error());
        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;
        $i=0;
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			$responce->rows[$i]['id']=$row[no_polisi];
            $responce->rows[$i]['cell']=array($row[no_polisi],$row[no_rangka],$row[type],$row[warna]);
            $i++;
		} 
		//echo $json->encode($responce);
        echo json_encode($responce);
        break;
		
		
	case 2:
	
	if(isset($_GET["no_pol"]))$no_pol = $_GET['no_pol'];
	else $no_pol = "";
	
	if(isset($_GET["no_rangka"]))$no_rangka = $_GET['no_rangka'];
	else $no_rangka = "";
	
	if(isset($_GET["merk"]))$merk = $_GET['merk'];
	else $merk = "";
	
	if(isset($_GET["nama_type"]))$nama_type = $_GET['nama_type'];
	else $nama_type = "";
	
	//construct where clause
	$where = "WHERE 1=1";
	if($no_pol!='')
		$where.= " AND no_polisi LIKE '%$no_pol%'";
	if($no_rangka!='')
		$where.= " AND no_rangka LIKE '%$no_rangka%'";
	if($merk!='')
		$where.= " AND nama_merk LIKE '%$merk%'";
	if($nama_type!='')
		$where.= " AND nama_type LIKE '%$nama_type%'";
		
		$result = mysql_query("select count(*) as count from pelanggan,kendaraan ".$where." AND kendaraan.id_plg=pelanggan.id_plg");
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
		$start = $limit*$page - $limit; // do not put $limit*($page - 1)  
	if ($start<0) $start = 0;  
	
        $SQL = "select*from pelanggan,kendaraan ".$where." AND kendaraan.id_plg=pelanggan.id_plg ORDER BY $sidx $sord LIMIT $start , $limit";
		$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error()); 
		 
		$responce->page = $page;  
		$responce->total = $total_pages;  
		$responce->records = $count;  
		$i=0;  
		while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
			$responce->rows[$i]['id']=$row[no_polisi];
            $responce->rows[$i]['cell']=array($row[no_polisi],$row[no_rangka],$row[type],$row[warna]);
            $i++;
		} 
		//echo $json->encode($responce);
        echo json_encode($responce);
        break;
	
}


?>
