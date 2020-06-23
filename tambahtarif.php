<?php
include_once 'config/db.php';
include_once 'ceklogin.php';

    if (!empty($_POST)) {
        # code...
        $nip_nik= $_POST['nip_nik'];
        $nama= $_POST['nama'];
        $alamat= $_POST['alamat'];
        $telpon= $_POST['telpon'];
        $jenis_kelamin= $_POST['jenis_kelamin'];
        $profesi= $_POST['profesi'];
        $status= $_POST['status'];
        // var_dump($_POST);
        $cekkode = mysqli_query($link, "SELECT * FROM ppu
            WHERE kode_ppu=$kodeppu");
        $jum     = mysqli_num_rows($cekkode);
        if ($jum==0) {
            $insert= mysqli_query($link,"INSERT INTO ppu
                VALUES 
                ('','$nip_nik','$nama','$alamat','$telpon','$jenis_kelamin','$profesi','$status')");
            if ($insert) {
                header('location: datatm.php?add');
            }
            else{
                header('location: datatm.php?err');
            }
        }
        else{
            header('location: datatm.php?err=already');
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
    <title>Tarif Pemeriksaan - Labkes Ungaran</title>
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
                    <h3 class="text-themecolor">Tarif Pemeriksaan </h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Tarif Pemeriksaan</li>
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
                <div class="row justify-content-md-center">
                    <div class="col-lg-12">
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
			                                    <h2 class="h2special pull-right d-none d-md-block">Master Tarif Pemeriksaan</h1>
			                                </div> 
	                                	</div>
	                                </div>
	                                <hr>
	                                <div class="form-group row">
	                                    <label for="example-text-input" class="col-lg-2 col-form-label" style="color: black; font-size: 16px; font-weight: bold;">Kode Induk*</label>
	                                    <div class="col-lg-2">
	                                        <input class="form-control" type="text" name="nip_nik" placeholder="masukan nip/nik">
	                                    </div>

                                        <label for="example-text-input" class="col-lg-2 col-form-label" style="color: black; font-size: 16px; font-weight: bold;">Tarif Induk *</label>
                                        <div class="col-lg-5">
                                            <input class="form-control" type="text" name="nama" placeholder="masukkan nama">
                                        </div>
	                                </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Tarif Induk</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" name="nama" placeholder="masukkan nama">
                                        </div>
                                    </div>

	                                <div class="form-group row">
	                                    <label for="example-text-input" class="col-lg-3 col-form-label">Alamat</label>
	                                    <div class="col-lg-9">
	                                        <input class="form-control" type="text" name="alamat" placeholder="masukkan alamat">
	                                    </div>
	                                </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Telpon</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" name="telpon" placeholder="masukan nomor telpon yang bisa dihubungi">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Jenis Kelamin</label>
                                        <div class="col-lg-9">
                                        <select class="form-control custom-select" name="jenis_kelamin">
                                                    <option value="0">Silahkan pilih</option>
                                                    <option value="Laki-laki">Laki-laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                            </select>

                                            <!-- <input class="form-control" type="text" name="jenis_kelamin" placeholder="Silahkan pilih"> -->
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Profesi</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" name="profesi" placeholder="Silahkan pilih">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Status</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" name="status" placeholder="Silahkan pilih">
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

</body>

</html>
