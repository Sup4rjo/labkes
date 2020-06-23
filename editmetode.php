<?php
include_once 'config/db.php';
include_once 'ceklogin.php';

	if(!empty($_GET['id'])){
		$id=$_GET['id'];
		$sql=mysqli_query($link,"SELECT * FROM metode WHERE id=$id");
        $data=mysqli_fetch_array($sql);
    }

    if (!empty($_POST)) {
        # code...
        $kode_metode=$_POST['kode_metode'];//sama dengan form name
        $nama_metode=$_POST['nama_metode'];
        $keterangan=$_POST['keterangan'];
        $status=$_POST['status'];
        // var_dump($_POST);
        
        //sama dengan table di database
        $update= mysqli_query($link,"UPDATE metode
            SET 
            kode_metode= '$kode_metode',
            nama_metode= '$nama_metode',
            keterangan= '$keterangan',
            status= '$status'
            WHERE id=$id");
        if ($update) {
            header('location: metode.php?updated');
        }
        else{
            header('location: editmetode.php?err&id='.$id);
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
    <title>Edit Metode Pemeriksaan - Labkes Ungaran</title>
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
                    <h3 class="text-themecolor">Edit Metode Pemeriksaan</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Edit Metode Pemeriksaan</li>
                    </ol>
                </div>
                <!-- <div>
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div> -->
            </div>
            <div class="container-fluid">
                <div class="row justify-content-md-center">
                    <div class="col-lg-8">
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
			                                    <h1 class="h1special pull-right d-none d-md-block">Edit Metode Pemeriksaan</h1>
			                                </div> 
	                                	</div>
	                                </div>
	                                <hr>
	                                <div class="form-group row">
	                                    <label for="example-text-input" class="col-lg-3 col-form-label">KODE</label>
                                        <div class="col-lg-9">
                                        <input class="form-control" type="text" name="kode_metode" value="<?php
                                                    echo $data['kode_metode'];
                                                    ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Nama Metode</label>
                                        <div class="col-lg-9">
                                        <input class="form-control" type="text" name="nama_metode" value="<?php
                                                    echo $data['nama_metode'];
                                                    ?>"></div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Keterangan</label>
                                        <div class="col-lg-9">
                                        <input class="form-control" type="text" name="keterangan" value="<?php
                                                    echo $data['keterangan'];
                                                    ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Status</label>
                                        <div class="col-lg-9">
                                        <input class="form-control" type="text" name="status" value="<?php
                                                    echo $data['status'];
                                                    ?>">
                                        </div>
	                                </div>
	                                
	                            </div>
	                            <div class="card-footer">
	                               <div class="row">
	                                    <div class="col-md-12">
                                        <button type="button" onclick="kembali()" class="btn btn-danger"><i class="fa fa-window-close"></i> Batal</button>
	                                        <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Update</button>
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
    </div>

    <!-- All Jquery -->
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
