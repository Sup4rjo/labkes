<?php 
	include_once 'config/db.php'; 
	$id = $_GET['id'];
	$select = mysqli_query($link,"SELECT * FROM dokjaminan WHERE id=$id");
	$h=mysqli_fetch_array($select);
	$noregister= $h['no_register'];
	$delete	= mysqli_query($link,"DELETE FROM dokjaminan WHERE id=$id");
	
	if ($delete) {
		# code...
		header('location: tambahjaminan.php?dihapus&noreg='.$noregister);
	}
	else {
		header('location: tambahjaminan.php?err&noreg='.$noregister);
	}

?>