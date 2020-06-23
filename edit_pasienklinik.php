<?php
include_once 'config/db.php';
include_once 'ceklogin.php';

	if(!empty($_GET['id'])){
		$id=$_GET['id'];
		$sql=mysqli_query($link,"SELECT * FROM pasienklinik WHERE id=$id");
        $data=mysqli_fetch_array($sql);
    }

    if (!empty($_POST)) {
        # code...
        $norm= $_POST['norm'];
        $identitas= $_POST['identitas'];
        $no_identitas= $_POST['no_identitas'];
        $nama= $_POST['nama'];
        $alamat= $_POST['alamat'];
        $telpon= $_POST['telpon'];
        $jenis_kelamin= $_POST['jenis_kelamin'];
        $agama= $_POST['agama'];
        $tempat_lahir= $_POST['tempat_lahir'];
        $tgl_lahir= $_POST['tgl_lahir'];
        $status_marital= $_POST['status_marital'];
        $pendidikan= $_POST['pendidikan'];
        $pekerjaan= $_POST['pekerjaan'];
        $umur=0;
        // var_dump($_POST);
        
        //sama dengan table di database
        $sql="UPDATE pasienklinik
        SET 
        norm= '$norm',
        identitas= '$identitas',
        no_identitas= '$no_identitas',
        nama= '$nama',
        alamat= '$alamat',
        telpon= '$telpon',
        jenis_kelamin= '$jenis_kelamin',
        agama= '$agama',
        tempat_lahir= '$tempat_lahir',
        tgl_lahir= '$tgl_lahir',
        status_marital= '$status_marital',
        pendidikan= '$pendidikan',
        pekerjaan= '$pekerjaan'
        WHERE id=$id";
        $update= mysqli_query($link,$sql);
        if ($update) {
            header('location: pendaftaran_klinik.php?updated');
        }
        else{
            //echo $sql;
             header('location: edit_pasienklinik.php?err&id='.$id);
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
    <title>Edit Data Pasien Klinik - Labkes Ungaran</title>
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
                    <h3 class="text-themecolor">Edit Data Pasien Klinik</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Edit Data Pasien Klinik</li>
                    </ol>
                </div>
            </div>
            
            <div class="container-fluid">
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
			                                    <h2 class="h2special pull-right d-none d-md-block">Edit Data Pasien Klinik</h1>
			                                </div> 
	                                	</div>
	                                </div>
	                                <hr>
	                                <div class="form-group row">
	                                    <label for="example-text-input" class="col-lg-3 col-form-label">Rekam Medis</label>
	                                    <div class="col-lg-3">
	                                        <input class="form-control" type="text" name="norm" value="<?php
                                                    echo $data['norm'];
                                                    ?>">
	                                    </div>
	                                </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Indentitas</label>
                                        <div class="col-lg-9">
                                        <div class="input-group">
                                            <select class="col-lg-2 form-control custom-select" name="identitas">
                                                    <option value="<?=$data['identitas'];?>"><?=$data['identitas'];?></option>
                                                    <option value="KTP">KTP</option>
                                                    <option value="SIM">SIM</option>
                                                    <option value="PASPOR">PASPOR</option>
                                                    <option value="LAINNYA">LAINNYA</option>
                                            </select>
                                                <div class="col-lg-6">
                                                    <input class="form-control" type="text" name="no_identitas" value="<?php
                                                    echo $data['no_identitas'];
                                                    ?>">
                                                </div>
                                        </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Nama</label>
                                        <div class="col-lg-6">
                                            <input class="form-control" type="text" name="nama" value="<?php
                                                    echo $data['nama'];
                                                    ?>">
                                        </div>
                                    </div>

	                                <div class="form-group row">
	                                    <label for="example-text-input" class="col-lg-3 col-form-label">Alamat</label>
	                                    <div class="col-lg-6">
	                                        <input class="form-control" type="text" name="alamat" value="<?php
                                                    echo $data['alamat'];
                                                    ?>">
	                                    </div>
	                                </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Telpon</label>
                                        <div class="col-lg-3">
                                            <input class="form-control" type="text" name="telpon" value="<?php
                                                    echo $data['telpon'];
                                                    ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Jenis Kelamin</label>
                                        <div class="col-lg-3">
                                            <select class="form-control custom-select" name="jenis_kelamin">
                                            <option value="<?=$data['jenis_kelamin'];?>"><?=$data['jenis_kelamin'];?></option>
                                                    <option value="Laki-laki">Laki-laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Agama</label>
                                        <div class="col-lg-3">
                                            <select class="form-control custom-select" name="agama">
                                            <option value="<?=$data['agama'];?>"><?=$data['agama'];?></option>
                                                    <option value="Islam">Islam</option>
                                                    <option value="Kristen">Kriten</option>
                                                    <option value="Katholik">Katolik</option>
                                                    <option value="Budha">Budha</option>
                                                    <option value="Hindu">Hindu</option>
                                            </select>
                                        </div>
                                    </div>


                                    

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Status Marital</label>
                                        <div class="col-lg-3">
                                            <select class="form-control custom-select" name="status_marital">
                                            <option value="<?=$data['status_marital'];?>"><?=$data['status_marital'];?></option>
                                                    <option value="Kawin">Kawin</option>
                                                    <option value="Belum Kawin">Belum Kawin</option>
                                                    <option value="Janda">Janda</option>
                                                    <option value="Duda">Duda</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Tempat Lahir</label>
                                        <div class="col-lg-3">
                                            <input class="form-control" type="text" name="tempat_lahir" value="<?php
                                                    echo $data['tempat_lahir'];
                                                    ?>">
                                        </div>
                                        
                                        <label for="example-text-input" class="col-lg-2 col-form-label">Tanggal Lahir :</label>
                                        <div class="col-lg-3">
                                            <input type="date" class="form-control" name="tgl_lahir" value="<?php
                                                    echo $data['tgl_lahir'];
                                                    ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Pendidikan</label>
                                        <div class="col-lg-3">
                                            <select class="form-control custom-select" name="pendidikan">
                                            <option value="<?=$data['pendidikan'];?>"><?=$data['pendidikan'];?></option>
                                                    <option value="1">Silahkan pilih</option>
                                                    <option value="Tidak Sekolah">Tidak sekolah</option>
                                                    <option value="SD">SD</option>
                                                    <option value="SMP/Sederajat">SMP/Sederajat</option>
                                                    <option value="S<A/SMK/Sederajat">SMA/SMK/Sederajat</option>
                                                    <option value="Deploma D3">Deploma D3</option>
                                                    <option value="Sarjana S1">Sarjana S1</option>
                                                    <option value="Pasca Sarjana S2">Pasca Sarjana S2</option>
                                                    <option value="S3">S3</option>
                                            </select>
                                        </div>
                                        <label for="example-text-input" class="col-lg-2 col-form-label">Pekerjaan</label>
                                        <div class="col-lg-3">
                                            <select class="form-control custom-select" name="pekerjaan">
                                            <option value="<?=$data['pekerjaan'];?>"><?=$data['pekerjaan'];?></option>
                                                    <option value="1">Silahkan pilih</option>
                                                    <option value="PNS">PNS</option>
                                                    <option value="TNI/Polri">TNI/Polri</option>
                                                    <option value="Wiraswasta">Wiraswasta</option>
                                                    <option value="Dokter">Dokter</option>
                                                    <option value="Perawat">Perawat</option>
                                                    <option value="Petani">Petani</option>
                                                    <option value="Nelayan">Nelayan</option>
                                                    <option value="Guru/Dosen">Guru/Dosen</option>
                                                    <option value="Karyawan swasta">Karyawan swasta</option>
                                                    <option value="Pedagang">Pedagang</option>
                                                    <option value="Apoteker">Apoteker</option>
                                                    <option value="Lainya">Lainya</option>
                                            </select>
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
