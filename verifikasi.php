<?php 
include_once 'config/db.php';
include_once 'ceklogin.php';
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
    <title>Verifikasi hasil</title>
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
                    <h3 class="text-themecolor">Pemeriksaan Klinik</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Pemeriksaan Klinik</li>
                    </ol>
                </div>
                <!-- <div>
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div> -->
            </div>

            <div class="container-fluid">
                <div class="row right-content-md-center">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <!-- <div class="col-lg-12">
                                        <div class="text-center text-md-left db">
                                            <img src="assets/images/jakvent.png" class="logospecial">
                                            <h2 class="h2special pull-right d-none d-md-block">Data Pemeriksaan Klinik</h1>
                                        </div> 
                                    </div> -->
                                </div>
                                <hr>

                                <a href="historicalpemeriksaan_klinik.php">
                                    <td><input name="Submit" type="image" value="add data"  src="assets/images/hpemeriksaan.png"></td>
                                </a>
                                
                                <table class="table table-m table-bordered m-t-20 color-table primary-table">
                                    <thead>
                                        <th>No.RM</th>
                                        <!-- <th>No.KTP</th> -->
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Telpon</th>
                                        <th>Gender</th>
                                        <th>Proses</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql="SELECT k.id as idkunjungan, k.entry, k.verifikasi, k.print, k.print_ulang, p.* FROM kunjungan_klinik k
                                            LEFT JOIN pasienklinik p
                                            ON k.no_rm=p.norm
                                            WHERE k.bayar =1 AND k.print IS NULL
                                            ";
                                            
                                            $tampil=mysqli_query($link,$sql);
                                            while($row=mysqli_fetch_array($tampil)){
                                        ?>
                                        <tr>
                                            <td><?php echo $row['norm']?></td>
                                            <!-- <td><?php //echo $row['noktp']?></td> -->
                                            <td><?php echo $row['nama']?></td>
                                            <td><?php echo $row['alamat']?></td>
                                            <td><?php echo $row['telpon']?></td>
                                            <td><?php echo $row['jenis_kelamin']?></td>
                                            
                                            <td>
                                                <!-- <a href="entrypemeriksaan_klinik.php?id=<?php echo $row['id']?>">  -->
                                               <!-- entry hasil -->
                                                <!-- <?php
                                                    if ($row['entry']==1) {
                                                        ?>
                                                            <img src="assets/images/addhp1.png" data-toggle="tooltip" data-placement="top" title="Sudah Di Entry"> 
                                                        <?php
                                                    }
                                                    else{
                                                        ?>
                                                        <a href="entrypemeriksaan_klinik.php?old=1&id=<?php echo $row['idkunjungan']?>">
                                                            <img src="assets/images/addhp1.png" data-toggle="tooltip" data-placement="top" title="Entry Hasil"> 
                                                        </a>
                                                        <?php
                                                    }
                                                ?> -->
                                                
                                                <!-- edit -->
                                                <!-- <?php 
                                                    if ($row['entry']==1) {
                                                        ?>
                                                        <a href="edit_hasilklinik.php?id=<?php echo $row['idkunjungan']?>">
                                                            <img src="assets/images/yedit10.png" data-toggle="tooltip" data-placement="top" title="Edit Hasil">
                                                        </a>
                                                        <?php
                                                    }
                                                    else{
                                                        ?>
                                                            <img src="assets/images/yedit10.png" data-toggle="tooltip" data-placement="top" title="Belum dientry">
                                                        <?php
                                                    }
                                                ?> -->
                                                
                                                <!-- verifikasi -->
                                                <?php 
                                                    if ($row['entry']==1) {
                                                        ?>
                                                        <a href="verifikasi_proses.php?id=<?php echo $row['id']?>">
                                                            <img src="assets/images/verif.png" data-toggle="tooltip" data-placement="top" title="Verifikasi">
                                                        </a>
                                                    <?php
                                                    }
                                                    else{
                                                        ?>
                                                            <img src="assets/images/verif.png" data-toggle="tooltip" data-placement="top" title="Belum dientry">
                                                        <?php
                                                    }
                                                ?>

                                                <!-- print -->
                                                <!-- <?php
                                                    if ($row['verifikasi']==1) {
                                                        if ($row['print']==1) {
                                                            ?>
                                                            <img src="assets/images/hprint10.png" data-toggle="tooltip" data-placement="top" title="Sudah dicetak"> 
                                                            <?php
                                                        }
                                                        else {
                                                            ?>
                                                            <a href="cetakhasil_klinik.php?old=1&id=<?php echo $row['idkunjungan']?>">
                                                                <img src="assets/images/hprint10.png" data-toggle="tooltip" data-placement="top" title="Cetak"> 
                                                            </a>
                                                            <?php
                                                        }
                                                        ?>
                                       
                                                 <?php
                                                    }
                                                    else{
                                                        ?>
                                                        <img src="assets/images/hprint10.png" data-toggle="tooltip" data-placement="top" title="Belum diverifikasi"> 
                                                        <?php
                                                    }
                                                 ?>    -->

                                                <!-- <div class="preview"> <i class="icon-pencil"></i> icon-pencil </div> -->
                                                <!-- <a href="hapusppu.php?id=<?php //echo $row['id']?>">
                                                    <button style="background-color: red;" class="btn btn-sm">Hapus</button>
                                                </a> -->
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
            </div>
    
            <?php  
                include_once 'include/footer.php';
            ?>
    
        </div>
    </div>
    
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>

    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
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

    <!-- <script src="assets/js/dtbutton/buttons.bootstrap4.js"></script> -->
    <script src="assets/js/dtbutton/dataTables.buttons.js"></script>
    <script src="assets/js/dtbutton/jszip.js"></script>
    <script src="assets/js/dtbutton/pdfmake.js"></script>
    <script src="assets/js/dtbutton/vfs_fonts.js"></script>
    <script src="assets/js/dtbutton/buttons.html5.js"></script>
    <script src="assets/js/dtbutton/buttons.print.js"></script>
    
    <script>
        $('.table thead tr').clone(true).appendTo( '.table thead' );
        $('.table thead tr:eq(1) th').each( function (i) {
            var title = $(this).text();
            $(this).html( '<input class="form-control" type="text" placeholder="'+title+'" />' );
    
            $( 'input', this ).on( 'keyup change', function () {
                if ( table.column(i).search() !== this.value ) {
                    table
                        .column(i)
                        .search( this.value )
                        .draw();
                }
            } );
        } );

        $('.table').DataTable({
            "pageLength": 4,
            dom: 'Bfrtip',
            buttons:[
                {
                    extend: 'excel',
                    text:'Export to Excel',
                    className: 'btn btn-sm',
                    title: 'Data Pemeriksaan Klinik',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                },

                {
                    extend: 'pdf',
                    text:'Export to PDF',
                    className: 'btn btn-sm',
                    title: 'Data Pemeriksaan Klinik',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                },

                {
                    extend: 'print',
                    className: 'btn btn-sm',
                    title: 'Data Pemeriksaan Klinik',
                    messageTop: 'Labkes Ungaran Kabupaten Semarang',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                }
            ]
        });
    </script>
    
</body>
</html>