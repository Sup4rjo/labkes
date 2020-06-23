<?php
include_once 'config/db.php';
include_once 'ceklogin.php';
    if (!empty($_GET)) {
        $noreg= $_GET['noreg'];
        echo "<script> var filled= 1; </script>";
    }
    else{
        echo "<script> var filled= 0; </script>";
    }
    
    $error = 0;
    $sukses= 0;
    ///////////////////////////////////////////
    if (!empty($_POST)) {

        $noreg= $_GET['noreg'];
        
        if (isset($noreg)) {
            # code...
            $sqlcek  = mysqli_query($link,"SELECT * FROM dokinvestasi WHERE dokinvestasi.no_register='$noreg'");
            $rowcek=mysqli_num_rows($sqlcek);
            if ($rowcek==1) {
                $datacek=true;
            }
            else{
                $datacek=false;
            }
        }
        else{
            $datacek=false;
        }

        if ($datacek) {
            $jenisdokumen= $_POST['jenisdokumen'];
            $target_dir  = "dokumeninvestasi/";
            $namaberkas  = basename($_FILES["file"]["name"]);
            $target_file = $target_dir . $namaberkas;
            $uploadOk = 1;
            $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if file already exists
            if (file_exists($target_file)) {
                $pesan= "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["file"]["size"] > 5000000) {
                $pesan= "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($FileType != "pdf" ) {
                $pesan= "Sorry, only PDF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                // echo "Sorry, your file was not uploaded.";
                $error = 1;
            // if everything is ok, try to upload file
            } else {
                
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                    // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                    $tambahdata= mysqli_query($link, "INSERT INTO fileinvestasi
                        VALUES 
                        ('','$noreg','$jenisdokumen','$namaberkas')");
                    if ($tambahdata) {
                        # code...
                        $pesan="File berhasil ditambahkan";
                        $sukses=1;
                    }
                    else{
                        $pesan="File gagal ditambahkan, upload dibatalkan";
                        unlink($target_file);
                        $error=1;
                    }
                } else {
                    $pesan= "Sorry, there was an error uploading your file.";
                    $error=1;
                }
            }
        } 
        else{
            $pesan= "Maaf No Register Tidak Valid atau Belum dimasukkan";
            $error = 1;
        }   
        // echo $pesan;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/x-icon" sizes="16x16" href="assets/images/favicon.ico">
    <title>Dokumen Investasi <?php echo (isset($noreg)) ? $noreg : '' ; ?> - Jakarta Ventura</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/plugins/dropify/dist/css/dropify.min.css">
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="assets/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- select2 -->
    <link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/select2/dist/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/select2/dist/css/pmd-select2.css" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
	<style type="text/css">
        .h1special {
            font-size: 1.5rem;
        }
        .logospecial {
            height: 70px;
        }

        @media (min-width: 1024px) {
            .h1special {
                font-size: 1.5rem;
                margin-top: 20px;
            }
            .logospecial {
                height: 70px;
            }
            
        }

    </style>
</head>

