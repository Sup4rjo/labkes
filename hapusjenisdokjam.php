<?php 
	include_once 'config/db.php'; 
	$id = $_GET['id'];
	$delete	= mysqli_query($link,"DELETE FROM jenisdokjaminan WHERE id=$id");
	
	if ($delete) {
		# code...
		header('location: jenisdokjam.php?dihapus');
	}
	else {
		header('location: jenisdokjam.php?err');
	}

?>