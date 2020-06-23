<?php
include("../../../../koneksi/koneksi.php");
$SQL = "SELECT * FROM level";
$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error()); 

while($row = mysql_fetch_object($result)) {  
    $rows[]=$row; 
   
} 
$var =  json_encode($rows);
echo $var;
?>
