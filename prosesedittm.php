<?php
include_once 'config/db.php';
include_once 'ceklogin.php';
    $error = 0;
    if (!empty($_POST)) {
        $sukses= 0;

        $kodeppu= $_POST['kodeppu'];
        $jenissurat = $_POST['jenissurat'];
        $nomorsurat = $_POST['nomorsurat'];
        $tanggalsurat = $_POST['tanggalsurat'];
        $tanggalsurat   = strtotime($tanggalsurat);
        $tanggalsurat   = date("Y-m-d" ,$tanggalsurat);
        $perihal = $_POST['perihal'];
        $keterangan = $_POST['keterangan'];

        // var_dump($_POST);
        $tambahdata= mysqli_query($link, "INSERT INTO suratmenyurat
            VALUES 
            ('','$jenissurat','$kodeppu','$nomorsurat','$tanggalsurat','$perihal','$keterangan','$namaberkas')");
        if ($tambahdata) {
            # code...
            $pesan="File berhasil diupdate";
            $sukses=1;
        }
        else{
            $pesan="File gagal diupdate";
            $error=1;
        }

        if ($sukses) {
            # code...
            header('location: datasurat.php?updated&pesan='.$pesan);
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
    <title>Input Surat Menyurat - Jakarta Ventura</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="assets/css/colors/blue.css" id="theme" rel="stylesheet">
    <link rel="stylesheet" href="assets/plugins/dropify/dist/css/dropify.min.css">
    <link href="assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
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
                    <h3 class="text-themecolor">Input Surat Menyurat</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Input Surat Menyurat</li>
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
                <?php
                    include_once 'config/lookupppu.php';
                ?>
                <!-- ============================================================== -->
                <div class="row justify-content-md-center">
                    <div class="col-lg-8">
                        <div class="card">
							<form action="" method="POST" enctype="multipart/form-data">
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
                                    <?php
                                        if ($error==1) {
                                            ?>
                                             <div class="alert alert-danger alert-rounded"> <i class="ti-close"></i> <?php echo $pesan;?>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                            </div>
                                            <?php
                                        }
                                    ?>
	                                <div class="row">
	                                	<div class="col-lg-12">
	                                		<div class="text-center text-md-left db">
			                                    <img src="assets/images/jakvent.png" class="logospecial">
			                                    <h1 class="h1special pull-right d-none d-md-block">Surat Menyurat</h1>
			                                </div> 
	                                	</div>
	                                </div>
	                                <hr>
	                                <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Kode PPU</label>
                                        <div class="col-lg-7">
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
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Jenis Surat</label>
                                        <div class="col-lg-9">
                                            <select name="jenissurat" id="jenissurat" class="form-control">
                                                <option value="">Pilih Jenis Surat</option>
                                                <option value="Surat Masuk">Surat Masuk</option>
                                                <option value="Surat Keluar">Surat Keluar</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Nomor Surat</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" name="nomorsurat" placeholder="Masukkan Nomor Surat">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Tanggal Surat</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" id="tanggal-surat" type="text" name="tanggalsurat" placeholder="Masukkan Tanggal Surat">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Perihal</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" name="perihal" placeholder="Masukkan Perihal Surat">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Keterangan</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" name="keterangan" placeholder="Masukkan keterangan Surat">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="input-file-now">File PDF:</label>
                                        <input type="file" name="file" id="file" class="dropify" />
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
    <script src="assets/plugins/moment/moment.js"></script>
    <script src="assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
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
    <script src="assets/plugins/dropify/dist/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify({
            messages: {
                default: 'Silahkan Upload File PDF di sini. Mohon memastikan ekstensi file yang akan di upload adalah PDF (.pdf) dengan ukuran kurang dari 50MB',
                replace: 'Klik Di sini untuk mengganti File PDF',
                remove: 'Hapus',
                error: 'Oops ada yang bermasalah'
            }
        });
        $(document).on('click', '.pilihppu', function (e) {
            document.getElementById("kodeppu").value = $(this).attr('data-kodeppu');
            document.getElementById("namappu").value = $(this).attr('data-namappu');
            $('#myModal').modal('hide');
        });
        $(function () {
            $('#tanggal-surat').bootstrapMaterialDatePicker({
                'format': 'DD MMMM YYYY',
                'time': false  
            }).change();
        });
    </script>

</body>

</html>
