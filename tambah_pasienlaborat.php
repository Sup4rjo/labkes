<?php
include_once 'config/db.php';
include_once 'ceklogin.php';

    if (!empty($_POST)) {
        # code...
        // $tglreg= $_POST['tglreg'];
        $kelcus= $_POST['kelcus'];
        $noreg= $_POST['noreg'];
        $nama= $_POST['nama'];
        $alamat= $_POST['alamat'];
        $telpon= $_POST['telpon'];
        $email= $_POST['email'];
        
        var_dump($_POST);
        $cekkode = mysqli_query($link, "SELECT * FROM pasienlaborat
            WHERE noreg='$noreg'");

        $jum     = mysqli_num_rows($cekkode);
        if ($jum==0) {

            $sql="INSERT INTO pasienlaborat
                (tglreg, kelcus, noreg, nama, alamat, telpon, email)
                VALUES 
                (NOW(),'$kelcus','$noreg','$nama','$alamat','$telpon','$email')";

            $insert= mysqli_query($link, $sql);
            if ($insert) {
                header('location: sampel_laborat2.php?add');
            }
             else{
                header('location: pendaftaran_laborat.php?err');
                printf("Query failed: %s\n,%s", mysqli_error($link),$sql);
            }
        }
        else{
            header('location: pendaftaran_laborat.php?err=already');
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
    
        <title>Tambah Pendaftaran Laborat</title>
    
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
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <div id="main-wrapper">
        <?php
        include_once 'include/header.php';
        ?>
        <?php
        include_once 'include/left-sidebar.php';
        ?>
        <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Pendaftaran Laborat</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Pendaftaran Laborat</li>
                    </ol>
                </div>
            </div>
            <!-- end -->
            <div class="container-fluid">
                <div class="row right-content-md-center">
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
			                                    <h2 class="h2special pull-right d-none d-md-block">Pendaftaran Laborat</h1>
			                                </div> 
	                                	</div>
	                                </div>
	                                <hr>

                                    <div class="form-group row">
	                                    <label for="example-text-input" class="col-lg-3 col-form-label">Katagori Customer</label>
	                                    <div class="col-lg-7">
                                            <div class="input-group">
                                                <select class="col-lg-6 form-control custom-select" name="kelcus">
                                                    <option value="0">--Silahkan Pilih--</option>
                                                    <option value="1">Instansi Pemerintah</option>
                                                    <option value="2">Perusahaan Swasta</option>
                                                    <option value="3">Personal</option>
                                                </select>
                                            </div>
                                        </div>
	                                </div>

	                                <div class="form-group row">
	                                    <label for="example-text-input" class="col-lg-3 col-form-label">No. Register</label>
	                                    <div class="col-lg-3">
                                            <input class="form-control" type="text" name="noreg" placeholder="otomatis dari sistem">
	                                    </div>
	                                </div>
                                    
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Nama Customer</label>
                                        <div class="col-lg-6">
                                            <input class="form-control" type="text" name="nama" placeholder="masukkan nama sesuai identitas">
                                        </div>
                                    </div>

	                                <div class="form-group row">
	                                    <label for="example-text-input" class="col-lg-3 col-form-label">Alamat</label>
	                                    <div class="col-lg-8">
	                                        <input class="form-control" type="text" name="alamat" placeholder="masukkan alamat sesuai identitas">
	                                    </div>
	                                </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Telpon</label>
                                        <div class="col-lg-3">
                                            <input class="form-control" type="text" name="telpon" placeholder="nomor yang aktif">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">E-mail</label>
                                        <div class="col-lg-3">
                                            <input class="form-control" type="text" name="email" placeholder="nomor yang aktif">
                                        </div>
                                    </div>
                                 
	                            <div class="card-footer">
	                               <div class="row">
	                                    <div class="col-md-12">
                                            <button type="button" onclick="kembali()" class="btn btn-danger"><i class="fa fa-window-close"></i> Batal</button>
	                                        <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
	                                    </div>
	                                </div> 
	                            </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <?php
                include_once 'include/footer.php';
            ?>
    </div>
    <!-- end -->
   
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

    <script type="text/javascript">
        function kembali(){
            window.history.back();
        }
    </script>

</body>

</html>