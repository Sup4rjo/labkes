<?php 
	include_once 'config/db.php'; 
	$id = $_GET['id'];
	$delete	= mysqli_query($link,"DELETE FROM jenisjaminan WHERE id=$id");
	
	if ($delete) {
		# code...
		header('location: jenisjaminan.php?dihapus');
	}
	else {
		header('location: jenisjaminan.php?err');
	}

?>