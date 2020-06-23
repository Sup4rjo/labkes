<?php 
	include_once 'config/db.php'; 
	$id = $_GET['id'];
	$delete	= mysqli_query($link,"DELETE FROM jenisfasilitas WHERE id=$id");
	
	if ($delete) {
		# code...
		header('location: dataorganisasi.php?dihapus');
	}
	else {
		header('location: dataorganisasi.php?err');
	}

?>