<?php 
	include_once 'config/db.php'; 
	$id = $_GET['id'];
	$delete	= mysqli_query($link,"DELETE FROM dokinvestasi WHERE id=$id");
	
	if ($delete) {
		# code...
		header('location: databerkas.php?dihapus');
	}
	else {
		header('location: databerkas.php?err');
	}

?>