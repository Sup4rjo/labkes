<!DOCTYPE html>
<html>
<head>
<title>Transaki Penjualan</title>
<link rel=”stylesheet” href=”css/bootstrap.css”>
<script src=”js/jquery.js”></script>
<script src=”js/jquery.ui.datepicker.js”></script>
<script>
//mendeksripsikan variabel yang akan digunakan
var nota;
var tanggal;
var kode;
var nama;
var harga;
var jumlah;
var stok;
$(function(){
//meload file pk dengan operator ambil barang dimana nantinya
//isinya akan masuk di combo box
$(“#kode”).load(“pk.php”,”op=ambilbarang”);
//meload isi tabel
$(“#barang”).load(“pk.php”,”op=barang”);
//mengkosongkan input text dengan masing2 id berikut
$(“#nama”).val(“”);
$(“#harga”).val(“”);
$(“#jumlah”).val(“”);
$(“#stok”).val(“”);
//jika ada perubahan di kode barang
$(“#kode”).change(function(){
kode=$(“#kode”).val();
//tampilkan status loading dan animasinya
$(“#status”).html(“loading. . .”);
$(“#loading”).show();
//lakukan pengiriman data
$.ajax({
url:”proses.php”,
data:”op=ambildata&kode=”+kode,
cache:false,
success:function(msg){
data=msg.split(“|”);
//masukan isi data ke masing – masing field
$(“#nama”).val(data[0]);
$(“#harga”).val(data[1]);
$(“#stok”).val(data[3]);
$(“#jumlah”).focus();
//hilangkan status animasi dan loading
$(“#status”).html(“”);
$(“#loading”).hide();
}
});
});
//jika tombol tambah di klik
$(“#tambah”).click(function(){
kode=$(“#kode”).val();
stok=$(“#stok”).val();
jumlah=$(“#jumlah”).val();
if(kode==”Kode Barang”){
alert(“Kode Barang Harus diisi”);
exit();
}else if(jumlah > stok){
alert(“Stok tidak terpenuhi”);
$(“#jumlah”).focus();
exit();
}else if(jumlah < 1){
alert(“Jumlah beli tidak boleh 0″);
$(“#jumlah”).focus();
exit();
}
nama=$(“#nama”).val();
harga=$(“#harga”).val();
$(“#status”).html(“sedang diproses. . .”);
$(“#loading”).show();
$.ajax({
url:”pk.php”,
data:”op=tambah&kode=”+kode+”&nama=”+nama+”&harga=”+harga+”&jumlah=”+jumlah,
cache:false,
success:function(msg){
if(msg==”sukses”){
$(“#status”).html(“Berhasil disimpan. . .”);
}else{
$(“#status”).html(“ERROR. . .”);
}
$(“#loading”).hide();
$(“#nama”).val(“”);
$(“#harga”).val(“”);
$(“#jumlah”).val(“”);
$(“#stok”).val(“”);
$(“#kode”).load(“pk.php”,”op=ambilbarang”);
$(“#barang”).load(“pk.php”,”op=barang”);
}
});
});
//jika tombol proses diklik
$(“#proses”).click(function(){
nota=$(“#nota”).val();
tanggal=$(“#tanggal”).val();
$.ajax({
url:”pk.php”,
data:”op=proses&nota=”+nota+”&tanggal=”+tanggal,
cache:false,
success:function(msg){
if(msg==’sukses’){
$(“#status”).html(‘Transaksi Pembelian berhasil’);
alert(‘Transaksi Berhasil’);
exit();
}else{
$(“#status”).html(‘Transaksi Gagal’);
alert(‘Transaksi Gagal’);
exit();
}
$(“#kode”).load(“pk.php”,”op=ambilbarang”);
$(“#barang”).load(“pk.php”,”op=barang”);
$(“#loading”).hide();
$(“#nama”).val(“”);
$(“#harga”).val(“”);
$(“#jumlah”).val(“”);
$(“#stok”).val(“”);
}
})
})
});
</script>
</head>
<body>
<div>
<?php
include “db/koneksi.php”;
$p=isset($_GET['act'])?$_GET['act']:null;
switch($p){
default:
echo “<table class=’table table-bordered’>
<tr>
<td colspan=’3′><a href=’?page=penjualan&act=tambah’ class=’btn btn-primary’>Input Transaksi</a></td>
</tr>
<tr>
<td>No.Nota</td>
<td>Tanggal</td>
<td>Jumlah</td>
<td>Tools</td>
</tr>”;
$query=mysql_query(“select * from penjualan”);
while($r=mysql_fetch_array($query)){
echo “<tr>
<td><a href=’?page=penjualan&act=detail&nota=$r[nonota]‘>$r[nonota]</a></td>
<td>$r[tanggal]</td>
<td>$r[total]</td>
<td><a href=’?page=penjualan&act=detail&nota=$r[nonota]‘>Cetak Nota</a></td>
</tr>”;
}
echo”</table>”;
break;
case “tambah”:
$tgl=date(‘Y-m-d’);
//untuk autonumber di nota
$auto=mysql_query(“select * from penjualan order by nonota desc limit 1″);
$no=mysql_fetch_array($auto);
$angka=$no['nonota']+1;
echo “<div class=’navbar-form pull-right’>
No. Nota : <input type=’text’ id=’nota’ value=’$angka’ readonly >
<input type=’text’ id=’tanggal’ value=’$tgl’ readonly>
</div>”;
echo'<legend>Transaksi Penjualan</legend>
<label>Kode Barang</label>
<select id=”kode”></select>
<input type=”text” id=”nama” placeholder=”Nama Barang” readonly>
<input type=”text” id=”harga” placeholder=”Harga” readonly>
<input type=”text” id=”stok” placeholder=”stok” readonly>
<input type=”text” id=”jumlah” placeholder=”Jumlah Beli”>
<button id=”tambah”>Tambah</button>
<span id=”status”></span>
<table id=”barang”>
</table>
<div>
<button id=”proses”>Proses</button>
</div>';
break;
case “detail”:
echo “<legend>Nota Penjualan</legend>”;
$nota=$_GET['nota'];
$query=mysql_query(“select penjualan.nonota,detailpenjualan.kode,tblbarang.nama,
detailpenjualan.harga,detailpenjualan.jumlah,detailpenjualan.subtotal
from detailpenjualan,penjualan,tblbarang
where penjualan.nonota=detailpenjualan.nonota and tblbarang.kode=detailpenjualan.kode
and detailpenjualan.nonota=’$nota'”);
$nomor=mysql_fetch_array(mysql_query(“select * from penjualan where nonota=’$nota'”));
echo “<div class=’navbar-form pull-right’>
Nota : <input type=’text’ value=’$nomor[nonota]‘ disabled>
<input type=’text’ value=’$nomor[tanggal]‘ disabled>
</div>”;
echo “<table class=’table table-hover’>
<thead>
<tr>
<td>Kode Barang</td>
<td>Nama</td>
<td>Harga</td>
<td>Jumlah</td>
<td>Subtotal</td>
</tr>
</thead>”;
while($r=mysql_fetch_row($query)){
echo “<tr>
<td>$r[1]</td>
<td>$r[2]</td>
<td>$r[3]</td>
<td>$r[4]</td>
<td>$r[5]</td>
</tr>”;
}
echo “<tr>
<td colspan=’4′><h4 align=’right’>Total</h4></td>
<td colspan=’5′><h4>$nomor[total]</h4></td>
</tr>
</table>”;
break;
}
?>
</div>
</body>
</html>
5. pk.php
<?php
include “db/koneksi.php”;
$op=isset($_GET['op'])?$_GET['op']:null;
if($op==’ambilbarang’){
$data=mysql_query(“select * from tblbarang”);
echo”<option>Kode Barang</option>”;
while($r=mysql_fetch_array($data)){
echo “<option value=’$r[kode]‘>$r[kode]</option>”;
}
}elseif($op==’ambildata’){
$kode=$_GET['kode'];
$dt=mysql_query(“select * from tblbarang where kode=’$kode'”);
$d=mysql_fetch_array($dt);
echo $d['nama'].”|”.$d['hrg_jual'].”|”.$d['stok'];
}elseif($op==’barang’){
$brg=mysql_query(“select * from tblsementara”);
echo “<thead>
<tr>
<td>Kode Barang</td>
<td>Nama</td>
<td>Harga</td>
<td>Jumlah Beli</td>
<td>Subtotal</td>
<td>Tools</td>
</tr>
</thead>”;
$total=mysql_fetch_array(mysql_query(“select sum(subtotal) as total from tblsementara”));
while($r=mysql_fetch_array($brg)){
echo “<tr>
<td>$r[kode]</td>
<td>$r[nama]</td>
<td>$r[harga]</td>
<td><input type=’text’ name=’jum’ value=’$r[jumlah]‘ class=’span2′></td>
<td>$r[subtotal]</td>
<td><a href=’pk.php?op=hapus&kode=$r[kode]‘ id=’hapus’>Hapus</a></td>
</tr>”;
}
echo “<tr>
<td colspan=’3′>Total</td>
<td colspan=’4′>$total[total]</td>
</tr>”;
}elseif($op==’tambah’){
$kode=$_GET['kode'];
$nama=$_GET['nama'];
$harga=$_GET['harga'];
$jumlah=$_GET['jumlah'];
$subtotal=$harga*$jumlah;
$tambah=mysql_query(“INSERT into tblsementara (kode,nama,harga,jumlah,subtotal)
values (‘$kode’,’$nama’,’$harga’,’$jumlah’,’$subtotal’)”);
if($tambah){
echo “sukses”;
}else{
echo “ERROR”;
}
}elseif($op==’hapus’){
$kode=$_GET['kode'];
$del=mysql_query(“delete from tblsementara where kode=’$kode'”);
if($del){
echo “<script>window.location=’index.php?page=penjualan&act=tambah';</script
}else{
echo “<script>alert(‘Hapus Data Berhasil’);
window.location=’index.php?page=penjualan&act=tambah';</script
}
}elseif($op==’proses’){
$nota=$_GET['nota'];
$tanggal=$_GET['tanggal'];
$to=mysql_fetch_array(mysql_query(“select sum(subtotal) as total from tblsementara”));
$tot=$to['total'];
$simpan=mysql_query(“insert into penjualan(nonota,tanggal,total)
values (‘$nota’,’$tanggal’,’$tot’)”);
if($simpan){
$query=mysql_query(“select * from tblsementara”);
while($r=mysql_fetch_row($query)){
mysql_query(“insert into detailpenjualan(nonota,kode,harga,jumlah,subtotal)
values(‘$nota’,’$r[0]‘,’$r[2]‘,’$r[3]‘,’$r[4]‘)”);
mysql_query(“update tblbarang set stok=stok-‘$r[3]‘
where kode=’$r[0]‘”);
}
//hapus seluruh isi tabel sementara
mysql_query(“truncate table tblsementara”);
echo “sukses”;
}else{
echo “ERROR”;
}
}
?>
5. Index.php
<!doctype html>
<html>
<head>
<title>Aplikasi Penjualan</title>
<link rel=”stylesheet” href=”css/style.css”>
<link rel=”stylesheet” href=”css/bootstrap.css”>
</head>
<body>
<div id=”container”>
<header>
<h1><a href=”https://www.facebook.com/groups/commit.stmiktegal/”>Communitas Mahasiswa IT</a></h1>
</header>
<!–menu –>
<nav>
<ul>
<li><a href=”index.php”>Master</a>
<ul>
<li><a href=”?page=barang”>Barang</a></li>
</ul>
</li>
<li><a href=”#”>Transaksi</a>
<ul>
<li><a href=”?page=penjualan”>Penjualan</a></li>
</ul>
</li>
</ul>
</nav>
<br>
<div>
<?php
include “db/koneksi.php”;
$p=isset($_GET['page'])?$_GET['page']:null;
switch($p){
default:
break;
case “barang”:
include “barang.php”;
break;
case “penjualan”:
include “transaksi.php”;
break;
}
?>
</div>
</body>
</html>
