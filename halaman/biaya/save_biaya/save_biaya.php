<?php
include('../../../config/connect.php');


$akun_bayar = $_POST['akun_bayar'];
$penerima = $_POST['penerima'];
$cara_pembayaran = $_POST['cara_pembayaran'];
$uang_per_akun = $_POST['uang_per_akun'];
$akun = $_POST['akun'];
$errorMSG = "";

if (empty($cara_pembayaran)) 
    {
         $errorMSG .= "satuan is required";
    }

    if (empty($akun_bayar)) 
    {
         $errorMSG .= "satuan is required";
    }

    if (empty($penerima)) 
    {
         $errorMSG .= "satuan is required";
    }


foreach ($uang_per_akun as $key => $value) {
    if (empty($value)) 
    {
         $errorMSG = "uang_per_akun is required";
    }
}

foreach ($akun as $key => $value) {
    if (empty($value)) 
    {
         $errorMSG .= "satuan is required";
    }
}

if(empty($errorMSG)){

$total_uang_tnpa_koma = $_POST['total_uang_tnpa_koma'];
$tgl_transaksi = $_POST['tgl_transaksi'];
$tgl_tempo = $_POST['tgl_tempo'];
$syarat_pembayaran = $_POST['syarat_pembayaran'];
$akun_bayar = $_POST['akun_bayar'];
$penerima = $_POST['penerima'];
$cara_pembayaran = $_POST['cara_pembayaran'];
$no_biaya = $_POST['no_biaya'];
$memo = $_POST['memo'];
$checked_byr_nanti = $_POST['checked_byr_nanti'];
// $tag = $_POST['tag'];
// $tags = implode(", ", $tag);

$uang_per_akun = $_POST['uang_per_akun'];
$uang_pajak_perakun = $_POST['uang_pajak_perakun'];
$nama_pajak = $_POST['nama_pajak'];
// $deskripsi = $_POST['deskripsi'];
$akun = $_POST['akun'];

// if($checked_byr_nanti == 'on')
// {
// 	$akun_bayar = "2-20100 | Hutang Usaha";
// }


$sql ="INSERT INTO `transaksi_akun`(`no`, `kontak`, `kode_transaksi`, `tgl_transaksi`, `tgl_tempo`, `syarat_pembayaran`, `cara_pembayaran`, `kolom`, `memo` ) VALUES ('NULL', '".$penerima."','".$no_biaya."', '".$tgl_transaksi."' , '".$tgl_tempo."' ,  '".$syarat_pembayaran."','".$cara_pembayaran."', 'biaya', '".$memo."')";
mysqli_query($connect, $sql); 

$query = "SELECT no as kode_child from transaksi_akun where kode_transaksi='".$no_biaya."'";
$hasil = mysqli_query($connect,$query);
$data = mysqli_fetch_array($hasil);
$kodeBarang = $data['kode_child'];
$noUrut = (int)$kodeBarang; 

$product1 = array_filter( $nama_pajak );
    $sum = count($product1);

 if($sum > 0)
    {
        $hasil = array(); //-----------------------------pertama jadikan object json dulu
    foreach ($nama_pajak as $id => $key) {
        $hasil[$id] = array(
            'nama'  => $nama_pajak[$id],
            'uang' => $uang_pajak_perakun[$id],
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

    //untuk pajak
    foreach ($nama_pajak2 as $key=>$isi) 
    {
        $arr = explode("|", $nama_pajak2[$key], 2);
        $nama_pajak_saja = $arr[0];
        $pajak_masukkan = "SELECT akun_pajak_pembelian from pajak where nama_pajak='".$nama_pajak_saja."'";
        $hasil_query = mysqli_query($connect,$pajak_masukkan);
        $data_pajak = mysqli_fetch_array($hasil_query); 

        $sql_kirim1 = "INSERT INTO `transaksi`(`kode_transaksi`, `kode_akun`, `kolom`, `debit`, `kredit`, `no`, `nama_pajak_ori`, `tgl_transaksi`) VALUES ('".$no_biaya."', '".$data_pajak['akun_pajak_pembelian']."', 'biaya_pajak', '".$uang_pajak2[$key]."', '0','".$noUrut."', '".$nama_pajak2[$key]."', '".$tgl_transaksi."')";
        mysqli_query($connect, $sql_kirim1);   
    }
    }







//untuk akun
foreach ($akun as $key => $value) 
{
    $nama_pajak[$key]." | ";
    $arr = explode("|", $nama_pajak[$key], 2);
    $nama_pajak_saja = $arr[0];
    $pajak_masukkan = "SELECT akun_pajak_pembelian from pajak where nama_pajak='".$nama_pajak_saja."'";
    $hasil_query = mysqli_query($connect,$pajak_masukkan);
    $data_pajak = mysqli_fetch_array($hasil_query); 

    $sql_biaya = "INSERT INTO `transaksi`(`kode_transaksi`, `kode_akun`, `kolom`, `debit`, `kredit`, `no`, `nama_pajak`, `harga_pajak`, `nama_pajak_ori`, `tgl_transaksi`) VALUES ('".$no_biaya."', '".$akun[$key]."', 'biaya', '".$uang_per_akun[$key]."', '0', '".$noUrut."', '".$data_pajak['akun_pajak_pembelian']."', '".$uang_pajak_perakun[$key]."', '".$nama_pajak[$key]."', '".$tgl_transaksi."')";
    mysqli_query($connect, $sql_biaya);  
}

$sql_kirim = "INSERT INTO `transaksi`(`kode_transaksi`, `kode_akun`, `kolom`, `debit`, `kredit`, `no`, `tgl_transaksi`) VALUES ('".$no_biaya."', '".$akun_bayar."', 'biaya', '0', '".$total_uang_tnpa_koma."', '".$noUrut."', '".$tgl_transaksi."')";
    mysqli_query($connect, $sql_kirim);
    echo json_encode(['code'=>'berhasil', 'msg'=>'berhasil']);
	exit;
}

echo json_encode(['code'=>'gagal', 'msg'=>$errorMSG]);

?>