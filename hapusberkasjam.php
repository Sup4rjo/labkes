<?php 
	include_once 'config/db.php'; 
	$id = $_GET['id'];
	$select = mysqli_query($link,"SELECT * FROM filejaminan WHERE id=$id");
	$h=mysqli_fetch_array($select);
	$kodejaminan= $h['kode_jaminan'];
	$filename= $h['filename'];
	$target_dir  = "dokumenjaminan/";
    $target_file = $target_dir . $filename;

	$delete	= mysqli_query($link,"DELETE FROM filejaminan WHERE id=$id");
	
	if ($delete) {
		# code...
		unlink($target_file);
		header('location: uploadjaminan.php?dihapus&kodejaminan='.$kodejaminan);
	}
	else {
		header('location: uploadjaminan.php?err&kodejaminan='.$kodejaminan);
	}

?>