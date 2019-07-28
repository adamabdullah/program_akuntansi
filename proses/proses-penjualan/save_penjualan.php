<?php
include('../../../config/connect.php');
$kontak = $_POST['kontak'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$tgl_transaksi = $_POST['tgl_transaksi']; 
$tgl_tempo = $_POST['tgl_tempo'];
$cara_pembayaran = $_POST['cara_pembayaran'];
$nomor_transaksi = $_POST['nomor_transaksi'];
$no_ref_pelanggan = $_POST['no_ref_pelanggan'];
$pesan = $_POST['pesan'];
$memo = $_POST['memo'];


$total_semuanya = $_POST['total_semuanya'];

$nama_produk = $_POST['nama_produk'];
$deskripsi = $_POST['deskripsi'];
$quantity = $_POST['quantity'];
$uang_pajak = $_POST['uang_pajak'];
$nama_pajak = $_POST['nama_pajak'];
$harga_satuan = $_POST['harga_satuan'];
$jumlah_uang_produk = $_POST['jumlah_uang_produk'];

$jurnal ="INSERT INTO `jurnal_umum2`(`id_jurnal`, `id_transaksi`, `tanggal`, `total`, `nama_tabel`) VALUES (NULL, '".$nomor_transaksi."', '".$tgl_transaksi."','".$total_semuanya."','penjualan')";
mysqli_query($connect, $jurnal);

// $penjualan_insert = "INSERT INTO `penjualan`(`kode_penjualan`, `nama_pelanggan`, `akun_penjualan`, `tgl_transaksi`, `tgl_jatuh_tempo`, `syarat_pembayaran`, `no_ref_pelanggan`, `no_detail_penjualan`, `pesan`, `memo`, `total`, `sisa_tagihan`) VALUES ('".$nomor_transaksi."', '".$kontak."','1-10100 Piutang Usaha', '".$tgl_transaksi."','".$tgl_tempo."','".$cara_pembayaran."', '".$no_ref_pelanggan."','NULL','".$pesan."', '".$memo."', '".$total_semuanya."', '".$total_semuanya."')";
// mysqli_query($connect, $penjualan_insert);

$penjualan_insert = "INSERT INTO `penjualan`(`kode`, `pelanggan`, `akun`, `tgl_transaksi`, `tgl_tempo`, `syarat_pembayaran`, `no_referensi`, `no`, `pesan`, `memo`, `total`, `sisa_tagihan`) VALUES ('".$nomor_transaksi."', '".$kontak."','1-10100 | Piutang Usaha', '".$tgl_transaksi."','".$tgl_tempo."','".$cara_pembayaran."', '".$no_ref_pelanggan."','NULL','".$pesan."', '".$memo."', '".$total_semuanya."', '".$total_semuanya."')";
mysqli_query($connect, $penjualan_insert);

$hasil = array(); //-----------------------------pertama jadikan object json dulu
foreach ($nama_pajak as $id => $key) {
    $hasil[$id] = array(
        'nama'  => $nama_pajak[$id],
        'uang' => $uang_pajak[$id],
    );
}

$amount = array(); //---------------------------------setelah itu cari mana yg sama
foreach($hasil as $bank) {	
    $index = bank_exists($bank['nama'], $amount);
    if ($index < 0) 
    {
    	 $amount[] = $bank;
    }
    else 
    {
    	$amount[$index]['uang']+=$bank['uang'];    
    }
}

function bank_exists($bankname, $array) {
    $result2 = -1;
    for($i=0; $i<sizeof($array); $i++) 
    {
        if ($array[$i]['nama'] == $bankname) {
            $result2 = $i;
            break;
        }
    }
    return $result2;
}

$uang_pajak2 = array_column($amount, 'uang');
$nama_pajak2 = array_column($amount, 'nama');

$nama_pajak2[0]." ".$uang_pajak2[0];

$panjang = (int) count($nama_produk);
$query = "SELECT no as kode_child from penjualan where kode='".$nomor_transaksi."'";
$hasil = mysqli_query($connect,$query);
$data = mysqli_fetch_array($hasil);
$kodeBarang = $data['kode_child'];
$noUrut = (int)$kodeBarang;

// foreach ($nama_pajak2 as $key=>$isi) 
// 	{
// 		// echo $nama_pajak2[$key];
// 		$arr = explode("|", $nama_pajak2[$key], 2);
// 		$nama_pajak_saja = $arr[0];
// 		$pajak_masukkan = "SELECT akun_pajak_penjualan from pajak where nama_pajak='".$nama_pajak_saja."'";
// 		$hasil_query = mysqli_query($connect,$pajak_masukkan);
// 		$data_pajak = mysqli_fetch_array($hasil_query);

// 		$pajak_sql= "INSERT INTO `detail_penjualan`(`no_detail_penjualan`, `akun_produk`, `deskripsi`, `kuantitas`, `harga_satuan`, `jumlah`) VALUES ('".$noUrut."','".$data_pajak['akun_pajak_penjualan']."','NULL', 'NULL', 'NULL', '".$uang_pajak2[$key]."')";
// 		// mysqli_query($connect, $pajak_sql);	

//         $sql_detail3 = "INSERT INTO `detail_akun`(`kode_transaksi`, `nama_akun`, `kontak`, `debit`, `kredit`) VALUES ('".$nomor_transaksi."', '".$data_produk['akun_jual']."', '".$kontak."', '".$jumlah_uang_produk[$a]."', '0')";
//         // mysqli_query($connect, $sql_detail3); 
// 	}

	// for($a = 0; $a < $panjang; $a++)
	// {
	// 	$arr = explode("|", $nama_produk[$a], 2);
	// 	$kode_produk_saja = $arr[0];

	// 	$query_masukkan = "SELECT * from produk where kode_produk='".$kode_produk_saja."'";
	// 	$hasil_query = mysqli_query($connect,$query_masukkan);
	// 	$data_produk = mysqli_fetch_array($hasil_query);

	// 	$produk_sql= "INSERT INTO `detail_penjualan`(`no_detail_penjualan`,  `nama_produk`, `akun_produk`, `deskripsi`, `kuantitas`, `harga_satuan`, `jumlah`) VALUES ('".$noUrut."','".$nama_produk[$a]."', '".$data_produk['akun_jual']."' ,'".$deskripsi[$a]."', '".$quantity[$a]."', '".$harga_satuan[$a]."', '".$jumlah_uang_produk[$a]."')";
	// 	mysqli_query($connect, $produk_sql);	 
	// }

     for($a = 0; $a < $panjang; $a++) 
    {

        $arr = explode("|", $nama_produk[$a], 2);
        $kode_produk_saja = $arr[0];
        $query_masukkan = "SELECT * from produk where kode_produk='".$kode_produk_saja."'";
        $hasil_query2 = mysqli_query($connect,$query_masukkan);
        $data_produk = mysqli_fetch_array($hasil_query2);

        $arr_9 = explode("|", $nama_pajak[$a], 2);
        $nama_pajak_saja = $arr_9[0];
        $pajak_masukkan = "SELECT akun_pajak_penjualan from pajak where nama_pajak='".$nama_pajak_saja."'";
        $hasil_query = mysqli_query($connect,$pajak_masukkan);
        $data_pajak = mysqli_fetch_array($hasil_query);

        $sql_detail3 = "INSERT INTO `detail_akun`(`kode_transaksi`, `nama_akun`, `kontak`, `debit`, `kredit`, `tgl_transaksi`) VALUES ('".$nomor_transaksi."', '".$data_produk['akun_jual']."', '".$kontak."', '0', '".$jumlah_uang_produk[$a]."' ,'".$tgl_transaksi."')";
        mysqli_query($connect, $sql_detail3); 

         $pajak_sql= "INSERT INTO `detail_penjualan`(`no`, `akun_produk`, `nama_produk`, `akun_pajak` ,`deskripsi`, `kuantitas`, `harga_pajak`, `total_beli`) VALUES ('".$noUrut."','".$data_produk['akun_jual']."', '".$nama_produk[$a]."','".$data_pajak['akun_pajak_penjualan']."', '".$deskripsi[$a]."', '".$quantity[$a]."', '".$uang_pajak[$a]."', '".$jumlah_uang_produk[$a]."')";
        mysqli_query($connect, $pajak_sql);  
    }

    foreach ($nama_pajak2 as $key=>$isi) 
    {
        $arr2 = explode("|", $nama_pajak2[$key], 2);
        $nama_pajak_saja = $arr2[0];
        $pajak_masukkan = "SELECT akun_pajak_penjualan from pajak where nama_pajak='".$nama_pajak_saja."'";
        $hasil_query = mysqli_query($connect,$pajak_masukkan);
        $data_pajak = mysqli_fetch_array($hasil_query);

        $sql_detail3 = "INSERT INTO `detail_akun`(`kode_transaksi`, `nama_akun`, `kontak`, `debit`, `kredit`, `tgl_transaksi`) VALUES ('".$nomor_transaksi."', '".$data_pajak['akun_pajak_penjualan']."', '".$kontak."', '0', '".$uang_pajak2[$key]."','".$tgl_transaksi."')";
        mysqli_query($connect, $sql_detail3);     
    }

      $sql_detail3 = "INSERT INTO `detail_akun`(`kode_transaksi`, `nama_akun`, `kontak`, `debit`, `kredit`, `tgl_transaksi`) VALUES ('".$nomor_transaksi."', '2-20100 | Piutang Usaha', '".$kontak."', '".$total_semuanya."', '0', '".$tgl_transaksi."')";
        mysqli_query($connect, $sql_detail3); 

// $insert_detail_penjualan = "INSERT INTO `detail_penjualan`(`no_detail_penjualan`, `akun_produk`, `deskripsi`, `kuantitas`, `harga_satuan`, `jumlah`) VALUES ('".$noUrut."','".$"')";


// $insert_produk ="INSERT INTO `produk`(`kode_produk`, `nama_produk`, `akun_beli`, `akun_jual`, `harga_beli_satuan`, `harga_jual_satuan`, `qty`) VALUES ('".$kode_produk."', '".$nama_produk."', '".$pembelian_akun_kemana."', '".$penjualan_akun_kemana."', '".$harga_beli_satuan."', '".$harga_jual_satuan."', '".$quantity."' )";
// mysqli_query($connect, $insert_produk);
?>