<body class="fix-header card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php
        include_once 'include/header.php';
        ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php
        include_once 'include/left-sidebar.php';
        ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Upload Dokumen</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Upload Dokumen</li>
                    </ol>
                </div>
                <!-- <div>
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div> -->
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <?php
                include_once 'config/lookupinvestasi.php';
            ?>
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->

                <div class="row">
                	<div class="col-lg-12">
                		<div class="card">
							<div class="card-body">
                                <?php 
                                    if ($error==1) {
                                        ?>
                                         <div class="alert alert-danger alert-rounded"> <i class="ti-close"></i> <?php echo $pesan;?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                        </div>
                                        <?php
                                    }
                                ?>
                                <?php 
                                    if ($sukses==1) {
                                        ?>
                                         <div class="alert alert-success alert-rounded"> <i class="ti-check"></i> <?php echo $pesan;?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                        </div>
                                        <?php
                                    }
                                ?>

								<form action="">
									<div class="form-group row">
		                                <div class="col-lg-6">
											<div class="row">
												<a data-toggle="collapse" href="#tabelinv" role="button" aria-expanded="false" aria-controls="collapseExample" class="col-lg-4 col-form-label">No Register</a>
				                                <div class="col-lg-8">
				                                    <input id="noregister" class="form-control" type="text" name="noreg" placeholder="Masukkan No Register">
				                                </div>
											</div>			    
		                                </div>
		                                <div class="col-lg-6">
		                                	<button type="button" data-toggle="modal" data-target="#modalinvestasi" class="btn">. . .</button>
		                                	<button class="btn btn-info">Proses</button>
		                                </div>
		                                
		                            </div>
								</form>
								
								<div class="collapse" id="tabelinv">
									<!-- <div class="card card-body"> -->
									    <table class="table table-bordered">
											<thead>
												<th>No Register</th>
												<th>Kode PPU</th>
												<th>Nama</th>
												<th>Kode Fasilitas</th>
												<th>Tanggal Pencairan</th>
												<th>Plafond</th>
												<th>No Perjanjian</th>
												<th>Tanggal Perjanjian</th>
											</thead>
											<tbody>
										        <tr>
                                                    <?php
                                                        $data=0;
                                                        if (isset($noreg)) {
                                                            # code...
                                                            $sql  = mysqli_query($link,"SELECT * FROM dokinvestasi NATURAL JOIN ppu WHERE dokinvestasi.no_register='$noreg'");
                                                            $row=mysqli_num_rows($sql);
                                                            if ($row==1) {
                                                                # code...
                                                                $data=true;
                                                                $r=mysqli_fetch_array($sql);
                                                            }
                                                            else{
                                                                $data=0;
                                                            }
                                                        }
                                                        if ($data) {
                                                            # code...
                                                            ?>
                                                            <td><?php echo $r['no_register'];?></td>
                                                            <td><?php echo $r['kode_ppu'];?></td>
                                                            <td><?php echo $r['nama_ppu'];?></td>
                                                            <td><?php echo $r['kode_fasilitas'];?></td>
                                                            <td><?php echo $r['tanggal_pencairan'];?></td>
                                                            <td><?php echo $r['plafond'];?></td>
                                                            <td><?php echo $r['no_perjanjian'];?></td>
                                                            <td><?php echo $r['tanggal_perjanjian'];?></td>
                                                            <?php
                                                            echo "<script> var namappu= ".$r['nama_ppu']."</script>";
                                                        }
                                                        else{
                                                            echo "<td colspan='8'>Data Tidak Ditemukan</td>";
                                                        }
                                                    ?>                              
                                                </tr>
											</tbody>
										</table>
									<!-- </div> -->
								</div>

							</div>
                        </div>
                	</div>
                </div>

                <div class="row justify-content-md-center">
                    <div class="col-lg-6">
                        <div class="card">
							<form action="" method="POST"  enctype="multipart/form-data">
	                            <div class="card-body">
	                                <?php
	                                if (isset($_GET['priverror'])) {
	                                    ?>
	                                <div class="alert alert-danger alert-rounded">
	                                	<i class="ti-close"></i> Oops error atau Anda tidak memiliki hak akses!
	                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
	                                </div>
	                                <?php
	                                }
	                                ?>
	                                <div class="row">
	                                	<div class="col-lg-12">
	                                		<div class="text-center text-md-left db">
			                                    <img src="assets/images/jakvent.png" class="logospecial">
			                                    <h1 class="h1special pull-right d-none d-md-block">Upload Dokumen</h1>
			                                </div> 
	                                	</div>
	                                </div>
	                                <hr>
	                                
	                                <div class="form-group row">
	                                    <label for="example-text-input" class="col-lg-4 col-form-label">Jenis Dokumen</label>
	                                    <div class="col-lg-8">
	                                        <select id="jenisdokinv" name="jenisdokumen" class="pmd-select2 select-with-search form-control custom-select">
                                                <option>Pilih Jenis Dokumen</option>
                                                <?php  
                                                    $sql=mysqli_query($link, "SELECT * FROM jenisdokinvestasi");
                                                    while($list=mysqli_fetch_array($sql)){
                                                        ?>
                                                        <option value="<?php echo $list['id']; ?>"><?php echo $list['jenis_dokumen']; ?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
	                                    </div>
	                                </div>
	                                <div class="form-group">
	                                    <label for="input-file-now">File PDF:</label>
                                		<input type="file" name="file" id="file" class="dropify" />
	                                </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-info"><i class="fa fa-upload"></i> Upload</button>
                                        </div>
                                    </div>
	                            </div>
	                            <!-- <div class="card-footer">
	                                
	                            </div> -->
                            </form>
                        </div>
                    </div>
					<div class="col-lg-6">
                        <div class="card">
							<div class="card-body">
								<div class="row">
                                	<div class="col-lg-12">
                                		<div class="text-center text-md-left db">
		                                    <img src="assets/images/jakvent.png" class="logospecial">
		                                    <h1 class="h1special pull-right d-none d-md-block">Dokumen Investasi</h1>
		                                </div> 
                                	</div>
                                </div>
                                <hr>
                                <div class="table-responsive">
                                	<table class="table table-bordered nowrap" id="berkas">
                                		<thead>
                                			<!-- <th>No Register</th> -->
                                			<th>Jenis</th>
                                			<th>File PDF</th>
                                            <th>Pilihan</th>
                                		</thead>
                                		<tbody>
                                    
                                        <?php
                                            if (isset($noreg)) {
                                                # code...
                                                $sql2  = mysqli_query($link,"SELECT f.filename as filename, j.jenis_dokumen as jenis_dokumen,f.id FROM fileinvestasi f LEFT JOIN jenisdokinvestasi j ON f.jenis_dokumen=j.id WHERE f.no_register='$noreg'");
                                                while($d=mysqli_fetch_array($sql2)){
                                                ?>
                                                <tr>
                                                    <!-- <td>REG00001</td> -->
                                                    
                                                    <td><?php echo $d['jenis_dokumen'];?></td>
                                                    <td><?php echo $d['filename'];?></td>
                                                    <td>
                                                        <a href="hapusberkasinv.php?id=<?php echo $d['id']?>">
                                                            <button class="btn btn-sm">Hapus</button>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                                }
                                            }
                                            
                                        ?>
                                			
                                		</tbody>
                                	</table>
                                </div>

							</div>
							<div class="card-footer">
                               <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-success"><i class="fa fa-check"></i> Lanjut Proses Jaminan</button>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->

                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php
            include_once 'include/footer.php';
            ?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/dropify/dist/js/dropify.min.js"></script>
    
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/plugins/bootstrap/js/popper.min.js"></script>

    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="assets/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="assets/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="assets/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="assets/js/custom.min.js"></script>
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/select2/dist/js/select2.full.js" type="text/javascript"></script>
    <script src="assets/plugins/select2/dist/js/pmd-select2.js" type="text/javascript"></script>
    <script src="assets/js/dtbutton/dataTables.buttons.js"></script>
    <script src="assets/js/dtbutton/jszip.js"></script>
    <script src="assets/js/dtbutton/pdfmake.js"></script>
    <script src="assets/js/dtbutton/vfs_fonts.js"></script>
    <script src="assets/js/dtbutton/buttons.html5.js"></script>
    <script src="assets/js/dtbutton/buttons.print.js"></script>
    <script>
    	$('.dropify').dropify({
            messages: {
                default: 'Silahkan Upload File PDF di sini. Mohon memastikan ekstensi file yang akan di upload adalah PDF (.pdf) dengan ukuran kurang dari 50MB',
                replace: 'Klik Di sini untuk mengganti File PDF',
                remove: 'Hapus',
                error: 'Oops ada yang bermasalah'
            }
        });
        $(document).on('click', '.pilihinvestasi', function (e) {
            document.getElementById("noregister").value = $(this).attr('data-noregister');
            // document.getElementById("namappu").value = $(this).attr('data-namafasilitas');
            $('#modalinvestasi').modal('hide');
        });

        $(document).ready(function() {
            if (filled) {
                $('#tabelinv').collapse();
            }
            $('#berkas').DataTable({
                dom: "<'row'<'col-12'B>><'row'<'col-sm-12'l>>"+"rtip",
                buttons:[
                    {
                        extend: 'excel',
                        text:'Export to Excel',
                        className: 'btn btn-sm',
                        exportOptions: {
                            columns: [0,1]
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-sm',
                        messageTop: 'Berkas Dokumen Investasi yang terdaftar di Jakarta Ventura',
                        exportOptions: {
                            columns: [0,1]
                        }
                    }
                ]
            });
            $(".select-with-search").select2({
                theme: "bootstrap"
            });
        });
    </script>
    

</body>

</html>
