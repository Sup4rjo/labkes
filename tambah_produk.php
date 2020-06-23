<?php
    include_once 'config/db.php';
    include_once 'ceklogin.php';

    if (!empty($_POST)) {
        # code...
        $kode_katagori= $_POST['kdkatagori'];
        $kode_produk= $_POST['kdproduk'];
        $nama_produk= $_POST['nmproduk'];
        $min_rujukan= $_POST['min_rujukan'];
        $max_rujukan= $_POST['max_rujukan'];
        $satuan= $_POST['snrujukan'];
        // var_dump($_POST);
        $cekkode = mysqli_query($link, "SELECT * FROM produk_tarif
            WHERE kode_produk='$kode_produk'");
        $jum     = mysqli_num_rows($cekkode);
        if ($jum==0) {
            $insert= mysqli_query($link,"INSERT INTO produk_tarif
                (kode_katagori, kode_produk, nama_produk, min_rujukan, max_rujukan, satuan)
                VALUES 
                ('$kode_katagori','$kode_produk','$nama_produk','$min_rujukan','$max_rujukan','$satuan')");
            if ($insert) {
                header('location: produk.php?add');
            }
            else{
                //header('location: dataorganisasi.php?err');
                printf("Query failed: %s\n", mysqli_error($link));
            }
        }
        else{
            header('location: produk.php?err=already');
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
    <title>Data Produk Tarif - Labkes Ungaran</title>
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
                    <h3 class="text-themecolor">Tambah Produk Tarif</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Produk Tarif</li>
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

            <?php
                include_once 'config/lookup_katagori.php';
            ?>
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row justify-content-md-center">
                    <div class="col-lg-10">
                        <div class="card">
							<form action="" method="POST">
	                            <div class="card-body">
	                                
	                                <div class="row">
	                                	<div class="col-lg-10">
	                                		<div class="text-center text-md-left db">
			                                    <img src="assets/images/jakvent.png" class="logospecial">
			                                    <h1 class="h1special pull-right d-none d-md-block">Data Produk Tarif</h1>
			                                </div> 
	                                	</div>
	                                </div>
	                                <hr>
	                                <div class="form-group row">
	                                    <label for="example-text-input" class="col-lg-3 col-form-label" style="font-weight: bold;">Kode Katagori</label>
	                                    <div class="col-lg-9">
                                            <div class="input-group">
                                            
                                                <input class="form-control" type="text" name="kdkatagori" id="idkatagori" placeholder="">
                                                <input class="form-control" type="text" name="nmkatagori" id="nmkatagori" placeholder="">
                                                <button type="button" data-toggle="modal" data-target="#modal_katagori" class="btn">. . .</button>
                                            
                                            
                                        </div>
                                        </div>
	                                </div>

	                                <div class="form-group row">
	                                    <label for="example-text-input" class="col-lg-3 col-form-label" style="font-weight: bold;">Kode Produk</label>
	                                    <div class="col-lg-3">
	                                        <input class="form-control" type="text" name="kdproduk" placeholder="">
	                                    </div>
	                                </div>
	                                
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label" style="font-weight: bold;">Nama Produk</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" name="nmproduk" placeholder="Masukkan Nama katagori tarif">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label" style="font-weight: bold;">Min Rujukan</label>
                                        <div class="col-lg-5">
                                            <input class="form-control" type="text" name="min_rujukan" placeholder="Masukkan nilai rujukan minimal">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label" style="font-weight: bold;">Max Rujukan</label>
                                        <div class="col-lg-5">
                                            <input class="form-control" type="text" name="max_rujukan" placeholder="Masukkan nilai rujukan maximal">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label" style="font-weight: bold;">Satuan</label>
                                        <div class="col-lg-3">
                                            <input class="form-control" type="text" name="snrujukan" placeholder="satuan nilai rujukan">
                                        </div>
                                    </div>

	                            </div>
	                            <div class="card-footer">
	                               <div class="row">
	                                    <div class="col-md-5">
                                            <button type="button" onclick="kembali()" class="btn btn-danger"><i class="fa fa-save"></i> Batal</button>
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
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/moment/moment.js"></script>
    <script src="assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    
    <script>
        $('#lookup').DataTable();
        $(document).on('click', '.pilihkatagori', function (e) {
            document.getElementById("idkatagori").value = $(this).attr('data-kdkatagori');
            document.getElementById("nmkatagori").value = $(this).attr('data-namakatagori');
            // document.getElementById("namappu").value = $(this).attr('data-namappu');
            // document.getElementById("plafond").value = $(this).attr('data-plafond');
            $('#modal_katagori').modal('hide');
        });
        $(function () {
            $('#tanggal-pelunasan').bootstrapMaterialDatePicker({
                'format': 'DD MMMM YYYY HH:mm:ss',
                'time': true  
            }).change();
        });
    </script>
    <script type="text/javascript">
        function kembali(){
            window.history.back();
        }
    </script>
</body>

</html>
