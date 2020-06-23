<?php 
	include_once 'config/db.php'; 
	$id = $_GET['id'];
	$select = mysqli_query($link,"SELECT * FROM fileinvestasi WHERE id=$id");
	$h=mysqli_fetch_array($select);
	$noreg= $h['no_register'];
	$filename= $h['filename'];
	$target_dir  = "dokumeninvestasi/";
    $target_file = $target_dir . $filename;

	$delete	= mysqli_query($link,"DELETE FROM fileinvestasi WHERE id=$id");
	
	if ($delete) {
		# code...
		unlink($target_file);
		header('location: uploadberkas.php?dihapus&noreg='.$noreg);
	}
	else {
		header('location: uploadberkas.php?err');
	}

?>