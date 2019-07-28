<?php
include('../../../../config/connect.php');
$kode_transaksi = $_POST['kode_transaksi22'];
$nama_produk = $_POST['nama_produk'];
$uang_perproduk = $_POST['uang_produk'];
$nama_pajak_spesifik = $_POST['nama_pajak_spesifik'];
$uang_pajak_spesifik = $_POST['uang_pajak_spesifik'];

$arr = explode("|", $nama_pajak_spesifik[0], 2);
$nama_pajak_saja = $arr[0];
$pajak_masukkan = "SELECT akun_pajak_pembelian from pajak where nama_pajak='".$nama_pajak_saja."'";
$hasil_query = mysqli_query($connect,$pajak_masukkan);
$data_pajak = mysqli_fetch_array($hasil_query);
$data_pajak['akun_pajak_pembelian'];

//untuk mengambil nilai pajak spesifik
$pajak_masukkan2 = "SELECT * from transaksi where nama_pajak_ori='".$nama_pajak_spesifik[0]."' and kode_akun='".$data_pajak['akun_pajak_pembelian']."' and kode_transaksi='".$kode_transaksi."'";
$hasil_query2 = mysqli_query($connect,$pajak_masukkan2);
$data_pajak2= mysqli_fetch_array($hasil_query2);
$uang_pajak_ambil_db = $data_pajak2['debit'];
$stlh_dikurangi = $uang_pajak_ambil_db-$uang_pajak_spesifik[0];

//untuk mengambil nilai kredit semua total
$total_keseluruhan = "SELECT * from transaksi where kode_akun='2-20100 | Hutang Usaha' and kode_transaksi='".$kode_transaksi."'";
$hasil_query2 = mysqli_query($connect,$total_keseluruhan);
$data_uang_utama= mysqli_fetch_array($hasil_query2);
$total_seluruh_akun = $data_uang_utama['kredit'];
$hasil_debit = $total_seluruh_akun-($uang_pajak_spesifik[0]+$uang_perproduk);

//untuk mengurangi akun khusus pajak, contoh ppn masukkan
$update_kirim_uang = "UPDATE `transaksi` set `debit`='".$stlh_dikurangi."' where nama_pajak_ori='".$nama_pajak_spesifik[0]."' and kode_akun='".$data_pajak['akun_pajak_pembelian']."' and kode_transaksi='".$kode_transaksi."' ";
mysqli_query($connect, $update_kirim_uang);

//untuk mengurangi akun utama kredit, contoh 2-20100 | Hutang Usaha
$update_kredit_utama = "UPDATE `transaksi` set `kredit`='".$hasil_debit."' where  kode_akun='2-20100 | Hutang Usaha' and kode_transaksi='".$kode_transaksi."' ";
mysqli_query($connect, $update_kredit_utama);

//delete ketika pajak sudah 0
$sql_menghapus_null= "DELETE FROM `transaksi` where kode_akun='".$data_pajak['akun_pajak_pembelian']."' and `kode_transaksi`= '".$kode_transaksi."' and `debit`=0";
mysqli_query($connect, $sql_menghapus_null);

//delete ketika debit utama sudah 0
$sql_kredit_null= "DELETE FROM `transaksi` where `nama_produk`='".$nama_produk."' and `kode_transaksi`= '".$kode_transaksi."' and `kredit`=0 and `kode_akun` = '2-20100 | Hutang Usaha'";
mysqli_query($connect, $sql_kredit_null);

//delete produk
$sql_kredit_null= "DELETE FROM `transaksi` where `nama_produk`='".$nama_produk."' and `kode_transaksi`= '".$kode_transaksi."'";
mysqli_query($connect, $sql_kredit_null);

$sql_penghapus_transaksi = "DELETE FROM `transaksi_produk` where not exists (select null from `transaksi` where `kode_transaksi` = '".$kode_transaksi."' )"; 
mysqli_query($connect, $sql_penghapus_transaksi);

?>