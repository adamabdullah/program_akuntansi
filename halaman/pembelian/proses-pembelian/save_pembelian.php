<?php
include('../../../config/connect.php');


$produk = $_POST['nama_produk'];
$quantity = $_POST['quantity'];
$harga_satuan = $_POST['harga_satuan'];
$jumlah_uang_produk = $_POST['jumlah_uang_produk'];
$kontak = $_POST['kontak'];
$errorMSG = "";

    if (empty($kontak)) 
    {
         $errorMSG .= "satuan is required";
    }


foreach ($produk as $key => $value) {
    if (empty($value)) 
    {
         $errorMSG = "Produk is required";
    }
}

foreach ($jumlah_uang_produk as $key => $value) {
    if (empty($value)) 
    {
         $errorMSG .= "satuan is required";
    }
}


foreach ($harga_satuan as $key => $value) {
    if (empty($value)) 
    {
         $errorMSG .= "satuan is required";
    }
}

foreach ($quantity as $key => $value) {
    if (empty($value)) 
    {
         $errorMSG .= "Quantity is required";
    }
}

if(empty($errorMSG)){

$kontak = $_POST['kontak'];
$email = $_POST['email'];
$alamat = $_POST['alamat']; 
$tgl_transaksi = $_POST['tgl_transaksi']; 
$tgl_tempo = $_POST['tgl_tempo'];
// $syarat_pembayaran = $_POST['syarat_pembayaran'];
$nomor_transaksi = $_POST['nomor_transaksi'];
$no_ref_pelanggan = $_POST['no_ref_pelanggan'];
$pesan = $_POST['pesan'];
$memo = $_POST['memo']; 
// $tag = $_POST['tag'];
// $tags = implode(", " , $tag);


$total_semuanya = $_POST['total_semuanya'];

$nama_produk = $_POST['nama_produk'];
// $deskripsi = $_POST['deskripsi'];
$quantity = $_POST['quantity'];
$uang_pajak = $_POST['uang_pajak'];
$nama_pajak = $_POST['nama_pajak'];
$harga_satuan = $_POST['harga_satuan'];
$jumlah_uang_produk = $_POST['jumlah_uang_produk'];

$sql ="INSERT INTO `transaksi_produk`(`no`, `pelanggan`, `tgl_transaksi`, `kode`, `tgl_tempo`, `no_referensi`, `memo` , `pesan`, `sisa_tagihan`, `total`, `status`, `kolom` ) VALUES ('NULL', '".$kontak."','".$tgl_transaksi."','".$nomor_transaksi."', '".$tgl_tempo."', '".$no_ref_pelanggan."', '".$memo."', '".$pesan."', '".$total_semuanya."' , '".$total_semuanya."', 'open', 'pembelian')";
mysqli_query($connect, $sql);

$product1 = array_filter( $nama_pajak );
$sum = count($product1);

$query = "SELECT no as kode_child from transaksi_produk where kode='".$nomor_transaksi."'";
$hasil = mysqli_query($connect,$query);
$data = mysqli_fetch_array($hasil);
$kodeBarang = $data['kode_child'];
$noUrut = (int)$kodeBarang;

if($sum > 0)
{
    $hasil = array(); //-----------------------------pertama jadikan object json dulu
    foreach ($nama_pajak as $id => $key) {
        $hasil[$id] = array(
            'nama'  => $nama_pajak[$id],    
            'uang' => $uang_pajak[$id],
        );
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
     
    $uang_pajak2 = array_column($amount, 'uang');
    $nama_pajak2 = array_column($amount, 'nama');

    foreach ($nama_pajak2 as $key=>$isi)  //pajak
      {
        // if($nama_pajak2 != '')
        // {
            $arr = explode("|", $nama_pajak2[$key], 2);
              $nama_pajak_saja = $arr[0];
              $pajak_masukkan = "SELECT akun_pajak_pembelian from pajak where nama_pajak='".$nama_pajak_saja."'";
              $hasil_query = mysqli_query($connect,$pajak_masukkan);
              $data_pajak = mysqli_fetch_array($hasil_query);

                $sql_kirim1 = "INSERT INTO `transaksi`(`kode_transaksi`, `kode_akun`, `kolom`, `debit`, `kredit`, `no`, `nama_pajak_ori`, `tgl_transaksi`) VALUES ('".$nomor_transaksi."', '".$data_pajak['akun_pajak_pembelian']."', 'pembelian_pajak', '".$uang_pajak2[$key]."', '0','".$noUrut."', '".$nama_pajak2[$key]."', '".$tgl_transaksi."')";
            mysqli_query($connect, $sql_kirim1); 
        // }
          
      }
}



//--------------untuk insert pajak

foreach ($nama_produk as $key => $value) 
{
    $arr = explode("|", $nama_produk[$key], 2);
    $kode_produk_saja = $arr[0];
    $query_masukkan = "SELECT * from produk where kode_produk='".$kode_produk_saja."'";
    $hasil_query2 = mysqli_query($connect,$query_masukkan);
    $data_produk = mysqli_fetch_array($hasil_query2);

    $arr = explode("|", $nama_pajak[$key], 2);
    $nama_pajak_saja = $arr[0];
    $pajak_masukkan = "SELECT akun_pajak_pembelian from pajak where nama_pajak='".$nama_pajak_saja."'";
    $hasil_query = mysqli_query($connect,$pajak_masukkan);
    $data_pajak = mysqli_fetch_array($hasil_query);

    $sql_kirim1 = "INSERT INTO `transaksi`(`kode_transaksi`, `kode_akun`, `kolom`, `debit`, `kredit`, `no`, `nama_pajak`, `harga_pajak`, `jumlah_uang`, `qty_produk`, `nama_produk`, `nama_pajak_ori`, `tgl_transaksi`) VALUES ('".$nomor_transaksi."', '".$data_produk['akun_beli']."', 'pembelian', '".$jumlah_uang_produk[$key]."', '0','".$noUrut."', '".$data_pajak['akun_pajak_pembelian']."', '".$uang_pajak[$key]."', '".$harga_satuan[$key]."', '".$quantity[$key]."', '".$nama_produk[$key]."', '".$nama_pajak[$key]."', '".$tgl_transaksi."')";
    mysqli_query($connect, $sql_kirim1);   
} 

$sql_kirim = "INSERT INTO `transaksi`(`kode_transaksi`, `kode_akun`, `kolom`, `debit`, `kredit`, `no`, `tgl_transaksi`) VALUES ('".$nomor_transaksi."', '2-20100 | Hutang Usaha', 'pembelian', '0', '".$total_semuanya."', '".$noUrut."', '".$tgl_transaksi."')";
    mysqli_query($connect, $sql_kirim);
    echo json_encode(['code'=>'berhasil', 'msg'=>'berhasil']);
	exit;
}

echo json_encode(['code'=>'gagal', 'msg'=>$errorMSG]);
?>