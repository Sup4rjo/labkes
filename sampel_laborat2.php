<?php
include_once 'config/db.php';
include_once 'ceklogin.php';
// mengambil data pasien berdasarkan id
if (!empty($_GET['id'])) {
    # code...
    $idcust   = $_GET['id'];
    $getcust  = mysqli_query($link, "SELECT * FROM pasienlaborat WHERE id=$idcust");
    $datacust = mysqli_fetch_array($getcust);
}
// menyimpan data 
if (!empty($_POST)) {
    # code...
    $noreg= $datacust['noreg'];
    if(!empty($_GET['old'])){
        if($_GET['old']==1){
            $pasienlama= 1;
        }
        else{
            $pasienlama=0;
        }
    }
    else{
        $pasienlama=0;
    }
    $kodep= $_POST['KODEP'];
    $qtyp= $_POST['QTY'];
    $totalp= $_POST['TOTAL'];
    $panjangarray= count($kodep);
    $nokunjungan="000001";
    $sqlkunjungan="";
    $sqlproduk="";

    $sqlkunjungan .= "INSERT INTO `kunjungan_laborat`( `tgl_kunjungan`, `noreg`, `id_kunjungan`, `pasien_lama`) VALUES (NOW(), '$koderm', '$nokunjungan', '$pasienlama')";
    $sqlproduk .= "INSERT INTO `transaksi_laborat`( `id_kunjungan`, `kode_tarif`, `qty`, `total`) VALUES ";

    // echo $sqlkunjungan;
    $hasilkunjungan= mysqli_query($link, $sqlkunjungan);
    $idkunjungan= mysqli_insert_id($link);
    $p = 0;
    $arrayproduk = array();
    foreach ($kodep as $key => $value) {
        if (!empty($kodep[$key])) {
            # code...    
            $kodeproduk= $kodep[$key];
            $qtyproduk= $qtyp[$key];
            $totalproduk= $totalp[$key];
            
            $arrayproduk[$p] = "("."'".$idkunjungan."', '".$kodeproduk."', ".$qtyproduk.", ".$totalproduk.") ";
            $p++;
        }
    }
    $i = 0;
    $len = count($arrayproduk);
    foreach ($arrayproduk as $key => $value) {
        $sqlproduk.= $value;
        if ($i == 0) {
            // first
            $sqlproduk .= ", ";
        } else if ($i == $len - 1) {
            // last
        }
        else {
            $sqlproduk .= ", ";
        }
        // …
        $i++;
    }
    echo $sqlproduk;
    $hasilproduk= mysqli_query($link, $sqlproduk);
    if ($hasilproduk) {
        header('location: nota_laborat.php?id='.$idkunjungan);
    }
    //var_dump($_POST);
//     $cekkode = mysqli_query($link, "SELECT * FROM pasienklinik
//     WHERE norm='$norm'");

// $jum     = mysqli_num_rows($cekkode);
// if ($jum==0) {

//     $sql="INSERT INTO kunjungan_klinik
//         (norm, nama, alamat, jenis_kelamin)
//         VALUES 
//         ('$norm','$nama','$alamat','$jenis_kelamin')";

//     $insert= mysqli_query($link, $sql);
//     if ($insert) {
//         header('location: kunjungan_klinik.php?add');
//     }
//      else{
//         header('location: pendaftaran_klinik.php?err');
//         printf("Query failed: %s\n,%s", mysqli_error($link),$sql);
//     }
// }
// else{
//     header('location: Pendaftaran_klinik.php?err=already');
// }
// }
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
    <title>Kunjungan Pasien Laborat - Labkes Ungaran</title>
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
                    <h3 class="text-themecolor">Tambah Kunjungan</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Kunjungan</li>
                    </ol>
                </div>
            </div>
            
            <!-- Container fluid  -->
            <?php
            include_once 'config/lookup_tarif.php';
            ?>
            
            <div class="container-fluid">
              
                <!-- Start Page Content -->
                <div class="row justify-content-md-center">
                    
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
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="card-title">Kunjungan Pasien Laborat</h3>
                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-lg-3 col-form-label">No. Register</label>
                                                <div class="col-lg-6">
                                                    <input class="form-control" type="text" name="noreg" value="<?php
                                                    echo $datacust['noreg'];
                                                    ?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-lg-3 col-form-label">Nama</label>
                                                <div class="col-lg-9">
                                                    <input class="form-control" type="text" name="nama" value="<?php
                                                    echo $datacust['nama'];
                                                    ?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-lg-3 col-form-label">Alamat</label>
                                                <div class="col-lg-9">
                                                    <input class="form-control" type="text" name="alamat" value="<?php
                                                    echo $datacust['alamat'];
                                                    ?>">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-lg-3 col-form-label" style="">Telpon</label>
                                                <div class="col-lg-9">
                                                    <input class="form-control" type="text" name="Telpon" value="<?php
                                                    echo $datacust['telpon'];
                                                    ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
                                <!-- start historical pasien -->
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="card-title">Historical Kunjungan Pasien </h3>
                                            <div class="form-group">
                                                <table id="kunjklinik" class="table table-sm table-bordered m-t-20">
                                                    <thead style="background-color: lightgray; font-weight: bolder; font-size: 18px;">
                                                        <th>Tanggal</th>
                                                        <th>Kode Kunjungan</th>
                                                        <th>Action</th>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sql    = "SELECT * FROM katagori_tarif";
                                                        $tampil = mysqli_query($link, $sql);
                                                        while ($row = mysqli_fetch_array($tampil)) 
                                                        {
                                                            ?>
                                                                <tr>
                                                                    <td>
                                                                        <?php
                                                                            echo $row['kode_katagori'];
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                            echo $row['nama_katagori'];
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <a href="hapusfasilitas.php?id=<?php
                                                                            echo $row['id'];
                                                                        ?>">
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
                            </div>
                            <!-- end historical pasien -->

                            <!-- start entry produk -->
                            <div class="row">
                                <div class="col-lg-12">
                                <h2> ENTRY DATA SAMPEL PASIEN LABORAT &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;   Tanggal: &nbsp; <?php echo date('d-M-Y') ;?></h3>
                                    <form action="" method="POST">
                                        <!-- <table border="1" bordercolor="#333333" id="tbl_1" class="table table-sm nowrap">
                                            <tr style="color:white">
                                                <td width="15%" bgcolor="blue"><span class="style3"><font size="2">Kode</font></span></td>
                                                <td width="40%" bgcolor="blue"><div align="center" class="style3"><font size="2">Nama Tarip</font></div></td>
                                                <td width="5%" bgcolor="blue" class="style3"><div align="center"><font size="2">Qty</font></div></td>
                                                <td width="15%" bgcolor="blue" class="style3"><div align="center"><font size="2">Harga</font></div></td>
                                                <td width="20%" bgcolor="blue" class="style3"><div align="center"><font size="2">Total Harga</font></div></td>
                                                <td width="5%" bgcolor="blue" class="style3"><div align="center"><font size="2">Hapus</font></div></td>
                                            </tr>
                                        </table> -->
                                    <?php
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
                                        
                                        var_dump($_POST);
                                        $cekkode = mysqli_query($link, "SELECT * FROM pasienklinik
                                            WHERE norm='$norm'");
                                
                                        $jum     = mysqli_num_rows($cekkode);
                                        if ($jum==0) {
                                
                                            $sql="INSERT INTO pasienklinik
                                                (tgl_pendaftaran, norm, identitas, no_identitas, nama, alamat, telpon, jenis_kelamin, agama, tempat_lahir, tgl_lahir, umur, status_marital, pendidikan, pekerjaan)
                                                VALUES 
                                                (NOW(), '$norm','$identitas','$no_identitas','$nama','$alamat','$telpon','$jenis_kelamin','$agama','$tempat_lahir','$tgl_lahir','$umur','$status_marital','$pendidikan','$pekerjaan')";
                                
                                            $insert= mysqli_query($link, $sql);
                                            if ($insert) {
                                                $idbaru= mysqli_insert_id($link);
                                                header('location: kunjungan_klinik.php??old=0&id='.$idbaru);
                                            }
                                             else{
                                                header('location: pendaftaran_klinik.php?err');
                                                printf("Query failed: %s\n,%s", mysqli_error($link),$sql);
                                            }
                                        }
                                        else{
                                            header('location: Pendaftaran_klinik.php?err=already');
                                        }
                                     }
                                ?>

                                    <!--aaaaa  -->
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
			                                    <h2 class="h2special pull-right d-none d-md-block">Pendaftaran Pasien Klinik</h1>
			                                </div> 
	                                	</div>
	                                </div>
	                                <hr>
	                                <div class="form-group row">
	                                    <label for="example-text-input" class="col-lg-3 col-form-label">Id Sampel</label>
	                                    <div class="col-lg-3">
	                                        <input class="form-control" type="text" name="id_sampel" placeholder="">
	                                    </div>
	                                </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Katagori:</label>
                                            <div class="col-lg-9">
                                                <div class="input-group">
                                                    <select class="col-lg-3 form-control custom-select" name="katagori">
                                                        <option value="">---Silahkan Pilih---</option>
                                                        <option value="1">Makanan</option>
                                                        <option value="2">Minuman</option>
                                                        <option value="3">Lingkungan</option>
                                                        <option value="4">Lain-lain</option>
                                                    </select>
                                                <!-- <div class="col-lg-6">
                                                    <input class="form-control" type="text" name="no_identitas" placeholder="masukan nomor identitas">
                                                </div> -->
                                                </div>
                                            </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Nama Sampel</label>
                                        <div class="col-lg-6">
                                            <input class="form-control" type="text" name="nama_sampel" placeholder="masukkan nama sampel">
                                        </div>
                                    </div>

	                                <div class="form-group row">
	                                    <label for="example-text-input" class="col-lg-3 col-form-label">Jumlah</label>
	                                    <div class="col-lg-1">
	                                        <input class="form-control" type="text" name="jumlah" placeholder="">
	                                    </div>
	                                </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Satuan</label>
                                        <div class="col-lg-2">
                                            <input class="form-control" type="text" name="satuan" placeholder="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Dari/Asal Sampel</label>
                                        <div class="col-lg-3">
                                            <input class="form-control" type="text" name="asal" placeholder="dari/asal sampel">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Lokasi/Alamat</label>
                                        <div class="col-lg-5">
                                            <input class="form-control" type="text" name="lokasi" placeholder="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Penangggung Jawab</label>
                                        <div class="col-lg-4">
                                            <input class="form-control" type="text" name="penanggung_jawab" placeholder="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Nomor Telpon</label>
                                        <div class="col-lg-3">
                                            <input class="form-control" type="text" name="nomor_telpon" placeholder="">
                                        </div>
                                    </div>

                                    <!-- <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Tempat Lahir</label>
                                        <div class="col-lg-3">
                                            <input class="form-control" type="text" name="tempat_lahir" placeholder="masukan tempat lahir">
                                        </div>
                                        
                                        <label for="example-text-input" class="col-lg-2 col-form-label">Tanggal Lahir :</label>
                                        <div class="col-lg-3">
                                            <input type="date" class="form-control" name="tgl_lahir" placeholder="dd/mm/yyyy">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-lg-3 col-form-label">Pendidikan</label>
                                        <div class="col-lg-3">
                                            <select class="form-control custom-select" name="pendidikan">
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
                                    </div> -->
                                 </div>
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
    </div>


                                    
                                    
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
