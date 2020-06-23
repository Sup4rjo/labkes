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
    ///////////////////////
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
            // var_dump($_POST);
            $kodejaminan= $_POST['kodejaminan'];
            $jenisjaminan= $_POST['jenisjaminan'];
            $namajaminan= $_POST['namajaminan'];
            $nilaipasar= $_POST['nilaipasar'];
            $nilailikuidasi= $_POST['nilailikuidasi'];
            $keterangan= $_POST['keterangan'];

            $insert= mysqli_query($link,"INSERT INTO dokjaminan (
                no_register,
                kode_jaminan, 
                nama_jaminan, 
                jenis_jaminan,
                keterangan,
                nilai_pasar,
                nilai_likuidasi
                ) VALUES (
                '$noreg',
                '$kodejaminan',
                '$namajaminan',
                '$jenisjaminan',
                '$keterangan',
                '$nilaipasar',
                '$nilailikuidasi'
                )
            ");

            if ($insert) {
                # code...
                $pesan= "Data Jaminan berhasil disimpan";
                $sukses = 1;
            }
            else{
                $pesan= "Maaf Data Tidak Dapat tersimpan";
                $error = 1;
            }

        }
        else {
            $pesan= "Maaf No Register Tidak Valid atau Belum dimasukkan";
            $error = 1;
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
    <title>Data Jaminan <?php echo (isset($noreg)) ? $noreg : '' ; ?> - Jakarta Ventura</title>
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
                    <h3 class="text-themecolor">Data Jaminan</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Data Jaminan</li>
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
                include_once 'config/lookupinvestasi.php';
            ?>
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
				                                    <input class="form-control" type="text" id="noregister" name="noreg" placeholder="Masukkan No Register">
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
                    <div class="col-lg-5">
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
			                                    <h1 class="h1special pull-right d-none d-md-block">Edit</h1>
			                                </div> 
	                                	</div>
	                                </div>
	                                <hr>
	                                <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-5 col-form-label">Kode Jaminan</label>
                                        <div class="col-lg-7">
                                            <input class="form-control" type="text" name="kodejaminan" placeholder="Masukkan Kode Jaminan">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-5 col-form-label">Nama Jaminan</label>
                                        <div class="col-lg-7">
                                            <input class="form-control" type="text" name="namajaminan" placeholder="Masukkan Nama Jaminan">
                                        </div>
                                    </div>
	                                <div class="form-group row">
	                                    <label for="example-text-input" class="col-lg-5 col-form-label">Jenis Jaminan</label>
	                                    <div class="col-lg-7">
	                                        <select id="jenisjaminan" name="jenisjaminan" class="pmd-select2 select-with-search form-control custom-select">
                                                <option>Pilih Jenis Jaminan</option>
                                                <?php  
                                                    $sql=mysqli_query($link, "SELECT * FROM jenisjaminan");
                                                    while($list=mysqli_fetch_array($sql)){
                                                        ?>
                                                        <option value="<?php echo $list['id']; ?>"><?php echo $list['jenis_jaminan']; ?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
	                                    </div>
	                                </div>
	                                <div class="form-group row">
	                                    <label for="example-text-input" class="col-lg-5 col-form-label">Nilai Pasar</label>
	                                    <div class="col-lg-7">
	                                        <input class="form-control" type="text" name="nilaipasar" placeholder="Masukkan Nilai Pasar">
	                                    </div>
	                                </div>
	                                <div class="form-group row">
	                                    <label for="example-text-input" class="col-lg-5 col-form-label">Nilai Likuidasi</label>
	                                    <div class="col-lg-7">
	                                        <input class="form-control" type="text" name="nilailikuidasi" placeholder="Masukkan Nilai Likuidasi">
	                                    </div>
	                                </div>
	                                <div class="form-group row">
	                                    <label for="example-text-input" class="col-lg-5 col-form-label">Ket Jaminan</label>
	                                    <div class="col-lg-7">
	                                        <input class="form-control" type="text" name="keterangan" placeholder="Masukkan Keterangan Jaminan">
	                                    </div>
	                                </div>

                                   <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-info"><i class="fa fa-upload"></i> Simpan</button>
                                        </div>
                                    </div> 

                                </div>
                                
	                            
                            </form>
                        </div>
                    </div>
					<div class="col-lg-7">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-center text-md-left db">
                                            <img src="assets/images/jakvent.png" class="logospecial">
                                            <h1 class="h1special pull-right d-none d-md-block">Data Jaminan</h1>
                                        </div> 
                                    </div>
                                </div>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-bordered nowrap dt" id="jaminan">
                                        <thead>
                                            <!-- <th>No Register</th> -->
                                            <th>Kode Jaminan</th>
                                            <th>Nama Jaminan</th>
                                            <th>Jenis Jaminan</th>
                                            <th>Nilai Pasar</th>
                                            <th>Nilai Likuidasi</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if (isset($noreg)) {
                                                # code...
                                                $sql2  = mysqli_query($link,"SELECT dj.kode_jaminan as kode_jaminan, jj.jenis_jaminan as jenis_jaminan, nama_jaminan, nilai_pasar, nilai_likuidasi, keterangan FROM dokjaminan dj LEFT JOIN jenisjaminan jj ON dj.jenis_jaminan=jj.id WHERE dj.no_register='$noreg'");
                                                while($d=mysqli_fetch_array($sql2)){
                                                ?>
                                                <tr>
                                                    <!-- <td>REG00001</td> -->
                                                    
                                                    <td><?php echo $d['kode_jaminan'];?></td>
                                                    <td><?php echo $d['nama_jaminan'];?></td>
                                                    <td><?php echo $d['jenis_jaminan'];?></td>
                                                    <td><?php echo $d['nilai_pasar'];?></td>
                                                    <td><?php echo $d['nilai_likuidasi'];?></td>
                                                    <td><?php echo $d['keterangan'];?></td>
                                                    <td><a target="blank" href="uploadjaminan.php?kodejaminan=<?php echo $d['kode_jaminan'];?>"><button class="btn btn-sm">Upload Dokumen</button></a></td>
                                                </tr>
                                                <?php
                                                }
                                            }
                                            
                                        ?>
                                        </tbody>
                                    </table>
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
    <script src="assets/js/dtbutton/dataTables.buttons.js"></script>
    <script src="assets/js/dtbutton/jszip.js"></script>
    <script src="assets/js/dtbutton/pdfmake.js"></script>
    <script src="assets/js/dtbutton/vfs_fonts.js"></script>
    <script src="assets/js/dtbutton/buttons.html5.js"></script>
    <script src="assets/js/dtbutton/buttons.print.js"></script>
    <script>
        $(document).on('click', '.pilihinvestasi', function (e) {
            document.getElementById("noregister").value = $(this).attr('data-noregister');
            // document.getElementById("namappu").value = $(this).attr('data-namafasilitas');
            $('#modalinvestasi').modal('hide');
        });

        $(document).ready(function() {
            if (filled) {
                $('#tabelinv').collapse();
            }
            // $('.dt').DataTable();
            $('#jaminan').DataTable({
                dom: "<'row'<'col-12'B>><'row'<'col-sm-12'l>>"+"rtip",
                buttons:[
                    {
                        extend: 'excel',
                        text:'Export to Excel',
                        className: 'btn btn-sm',
                        exportOptions: {
                            columns: [0,1,2,3,4,5]
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-sm',
                        messageTop: 'Data Jaminan yang terdaftar di Jakarta Ventura',
                        exportOptions: {
                            columns: [0,1,2,3,4,5]
                        }
                    }
                ]
            });
            // $(".select-with-search").select2({
            //     theme: "bootstrap"
            // });
        });
    </script>
</body>

</html>
