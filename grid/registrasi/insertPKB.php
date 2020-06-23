<?PHP
error_reporting(0);
include("../../../koneksi/koneksi.php");
$regis=$_REQUEST['id'];
mysql_query("update registrasi set flag_pkb='1' where id_registrasi='".$regis."'");
header("location:formpkb.php?id=$regis");
?>