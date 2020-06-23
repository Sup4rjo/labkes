<?php
    include_once 'config/db.php';
    include_once 'ceklogin.php';

    if (!empty($_POST)) {
        # code...
        $kode_produk= $_POST['kodeproduk'];
        // $nama_produk= $_POST['namaproduk'];
        // $kode_tarif= $_POST['kodetarif'];
        // $nama_tarif= $_POST['namatarif'];
        $total_harga= (!empty($_POST['totalharga'])) ? $_POST['totalharga'] : 0;
        $sim= (!empty($_POST['sim'])) ? $_POST['sim'] : 0;
        $bhp= (!empty($_POST['bhp'])) ? $_POST['bhp'] : 0;
        $js= (!empty($_POST['js'])) ? $_POST['js'] : 0;
        $jp= (!empty($_POST['jp'])) ? $_POST['jp'] : 0;
        $lainya= (!empty($_POST['lainya'])) ? $_POST['lainya'] : 0;
        
        var_dump($_POST);
        $cekkode = mysqli_query($link, "SELECT * FROM komponen_tarif
            WHERE kode_produk='$kode_produk'");
        $jum     = mysqli_num_rows($cekkode);
        if ($jum==0) {
            $sql="INSERT INTO komponen_tarif
                (kode_produk, totalharga, sim, bhp, js, jp, lainya)
                VALUES 
                ('$kode_produk', $total_harga, $sim, $bhp, $js, $jp, $lainya)";
            $insert= mysqli_query($link,$sql);
            if ($insert) {
                header('location: tarif.php?add');
            }
            else{
                //header('location: dataorganisasi.php?err');
                printf("Query failed: %s\n,%s", mysqli_error($link),$sql);
            }
        }
        else{
            header('location: tarif.php?err=already');
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
    <title>Kunjungan Pasien Klinik - Labkes Ungaran</title>
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
                    <h3 class="text-themecolor">Tambah Kunjungan</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Kunjungan</li>
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
                include_once 'config/lookup_tarif.php';
            ?>
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row justify-content-md-center">
                    <!-- <div class="col-lg-12"> -->
                        <div class="card">
							<!-- <form action="" method="POST"> -->
	                            <div class="card-body">
	                                
	                                <div class="row">
	                                	<div class="col-lg-12">
	                                		<div class="text-center text-md-left db">
			                                    <img src="assets/images/jakvent.png" class="logospecial">
			                                    <h1 class="h1special pull-right d-none d-md-block">Data Kunjungan Klinik</h1>
			                                </div> 
	                                	</div>
	                                </div>
	                                <hr>
	                                
                    <!-- form bagi 2 -->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Kunjungan Pasien </h3>
                                <!-- <h6 class="card-subtitle">made with bootstrap elements</h6> -->
                                <form class="form p-t-20">
                                    <div class="form-group">
                                        <!-- <label for="exampleInputuname">Nomor RM</label> -->
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti-lock "> Nomor RM</i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="exampleInputuname" placeholder="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <!-- <label for="exampleInputEmail1">Nama Pasien</label> -->
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti-user "> Nama Pasien </i>
                                                </span>
                                            </div>
                                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <!-- <label for="exampleInputEmail1">Nama Pasien</label> -->
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti-user "> Alamat </i>
                                                </span>
                                            </div>
                                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <!-- <label for="exampleInputEmail1">Nama Pasien</label> -->
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="ti-user "> Jenis Kelamin </i>
                                                </span>
                                            </div>
                                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
                                        </div>
                                    </div>

                                    
                                    
                                </form>
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Historical Kunjungan Pasien </h3>
                                <!-- <h6 class="card-subtitle">made with bootstrap elements</h6> -->
                                <!-- <form class="form p-t-20"> -->
                                    <div class="form-group">

                                <table id="kunjklinik" class="table table-sm table-bordered m-t-20">
                                    <thead style="background-color: lightgray; font-weight: bolder; font-size: 18px;">
                                        <!-- <th>Id Parent</th> -->
                                        <th>Tanggal</th>
                                        <th>Kode Kunjungan</th>
                                        <th>Pilihan</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql="SELECT * FROM katagori_tarif";
                                            $tampil=mysqli_query($link,$sql);
                                            while($row=mysqli_fetch_array($tampil)){


                                        ?>
                                        <tr>
                                            <!-- <td><?php //echo $row['id_parent']?></td> -->
                                            <td><?php echo $row['kode_katagori']?></td>
                                            <td><?php echo $row['nama_katagori']?></td>
                                            <td>
                                                <a href="hapusfasilitas.php?id=<?php echo $row['id']?>">
                                                    <button class="btn btn-sm btn-info">
                                                        View
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row justify-content-md-center">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-sm table-bordered m-t-20 table-striped">
                                    <thead style="background-color: lightgray">
                                        <th>No</th>
                                        <th>Kode Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Qty</th>
                                        <th>Hrg Satuan</th>
                                        <th>Totakl Harga</th>
                                        
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql="SELECT * FROM produk_tarif";
                                            $tampil=mysqli_query($link,$sql);
                                            while($row=mysqli_fetch_array($tampil)){
                                        ?>
                                        
                                        <tr>
                                            <td><?php echo $row['kode_katagori']?></td>
                                            <td><?php echo $row['kode_produk']?></td>
                                            <td><?php echo $row['nama_produk']?></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <!-- <td>
                                                <a href="hapusfasilitas.php?id=<?php echo $row['id']?>">
                                                    <button class="btn btn-sm btn-danger">
                                                        Hapus
                                                    </button>
                                                </a>
                                            </td> -->
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>

 <!-- end form bagi 2 -->

            
            <?php
            include_once 'include/footer.php';
            ?>
            
        
   
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
        $('#kunjklinik').DataTable({
            "pageLength": 3
        });
        $(document).on('click', '.pilihproduk', function (e) {
            document.getElementById("id_kodeproduk").value = $(this).attr('data-kdproduk');
            document.getElementById("id_namaproduk").value = $(this).attr('data-namaproduk');
            // document.getElementById("namappu").value = $(this).attr('data-namappu');
            // document.getElementById("plafond").value = $(this).attr('data-plafond');
            $('#modal_tarif').modal('hide');
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
