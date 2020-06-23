<?php
include_once 'config/db.php';
include_once 'ceklogin.php';

    if (!empty($_POST)) {
        // var_dump($_POST);
        $kodeppu= $_POST['kodeppu'];
        $kodefasilitas= $_POST['kodefasilitas'];
        $tanggalpencairan= $_POST['tanggalpencairan'];
        $plafond= $_POST['plafond'];
        $noperjanjian= $_POST['noperjanjian'];
        $tanggalperjanjian= $_POST['tanggalperjanjian'];

        $carikode = mysqli_query($link, "SELECT no_register FROM dokinvestasi ORDER BY id DESC LIMIT 1") or die (mysql_error());
        // menjadikannya array
        $datakode = mysqli_fetch_array($carikode);
        $nomorterakhir= $datakode['no_register'];
        $noregister=buatkode($nomorterakhir, 'REG', 5);

        $tanggalpencairan   = strtotime($tanggalpencairan);
        $tgl_pencairan   = date("Y-m-d" ,$tanggalpencairan);

        $tanggalperjanjian   = strtotime($tanggalperjanjian);
        $tgl_perjanjian   = date("Y-m-d" ,$tanggalperjanjian);

        $insert= mysqli_query($link,"INSERT INTO dokinvestasi (
            no_register, 
            kode_ppu, 
            kode_fasilitas,
            tanggal_pencairan,
            plafond,
            no_perjanjian,
            tanggal_perjanjian
            ) VALUES (
            '$noregister',
            '$kodeppu',
            '$kodefasilitas',
            '$tgl_pencairan',
            '$plafond',
            '$noperjanjian',
            '$tgl_perjanjian'
            )
        ");

        if ($insert) {
            header('location: databerkas.php?add');
        }
        else{
            header('location: databerkas.php?err');
        }
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
    <title>Tambah Dokumen - Jakarta Ventura</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="assets/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <link href="assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
	<style type="text/css">
        .h1special {
            font-size: 1.5rem;
        }
        .logospecial {
            height: 70px;
        }

        @media (min-width: 1024px) {
            .h1special {
                font-size: 2.5rem;
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
                    <h3 class="text-themecolor">Tambah Dokumen</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Dokumen</li>
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
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                
		        <?php
		        	include_once 'config/lookupppu.php';
                    include_once 'config/lookupfasilitas.php';
		        ?>
                <div class="row justify-content-md-center">
                    <div class="col-lg-9">
                        <div class="card">
							<form action="" method="POST">
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
			                                    <h1 class="h1special pull-right d-none d-md-block">Dokumen Investasi</h1>
			                                </div> 
	                                	</div>
	                                </div>
	                                <hr>
	                                <div class="form-group row">
	                                    <label for="example-text-input" class="col-lg-3 col-form-label">Kode PPU</label>
	                                    <div class="col-lg-8">
	                                        <input class="form-control" type="text" name="kodeppu" id="kodeppu" placeholder="Masukkan Kode PPU" readonly>
	                                    </div>
	                                    <div class="col-lg-1">
	                                    	<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">. . .</button>
	                                    </div>
	                                </div>
	                                <div class="form-group row">
	                                    <label for="example-text-input" class="col-lg-3 col-form-label">Nama PPU</label>
	                                    <div class="col-lg-9">
	                                        <input class="form-control" type="text" name="namappu" id="namappu" placeholder="Masukkan Nama PPU" readonly>
	                                    </div>
	                                </div>
	                                <div class="form-group row">
	                                    <label for="example-text-input" class="col-lg-3 col-form-label">Kode Fasilitas</label>
	                                    <div class="col-lg-8">
	                                        <input class="form-control" type="text" id="kodefasilitas" name="kodefasilitas" placeholder="Masukkan Kode Fasilitas" readonly>
	                                    </div>
                                        <div class="col-lg-1">
                                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalfasilitas">. . .</button>
                                        </div>
	                                </div>
	                                <div class="form-group row">
	                                    <label for="example-text-input" class="col-lg-3 col-form-label">Tgl Pencairan</label>
	                                    <div class="col-lg-9">
	                                        <input class="form-control" id="tanggal-pencairan" name="tanggalpencairan" type="text" required="" placeholder="Masukkan Tanggal Pencairan">
	                                    </div>
	                                </div>
	                                <div class="form-group row">
	                                    <label for="example-text-input" class="col-lg-3 col-form-label">Plafond</label>
	                                    <div class="col-lg-9">
	                                        <input class="form-control" type="text" name="plafond" placeholder="Masukkan Plafond">
	                                    </div>
	                                </div>
	                                <div class="form-group row">
	                                    <label for="example-text-input" class="col-lg-3 col-form-label">No Perjanjian</label>
	                                    <div class="col-lg-9">
	                                        <input class="form-control" type="text" name="noperjanjian" placeholder="Masukkan No Perjanjian">
	                                    </div>
	                                </div>
	                                <div class="form-group row">
	                                    <label for="example-text-input" class="col-lg-3 col-form-label">Tgl Perjanjian</label>
	                                    <div class="col-lg-9">
	                                        <input class="form-control" type="text" id="tanggal-perjanjian" name="tanggalperjanjian" placeholder="Masukkan Tanggal Perjanjian">
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="card-footer">
	                               <div class="row">
	                                    <div class="col-md-12">
	                                        <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
	                                    </div>
	                                </div> 
	                            </div>
                            </form>
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
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/moment/moment.js"></script>
    <script src="assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
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
    <script>
    	
//            jika dipilih, kode obat akan masuk ke input dan modal di tutup
            $(document).on('click', '.pilihppu', function (e) {
                document.getElementById("kodeppu").value = $(this).attr('data-kodeppu');
                document.getElementById("namappu").value = $(this).attr('data-namappu');
                $('#myModal').modal('hide');
            });
            $(document).on('click', '.pilihfasilitas', function (e) {
                document.getElementById("kodefasilitas").value = $(this).attr('data-kodefasilitas');
                // document.getElementById("namappu").value = $(this).attr('data-namafasilitas');
                $('#modalfasilitas').modal('hide');
            });

//            tabel lookup obat
            $(function () {
                $(".table").DataTable();
                $('#tanggal-pencairan').bootstrapMaterialDatePicker({
                    'format': 'DD MMMM YYYY',
                    'time': false  
                }).change();
                $('#tanggal-perjanjian').bootstrapMaterialDatePicker({
                    'format': 'DD MMMM YYYY',
                    'time': false  
                }).change();
            });
    </script>

</body>

</html>
