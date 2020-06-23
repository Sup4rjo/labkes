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
        $koderm= $datapasien['norm'];
    if(!empty($_GET['old'])){
        if($_GET['old']==1){
            $pasienlama= true;
        }
        else{
            $pasienlama=false;
        }
    }
    else{
        $pasienlama=false;
    }
    $kodep= $_POST['KODEP'];
    $qtyp= $_POST['QTY'];
    $totalp= $_POST['TOTAL'];
    $panjangarray= count($kodep);
    $nokunjungan="000001";
    $sqlkunjungan="";
    $sqlproduk="";
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
    <title>Edit Kunjungan Pasien Klinik - Labkes Ungaran</title>
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
                    <h3 class="text-themecolor">Edit Kunjungan Pasien Klinik</h3>
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
                        <div class="card-body">
                            
                            <!-- <div class="row">
                                <div class="col-lg-12">
                                    <div class="text-center text-md-left db">
                                        <img src="assets/images/jakvent.png" class="logospecial">
                                        <h1 class="h1special pull-right d-none d-md-block">Data Kunjungan Klinik</h1>
                                    </div> 
                                </div>
                            </div>
                            <hr> -->
                            
                            <!-- start kunjungan pasien -->
                            <div class="row">
                                <div class="col-lg-12">
                                <div class="card">
                                        <div class="card-body">
                                            <h3 class="card-title">Edit Kunjungan Pasien Klinik </h3>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label for="example-text-input" class="col-lg-3 col-form-label">No. RM</label>
                                                        <div class="col-lg-4">
                                                            <input class="form-control" type="text" name="rm" readonly value="<?php
                                                            echo $data['norm'];
                                                            ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label for="example-text-input" class="col-lg-4 col-form-label">No. Kunjungan</label>
                                                        <div class="col-lg-4">
                                                            <input class="form-control" type="text" name="id" readonly value="<?php
                                                            echo $data['id'];
                                                            ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label for="example-text-input" class="col-lg-3 col-form-label">Nama</label>
                                                        <div class="col-lg-8">
                                                            <input class="form-control" type="text" name="rm" readonly value="<?php
                                                            echo $data['nama'];
                                                            ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label for="example-text-input" class="col-lg-4 col-form-label">Alamat</label>
                                                        <div class="col-lg-8">
                                                            <input class="form-control" type="text" name="alamat
                                                            " readonly value="<?php
                                                            echo $data['alamat'];
                                                            ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
                                <!-- start historical pasien -->
                               
                            </div>
                            <!-- end historical pasien -->

                            <!-- start entry produk -->
                            <div class="row">
                                <div class="col-lg-12">
                                <h3> ENTRY PRODUK TARIF  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;   Tanggal: &nbsp; <?php echo date('d-M-Y') ;?></h3>
                                    <form action="" method="POST">
                                        <table border="1" bordercolor="#333333" id="tbl_1" class="table table-sm nowrap">
                                            <tr style="color:white">
                                                <td width="15%" bgcolor="green"><span class="style3"><font size="2">Kode</font></span></td>
                                                <td width="40%" bgcolor="green"><div align="center" class="style3"><font size="2">Nama Tarip</font></div></td>
                                                <td width="5%" bgcolor="green" class="style3"><div align="center"><font size="2">Qty</font></div></td>
                                                <td width="15%" bgcolor="green" class="style3"><div align="center"><font size="2">Harga</font></div></td>
                                                <td width="20%" bgcolor="green" class="style3"><div align="center"><font size="2">Total Harga</font></div></td>
                                                <td width="5%" bgcolor="green" class="style3"><div align="center"><font size="2">Hapus</font></div></td>
                                            </tr>
                                        </table>
                                    
                                    
                                    
                                    <!-- <p align='center'><input name='print' type='image' src='assets/images/cetak2.png' value='Cetak' id='print' onclick='Print()' onmouseover='this.src=' ..="" img="" cetak.png''="" onmouseout="this.src=" cetak2.png''=""></p> -->
                                    <label>
                                    <button type="button" onclick="kembali()" class="btn btn-danger"><i class="fa fa-window-close"></i> Batal</button>
                                    <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Update</button>
                                    <!-- <input type="button" class="btn btn-dark" name="button" id="button" value="Tambah" onclick="addNewRow1()"/> -->
                                    <!-- <input name='print' type='image' src='assets/images/cetak2.png' value='Cetak' id='print' onclick='Print()' onmouseover='this.src=' ..="" img="" cetak.png''="" onmouseout="this.src=" cetak2.png''=""></p> -->
                                    </label>
                                    </form>
                                    <script type="text/javascript">
                                    var baris1=1;
                                    addNewRow1();
                                    function addNewRow1() {
                                        var tbl = document.getElementById("tbl_1");
                                        var row = tbl.insertRow(tbl.rows.length);
                                        row.id = 't1'+baris1;

                                        var td1 = document.createElement("td");
                                        var td2 = document.createElement("td");
                                        var td3 = document.createElement("td");
                                        var td4 = document.createElement("td");
                                        var td5 = document.createElement("td");
                                        var td6 = document.createElement("td");
                                        
                                        td1.appendChild(generateKODEP(baris1));
                                        td1.appendChild(generateCARI(baris1));
                                        td2.appendChild(generateNAMAP(baris1));
                                        td3.appendChild(generateQTY(baris1));
                                        td4.appendChild(generateHARGA(baris1));
                                        td5.appendChild(generateTOTAL(baris1));
                                        td6.appendChild(generateDEL(baris1));

                                        row.appendChild(td1);
                                        row.appendChild(td2);
                                        row.appendChild(td3);
                                        row.appendChild(td4);
                                        row.appendChild(td5);
                                        row.appendChild(td6);

                                        document.getElementById('CARI['+baris1+']').setAttribute('onclick', 'poptarif('+baris1+')');
                                        document.getElementById('QTY['+baris1+']').setAttribute('onChange', 'hitungjml('+baris1+')'); //akan memanggil fungsi hitungjml setelah ada perubahan
                                        document.getElementById('DEL['+baris1+']').setAttribute('onclick', 'DELROW('+baris1+')'); //akan memanggil fungsi delRow1 setelah ada action click
                                        baris1++;
                                    }
                                    function hitungjml(a)
                                    {
                                        var ke1 = document.getElementById("QTY["+a+"]").value;
                                        var ke2 = document.getElementById("HARGA["+a+"]").value;

                                        var jml=0;
                                            jml=ke1*ke2;
                                        document.getElementById("TOTAL["+a+"]").value =jml;
                                    }

                                    function poptarif(a,b){
                                            var width  = 350;
                                            var height = 180;
                                            var left   = (screen.width  - width)/2;
                                            var top    = (screen.height - height)/2;
                                            var params = 'width='+width+', height='+height;
                                            params += ', top='+top+', left='+left;
                                                window.open('poptarif.php?row='+a+'','',params);
                                    };
                                    function generateCARI(index) {
                                        var idx = document.createElement("input");
                                        idx.type = "button";
                                        idx.name = "CARI";
                                        idx.value = "...";
                                        idx.id = "CARI["+index+"]";
                                        idx.size = "5";
                                        return idx;
                                    }

                                    function generateKODEP(index) {
                                    var idx = document.createElement("input");
                                    idx.type = "text";
                                    idx.name = "KODEP["+index+"]";
                                    idx.id = "KODEP["+index+"]";
                                    idx.size = "10";
                                    return idx;
                                    }
                                    function generateNAMAP(index) {
                                    var idx = document.createElement("input");
                                    idx.type = "text";
                                    idx.name = "NAMAP["+index+"]";
                                    idx.id = "NAMAP["+index+"]";
                                    idx.size = "40";
                                    return idx;
                                    }
                                    function generateQTY(index) {
                                    var idx = document.createElement("input");
                                    idx.type = "text";
                                    idx.name = "QTY["+index+"]";
                                    idx.id = "QTY["+index+"]";
                                    idx.size = "5";
                                    return idx;
                                    }

                                    function generateHARGA(index) {
                                    var idx = document.createElement("input");
                                    idx.type = "text";
                                    idx.name = "HARGA["+index+"]";
                                    idx.id = "HARGA["+index+"]";
                                    idx.size = "10";
                                    return idx;
                                    }

                                    function generateTOTAL(index) {
                                    var idx = document.createElement("input");
                                    idx.type = "text";
                                    idx.name = "TOTAL["+index+"]";
                                    idx.id = "TOTAL["+index+"]";
                                    idx.size = "15";
                                    return idx;
                                    }

                                    function generateDEL(index) {
                                    var idx = document.createElement("input");
                                    idx.type = "button";
                                    idx.name = "DEL["+index+"]";
                                    idx.id = "DEL["+index+"]";
                                    idx.size = "5";
                                    idx.value = "X";
                                    return idx;

                                    }

                                    function DELROW(id){ 
                                        var el = document.getElementById("t1"+id);
                                        el.parentNode.removeChild(el);
                                        return false;
                                    }
                                    </script>
                                </div>
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
