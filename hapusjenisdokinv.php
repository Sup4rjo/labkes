<?php 
	include_once 'config/db.php'; 
	$id = $_GET['id'];
	$delete	= mysqli_query($link,"DELETE FROM jenisdokinvestasi WHERE id=$id");
	
	if ($delete) {
		# code...
		header('location: jenisdokinv.php?dihapus');
	}
	else {
		header('location: jenisdokinv.php?err');
	}

?>