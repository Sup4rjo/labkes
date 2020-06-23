<?php 
	include_once 'config/db.php'; 
	$id = $_GET['id'];
	$select = mysqli_query($link,"SELECT * FROM suratmenyurat WHERE id=$id");
	$h=mysqli_fetch_array($select);
	$delete	= mysqli_query($link,"DELETE FROM suratmenyurat WHERE id=$id");
	
	$filename= $h['filename'];
	$target_dir  = "surat/";
    $target_file = $target_dir . $filename;

	if ($delete) {
		# code...
		unlink(target_file);
		header('location: datasurat.php?dihapus');
	}
	else {
		header('location: datasurat.php?err');
	}

?>