<?php 
	include_once 'config/db.php'; 
	$id = $_GET['id'];
	$delete	= mysqli_query($link,"DELETE FROM ppu WHERE id=$id");
	
	if ($delete) {
		# code...
		header('location: datatm.php?dihapus');
	}
	else {
		header('location: datatm.php?err');
	}

?>