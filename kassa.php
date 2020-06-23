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
    <title>Kasir Klinik - Labkes Ungaran</title>
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
                    <h3 class="text-themecolor">Data Kunjungan Pasien Klinik</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Data Kunjungan Klinik</li>
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
                            <hr>
                                <a href="history_bayarklinik.php">
                                    <td><input name="Submit" type="image" value="add data"  src="assets/images/hpembayaran.png"></td>
                                </a>

                                <table class="table table-m table-bordered m-t-20 color-table primary-table">
                                    <thead>
                                        <tr>
                                        <th>Tgl Kunjungan</th>
                                        <th>Id Kunjungan</th>
                                        <th>No RM</th>
                                        <th>Nama Pasien</th>
                                        <th>Status Pasien</th>
                                        <th>Proses</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql="SELECT 
                                            kk.id,
                                            kk.tgl_kunjungan,
                                            kk.no_kunjungan,
                                            kk.pasien_lama,
                                            kk.no_rm,
                                            pk.nama
                                            FROM kunjungan_klinik AS kk
                                            LEFT JOIN pasienklinik AS pk
                                            ON kk.no_rm=pk.norm
                                            WHERE kk.bayar IS NULL
                                            ";
                                            $tampil=mysqli_query($link,$sql);
                                            while($row=mysqli_fetch_array($tampil)){
                                        ?>
                                        <tr>
                                            <td>
                                                <?php 
                                                    $date=date_create($row['tgl_kunjungan']);
                                                    echo date_format($date,"d/m/Y");
                                                ?>
                                            </td>
                                            <td><?php echo $row['no_kunjungan']?></td>
                                            <td><?php echo $row['no_rm']?></td>
                                            <td><?php echo $row['nama']?></td>
                                            <td>
                                                <?php 
                                                if($row['pasien_lama']==1)
                                                echo "Lama";
                                                else
                                                echo "Baru";
                                                ?>
                                            </td>
                                            
                                            <td>
                                                <a href="bayar_klinik.php?id=<?php echo $row['id']?>">
                                                    <img src="assets/images/hbayar10.png" data-toggle="tooltip" data-placement="top" title="Bayar">        
                                                </a>

                                                <!-- <a href="edit_kunjunganklinik.php?id=<?php echo $row['id']?>">
                                                    <img src="assets/images/yedit10.png" data-toggle="tooltip" data-placement="top" title="Edit">
                                                </a> -->

                                                <!-- <a href="printulang_nota.php?id=<?php echo $row['id']?>">
                                                    <img src="assets/images/hprint10.png" data-toggle="tooltip" data-placement="top" title="Print Ulang Nota">
                                                </a> -->

                                                <a href="kunjungan_klinik.php?id=<?php echo $row['id']?>">
                                                    <img src="assets/images/mhapus10.png" data-toggle="tooltip" data-placement="top" title="Batal Periksa">
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
        var table =$('.table').DataTable({
            dom: 'Bfrtip',
            buttons:[
                {
                    extend: 'excel',
                    text:'Export to Excel',
                    className: 'btn btn-sm',
                    title: 'Data Kunjungan Pasien Klinik',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                },

                {
                    extend: 'pdf',
                    text:'Export to PDF',
                    className: 'btn btn-sm',
                    title: 'Data Kunjungan Pasien Klinik',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                },

                {
                    extend: 'print',
                    className: 'btn btn-sm',
                    title: 'Data Kunjungan Pasien Klinik',
                    messageTop: 'Labkes Kabupaten Semarang - Ungaran',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                }
            ]
        });
    </script>
</body>
</html>
