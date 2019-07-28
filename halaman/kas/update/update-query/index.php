<?php
include('../../../../config/connect.php');

$nomor_transaksi		= $_POST['no_biaya'];
$akun_bayar				= $_POST['akun_bayar'];
$tgl_transaksi			= $_POST['tgl_transaksi']; 
$penerima				= $_POST['penerima'];  

$akun_val = $_POST['akun_val'];
$uang_val = $_POST['uang_val'];

$errorMSG = "";

if (empty($nomor_transaksi)) 
    {
         $errorMSG .= "nomor_transaksi is required";
    }

    if (empty($akun_bayar)) 
    {
         $errorMSG .= "akun_bayar is required";
    }

    if (empty($tgl_transaksi)) 
    {
         $errorMSG .= "tgl_transaksi is required";
    }

    if (empty($penerima)) 
    {
         $errorMSG .= "penerima is required";
    }


foreach ($akun_val as $key => $value) {
    if (empty($value)) 
    {
         $errorMSG = "akun_kirim is required";
    }
}

foreach ($uang_val as $key => $value) {
    if (empty($value)) 
    {
         $errorMSG .= "uang_val is required";
    }
}

if(empty($errorMSG)){

$akun_bayar				= $_POST['akun_bayar'];
$total_semuanya	= $_POST['total_uang_tnpa_koma'];
$tgl_transaksi			= $_POST['tgl_transaksi'];
// $tag                    = $_POST['tag'];
// $tgl_tempo				=  

$nomor_transaksi		= $_POST['no_biaya'];
$penerima				= $_POST['penerima'];  

$memo					= $_POST['memo'];

// $uang_per_akun_lama		= $_POST['uang_per_akun_lama'];
// $uang_pajak_perakun_lama= $_POST['uang_pajak_perakun_lama'];
// $nama_pajak_lama		= $_POST['nama_pajak_lama']; 
// $deskripsi_lama			= $_POST['deskripsi_lama'];
// $akun_lama   			= $_POST['akun_lama'];

$kode_rahasia 			= $_POST['kode_rahasia'];
$nama_pajak_total		= $_POST['nama_pajak_total'];
$uang_pajak_total		= $_POST['uang_pajak_total'];

$akun_val = $_POST['akun_val'];
$uang_val = $_POST['uang_val'];

// print_r($nama_pajak_patokan);
// print_r($nama_pajak_total);


$sql = "UPDATE `transaksi_akun` SET  `kontak`='".$penerima."', `tgl_transaksi`='".$tgl_transaksi."', `kode_transaksi`='".$nomor_transaksi."', `memo`='".$memo."'  WHERE kode_transaksi='".$kode_rahasia."'";
mysqli_query($connect, $sql);

$sql_hapus = "DELETE from transaksi where kode_transaksi='".$kode_rahasia."'";
mysqli_query($connect, $sql_hapus);

$query = "SELECT no as kode_child from transaksi_akun where kode_transaksi='".$kode_rahasia."'";
$hasil = mysqli_query($connect,$query);
$data = mysqli_fetch_array($hasil);
$kodeBarang = $data['kode_child'];
$noUrut = (int)$kodeBarang;

$sql_kirim = "INSERT INTO `transaksi`(`kode_transaksi`, `tgl_transaksi`, `kode_akun`, `kolom`, `debit`, `kredit`, `no`) 
VALUES ('".$nomor_transaksi."', '".$tgl_transaksi."', '".$akun_bayar."', 'kirim_uang','0','".$total_semuanya."','".$noUrut."')";
    mysqli_query($connect, $sql_kirim);

    $product1 = array_filter( $nama_pajak_total );
    $sum = count($product1);

 if($sum > 0)
    {

        $hasil = array(); //-----------------------------pertama jadikan object json dulu
        foreach ($nama_pajak_total as $id => $key) {
            $hasil[$id] = array(
                'nama'  => $nama_pajak_total[$id],
                'uang' => $uang_pajak_total[$id],
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

        foreach ($nama_pajak2 as $key=>$isi) 
        {
                $arr = explode("|", $nama_pajak2[$key], 2);
                $nama_pajak_saja = $arr[0];
                $pajak_masukkan = "SELECT akun_pajak_pembelian from pajak where nama_pajak='".$nama_pajak_saja."'";
                $hasil_query = mysqli_query($connect,$pajak_masukkan);
                $data_pajak = mysqli_fetch_array($hasil_query); 

                $sql_kirim1 = "INSERT INTO `transaksi`(`kode_transaksi`, `tgl_transaksi`, `kode_akun`, `kolom`, `debit`, `kredit`, `no`, `nama_pajak_ori`) VALUES ('".$nomor_transaksi."', '".$tgl_transaksi."', '".$data_pajak['akun_pajak_pembelian']."', 'kirim_uang_pajak','".$uang_pajak2[$key]."', '0', '".$noUrut."', '".$nama_pajak2[$key]."')";
                mysqli_query($connect, $sql_kirim1);          
        }
    }

foreach ($akun_val as $key => $value) 
{
    $arr = explode("|", $nama_pajak_total[$key], 2);
    $nama_pajak_saja = $arr[0];
    $pajak_masukkan = "SELECT akun_pajak_pembelian from pajak where nama_pajak='".$nama_pajak_saja."'";
    $hasil_query = mysqli_query($connect,$pajak_masukkan);
    $data_pajak = mysqli_fetch_array($hasil_query);

    $sql_insert_pajak_baru2 = "INSERT INTO `transaksi`(`kode_transaksi`,`kode_akun`, `kolom`, `debit`, `no`, `nama_pajak_ori`,`tgl_transaksi`, `harga_pajak`, `nama_pajak`) VALUES('".$nomor_transaksi."', '".$akun_val[$key]."', 'kirim_uang', '".$uang_val[$key]."', '".$noUrut."', '".$nama_pajak_total[$key]."', '".$tgl_transaksi."', '".$uang_pajak_total[$key]."', '".$data_pajak['akun_pajak_pembelian']."')";
    mysqli_query($connect,$sql_insert_pajak_baru2);
}
  echo json_encode(['code'=>'berhasil', 'msg'=>'berhasil']);
	exit;

}
echo json_encode(['code'=>'gagal', 'msg'=>$errorMSG]);
?>