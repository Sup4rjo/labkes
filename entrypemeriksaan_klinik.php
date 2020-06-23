<?php
include_once 'config/db.php';
include_once 'ceklogin.php';
// mengambil data pasien berdasarkan id
if (!empty($_GET['id'])) {
    # code...
    $id_kunjungan= $_GET['id'];
    $getpasien  = mysqli_query($link, "SELECT * FROM kunjungan_klinik k
    LEFT JOIN pasienklinik p
    ON k.no_rm=p.norm
    WHERE k.id=$id_kunjungan");
    $datapasien = mysqli_fetch_array($getpasien);
}
// end mengambil data

// menyimpan data 
if (!empty($_POST)) {
    # code...
     $id_kunjungan= $_GET['id']; 
     $norm = $datapasien['norm'];
    //  $kode_produk= $_POST['kode_produk'];
    //  $hasil_pemeriksaan= $_POST['hasil_pemeriksaan']; 
    //  $keterangan= $_POST['keterangan'];
    $sql="INSERT INTO hasil_klinik
          (id_kunjungan, no_rm, kode_produk, nilai_normal, hasil_pemeriksaan, keterangan)
          VALUES ";
    $jumlahbaris = count($_POST['hasil']);
    for ($i=0; $i < ($jumlahbaris); $i++) { 
        $produk = $_POST['produk'][$i];
        $nilainormal = $_POST['nilainormal'][$i];
        $hasil = $_POST['hasil'][$i];
        $keterangan = $_POST['keterangan'][$i];
        $sql .= "('$id_kunjungan', '$norm', '$produk', '$nilainormal', '$hasil', '$keterangan')";

        if ($i!=($jumlahbaris-1)) {
            $sql .= ',';
        }

    }
    
    // echo $sql;
    // var_dump($_POST);
//      $cekkode = mysqli_query($link, "SELECT * FROM kunjungan_klinik k
//      LEFT JOIN pasienklinik p 
//      ON k.no_rm=p.norm
//      WHERE id_kunjungan='$norm'");

//  $jum     = mysqli_num_rows($cekkode);
//  if ($jum==0) {

    //  $sql="INSERT INTO hasil_klinik
    //      (id_kunjungan, kode_produk, hasil_pemeriksaan, keterangan)
    //      VALUES 
    //      ('$id_kunjungan','$kode_produk','$hasil_pemeriksaan','$keterangan')";

     $insert= mysqli_query($link, $sql);
     if ($insert) {
        $sql2 = "UPDATE kunjungan_klinik
        SET
        entry = 1
        WHERE
        id= $id_kunjungan";
        $update= mysqli_query($link, $sql2);
        if ($update) {
            header('location: pemeriksaan_klinik.php?add');
        }
        else{
            //header('location: entrypemeriksaan_klinik.php?err');
            printf("Query failed: %s\n,%s", mysqli_error($link),$sql2);
        }
         
     }
      else{
         //header('location: entrypemeriksaan_klinik.php?err');
         printf("Query failed: %s\n,%s", mysqli_error($link),$sql);
     }
 
//  else{
//      header('location: pemeriksaan_klinik.php?err=already');
//  }
}
?>
<!-- end -->

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
    <title>Entry Hasil Klinik - Labkes Ungaran</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="assets/css/colors/blue.css" id="theme" rel="stylesheet">
    
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
    
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    
    <!-- Main wrapper - style you can find in pages.scss -->
    <div id="main-wrapper">
        
        <!-- Topbar header - style you can find in pages.scss -->
        <?php
        include_once 'include/header.php';
        ?>
        
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <?php
        include_once 'include/left-sidebar.php';
        ?>
        
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            
            <!-- Bread crumb and right sidebar toggle -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Entry Hasil Pemeriksaan</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Entry Hasil Pemeriksaan</li>
                    </ol>
                </div>
            </div>

                    
            <!-- Container fluid  -->
            <?php
            //tes tes tes
            include_once 'config/lookup_tarif.php';
            ?>
            
            <div class="container-fluid">
              
                <!-- Start Page Content -->
                <div class="row justify-content-md-center">
                    
                    <div class="card">
                        <div class="card-body">
  
                            <!-- start kunjungan pasien -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="card-title">Data Pasien Pemeriksaan Klinik </h3>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label for="example-text-input" class="col-lg-3 col-form-label">No RM</label>
                                                        <div class="col-lg-4">
                                                            <input class="form-control" type="text" name="norm" readonly value="<?php
                                                            echo $datapasien['norm'];
                                                            ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label for="example-text-input" class="col-lg-4 col-form-label">No. Kunjungan</label>
                                                        <div class="col-lg-4">
                                                            <input class="form-control" type="text" name="id_kunjungan" readonly value="<?php
                                                            echo $datapasien['no_kunjungan'];
                                                            ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label for="example-text-input" class="col-lg-3 col-form-label">Nama</label>
                                                        <div class="col-lg-9">
                                                            <input class="form-control" type="text" name="rm" readonly value="<?php
                                                            echo $datapasien['nama'];
                                                            ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label for="example-text-input" class="col-lg-4 col-form-label">Jenis Kelamin</label>
                                                        <div class="col-lg-8">
                                                            <input class="form-control" type="text" name="alamat
                                                            " readonly value="<?php
                                                            echo $datapasien['jenis_kelamin'];
                                                            ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                           
                                <div class="col-lg-12">
                                <!-- form baru -->
                                <div class="card">
                                    <div class="card-body">
                                <h3> ENTRY DATA HASIL PEMERIKSAAN KLINIK &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;   Tanggal: &nbsp; <?php echo date('d-M-Y') ;?></h3>
                                <form action="" method="POST">
                                <table class="table table-m table-bordered m-t-20 color-table inverse-table">
                                    <thead>
                                        <th>Kode</th>
                                        <th>Jenis Pemeriksaa</th>
                                        <th>Nilai Normal</th>
                                        <th>Hasil Pemeriksaan</th>
                                        <th>Keterangan</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql="SELECT t.*, p.nama_produk, p.min_rujukan, p.max_rujukan, p.satuan FROM transaksi_klinik t
                                            LEFT JOIN produk_tarif p
                                            ON t.kode_tarif=p.kode_produk
                                            LEFT JOIN nilainormal n
                                            ON p.kode_produk=n.kode_nrujukan
                                            WHERE id_kunjungan=$id_kunjungan
                                            AND p.pemeriksaan=1";
                                            $tampil=mysqli_query($link,$sql);
                                            while($row=mysqli_fetch_array($tampil)){
                                        ?>
                                        
                                        <tr>
                                            <td>
                                                <?php 
                                                    echo $row['kode_tarif'];
                                                ?>
                                                <input class="d-none" type="text" name="produk[]" value="<?=$row['kode_tarif'];?>">
                                            </td>
                                            <td><?php echo $row['nama_produk']?></td>
                                            <td>
                                            <input  name="nilainormal[]" type="text" value="<?php echo $row['min_rujukan'].'-'.$row['max_rujukan'].' '.$row['satuan'];?>">
                                            
                                            </td>
                                            <td>
                                                <input name="hasil[]" type="text">
                                            </td>
                                            <td>
                                                <input name="keterangan[]" type="text">
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                    </table>
                                </table>
                            </div>
                        </div>
                                <!-- end form baru -->
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
            "pageLength": 3,
            "dom":"frtp"
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
