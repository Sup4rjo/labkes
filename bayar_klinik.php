<?php 
include_once 'config/db.php';
include_once 'ceklogin.php';
if (!empty($_POST)) {
  $id_kunjungan= $_GET['id'];
  $total_bayar= $_POST['diterima'];




  $simpan=mysqli_query($link,"INSERT into bayar_klinik (id_kunjungan, tgl_bayar, total_bayar) VALUES ($id_kunjungan, NOW(), $total_bayar)");
  if ($simpan) {

    $update=mysqli_query($link,"UPDATE kunjungan_klinik
    SET
    bayar = 1
    WHERE id = $id_kunjungan
    ");
    if ($update) {
      header('location: kassa.php');
    }
    else {
      echo "error";
    }
  }
  else{
    echo "echo";
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
    <title>Data Kunjungan Klinik - Labkes Ungaran</title>
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
        
        <?php 
            include_once 'include/header.php';
            include_once 'include/left-sidebar.php';
        ?>
        
        <div class="page-wrapper">
           
            <!-- <div class="row page-titles"> -->
                <!-- <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Data Kunjungan Pasien Klinik</h3>
                </div> -->
                <!-- <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Data Kunjungan Klinik</li>
                    </ol>
                </div> -->
                <!-- <div>
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div> -->
            <!-- </div> -->
            
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row right-content-md-center">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- <div class="row"> -->
                                    <!-- <div class="col-lg-12">
                                        <div class="text-center text-md-left db">
                                            <img src="assets/images/jakvent.png" class="logospecial">
                                            <h2 class="h2special pull-right d-none d-md-block">Data Kunjungan Klinik</h1>
                                        </div> 
                                    </div> -->
                                <!-- </div> -->
                                <!-- <hr> -->
                                
<?php
    error_reporting(1);
      include_once 'config/db.php';
      include_once 'ceklogin.php';
?>

<style type="text/css">
@media print
{
  .break{ display:block; page-break-before:always; }
}

.st_total {
	font-size: 9pt;
	font-weight: bold;
	font-family:Verdana, Arial, Helvetica, sans-serif;
}
.style6 {
	color: #000000;
	font-size: 9pt;
	font-weight: bold;
	font-family: Arial;
}
.style9 {
	color: #000000;
	font-size: 9pt;
	font-weight: normal;
	font-family: Arial;
}
.style9b {
	color: #000000;
	font-size: 9pt;
	font-weight: bold;
	font-family: Arial;
}
.style19b {
	color: #000000;
	font-size: 12pt;
	font-weight: bold;
	font-family: Arial;
}

.styledibayarkan {
	color: black;
	font-size: 18pt;
	font-weight: bold;
	font-family: Arial;
}
.stylekembalian {
	color: red;
	font-size: 24pt;
	font-weight: bold;
	font-family: Arial;
}

.stylediterima {
	color: green;
	font-size: 32pt;
	font-weight: bold;
	font-family: Arial;
}

.style10b {
	color: #000000;
	font-size: 11pt;
	font-weight: bold;
	font-family: Arial;
}
</style>
<script src="assets/js/jsbilangan.js" type="text/javascript"></script>

<?php
$idp=$_GET['id'];
	$query=mysqli_query($link, "SELECT 
  pk.id,
  pk.norm,
  pk.nama,
  pk.alamat,
  pk.telpon,
  pk.jenis_kelamin,
  pk.status_marital,
  kk.no_kunjungan,
  kk.tgl_kunjungan,
  kk.pasien_lama
  FROM kunjungan_klinik AS kk 
  LEFT JOIN pasienklinik AS pk
  ON kk.no_rm=pk.norm
  WHERE kk.id='$idp'");
  $dtpasien= mysqli_fetch_array($query);
?>
    
<form id="form2" name="form2" action="" method="POST">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="7"><div align="center">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="74%" rowspan="3" valign="top" class="style19b">LABORATORIUM KESEHATAM</td>
            
            <td colspan="3"><div align="center" class="style9b">
              <div align="left" class="style19b"><strong><u>FAKTUR / NOTA KLINIK</u></strong></div>
            </div></td>
          </tr>
          <tr>
            <td width="11%" height="18" class="style9">Nomor </td>
            <td width="1%" class="style9"><div align="center">:</div></td>
            <td width="14%" class="style9">
              <?=$rs['id_ns'];?>           </td>
          </tr>
          <tr>
            <td class="style9">Tanggal Nota</td>
            <td><div align="center">:</div></td>
            <td><span class="style9">
            <?php echo date_format(date_create($dtpasien['tgl_kunjungan']),'d-m-Y');?>
              <?php //echo date('d-m-Y');?>
            </span></td>
          </tr>
        </table>
          </div></td>
    </tr>
    
   <tr>
      <td colspan="7">
       <hr />      </td>
   </tr>
    <tr>
      <td width="157"><font size="2" class="style9">No.Kunjungan</font></td>
      <td width="19"><div align="center">:</div></td>
      <td width="383" class="style9"><?=$dtpasien['no_kunjungan'];?></td>
      <td width="26">&nbsp;</td>
      <td width="238" class="style9">Alamat Pasien</td>
      <td width="15"><div align="center">:</div></td>
      <td width="228"><span class="style9">
        <?=$dtpasien['alamat'];?>
      </span></td>
    </tr> 

    <tr>
      <td class="style9">No. Rekam Medis</td> 
      <td><div align="center">:</div></td>
      <td><div id="kontak" class="style9">
          <?=$dtpasien['norm'];?>
      </div></td>
      <td width="26">&nbsp;</td>
      <td width="238" class="style9">Jenis Kelamin</td>
      <td width="15"><div align="center">:</div></td>
      <td width="228"><div id="sex" class="style9"><?=$dtpasien['jenis_kelamin'];?>
      </div></td>
    </tr>

    <tr>
      <td><font size="2" class="style9">Nama Pasien</font></td>
      <td><div align="center">:</div></td>
      <td><div id="nama" class="style9">
        <?=$dtpasien['nama'];?>
      </div></td>
      <td width="26"><input type="hidden" name="jum" value="" /></td>
      <td><font size="2" class="style9">Nomor Telpon</font></td>
      <td><div align="center">:</div></td>
      <td><span class="style9">
        <?=$dtpasien['telpon'];?>
      </span></td>
    </tr>
  </table>
   
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" id="tbl_dtl">
    <tr>
      <td colspan="7">
      <hr />      </td>
    </tr>
    <tr>
    	<td width="24" class="style19b"><div align="center">No</div></td>
      <td width="166" class="style19b"><div align="left">Kode Pemeriksaan</div></td>
      <td width="254" class="style19b"><div align="left">Nama/Jenis Pemeriksaan</div></td>
      <td width="38" class="style19b"><div align="center">Qty</div></td>
      <td width="94" class="style19b"><div align="right">Harga</div></td>
      <td width="117" class="style19b"><div align="right">Jumlah</div></td>
    </tr>
      <tr>
      <td colspan="7">
      <hr />      </td>
      </tr>
      <?php
    $sql1 = mysqli_query($link, "SELECT
    kk.no_kunjungan,
    kk.tgl_kunjungan,
    kk.pasien_lama,
    kk.id,
    kt.kode_produk,
    pt.nama_produk,
    kt.totalharga,
    tk.qty,
    tk.total
    FROM kunjungan_klinik AS kk 
    LEFT JOIN transaksi_klinik AS tk
    ON kk.id=tk.id_kunjungan
    LEFT JOIN komponen_tarif AS kt
    ON tk.kode_tarif=kt.kode_produk
    LEFT JOIN produk_tarif AS pt
    ON kt.kode_produk=pt.kode_produk
    WHERE kk.id='$idp'
    ");
		
  $i = 1;
  // $tt=mysqli_fetch_array($sql1);
  // echo $tt['qty'];
	while ($rs1 = mysqli_fetch_array($sql1))
	{	
	  ?>
      <tr>
        <td class="style9" align="center"><?=$i;?></td>
        <td class="style9"><?=$rs1['kode_produk'];?></td>
        <td class="style9"><?=$rs1['nama_produk'];?></td>
        <td class="style9"><?=$rs1['qty'];?></td>
        <td class="style9" align="right"><?=number_format($rs1['totalharga'],2);?></td>
        <td class="style9" align="right"><?=number_format($rs1['total'],2);?></td>
      </tr>
      <?php
	  $total=$total+$rs1['total'];
	  $baris++;
	  $i++;
	  }
	
	  ?>
      <tr>
      <td colspan="7">
      <hr />      </td>
      </tr>
  </table>
 
  <table width="98%" align="center">
   
    <tr>
      <td width="86"><label for="name"></label>
          <label for="name"></label>
      <!-- <label for="name"><span class="st_total">TERBILANG</span></label></td> -->
      <td width="15">&nbsp;</td>
      <td width="371"><div class="style9" id="terbilang"></div></td>
      <td width="44">&nbsp;</td>
      <td width="47" class="style19b">TOTAL</td>
      <td width="152"><div id="total" class="style19b" align="right"><?=number_format($total,2);?>
      </div></td>
    </tr>
  </table>
</form>
<input id="tagihan" type="hidden" value="<?=$total;?>">
<!-- form pembayaran -->
<form form id="formb" name="formb" action="" method="post">
<tr>
    <td colspan="7"><div align="center">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="3"></td>
          <td>
            <div align="center" class="style9b">
              <div align="right" class="style19b" style="padding-right: 10px"><strong><u>DIBAYARKAN</u></strong></div>
            </div>
          </td>
          <td width="200px">
            <input id="dibayarkan" style="text-align: right" type="text" class="form-control styledibayarkan">
          </td>
        </tr>

        <tr>
          <td colspan="3"></td>
          <td>
            <div align="center" class="style9b">
              <div align="right" class="style19b" style="padding-right: 10px"><strong><u>KEMBALIAN</u></strong></div>
            </div>
          </td>
          <td width="200px">
            <input id="kembalian" style="text-align: right;" type="text" class="form-control stylekembalian">
          </td>
        </tr>

        <tr>
          <td colspan="3"></td>
          <td>
            <div align="center" class="style9b">
              <div align="right" class="style19b" style="padding-right: 10px"><strong><u>UANG YANG DITERIMA</u></strong></div>
            </div>
          </td>
          <td width="200px">
            <input id="diterima" name="diterima" style="text-align: right" type="text" class="form-control stylediterima">
          </td>
          <!-- <td> </td>
          <td> </td>
          <td> </td> -->
        </tr>
        
        <tr>
          <td colspan="3"></td>
          <td>
            <div align="center" class="style9b">
              <div align="right" class="style19b" style="padding-right: 10px"><strong>
              <u>
                  <button type="button" onclick="kembali()" class="btn btn-danger"><i class="fa fa-window-close"></i>  BATAL</button>
                  <button type="submit" class="btn btn-info"><i class="fa fa-save"></i>     K A S I R / B A Y A R   </button>
                   <!-- <input type="button" class="btn btn-dark" name="button" id="button" value="Tambah" onclick="addNewRow1()"/> -->
    
              </u></strong></div>
              <td> </td>
            </div>
          <!-- </td>
          <td width="200px">
            <input type="text" class="form-control">
          </td> -->
        </tr>

        
    



      </table>
    </td>
</tr>



</form>
   <script type="text/javascript">

//---yang load di awal

var baris=1;
document.getElementById('terbilang').innerHTML=terbilang(getNumber(document.getElementById('total').innerHTML));

// window.print();	

 </script>


                                <!-- <table class="table table-m table-bordered m-t-20 color-table primary-table">
                                    <thead>
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table> -->
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
    
    <script type="text/javascript">
        function kembali(){
            window.history.back();
        }
    </script>

    <script>
    $("#dibayarkan").change(function(){
      var tagihan, dibayarkan, kembalian, diterima;

      dibayarkan= this.value;
      tagihan= $("#tagihan").val();
      kembalian= dibayarkan - tagihan;
      $("#kembalian").val(kembalian);
      $("#diterima").val(tagihan);
      
      // alert(dibayarkan);
    });

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
                    title: 'Data Tenaga Medis',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                },

                {
                    extend: 'print',
                    className: 'btn btn-sm',
                    title: 'Data Tenaga Medis',
                    messageTop: 'Daftar Tenaga Medis Labkes Ungaran',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }



                }
            ]

        });
    </script>
    
</body>

</html>
