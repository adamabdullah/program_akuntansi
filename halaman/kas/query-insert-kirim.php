<?php 
include('../../config/connect.php');

$bayar_dari = $_POST['bayar_dari'];
$penerima = $_POST['penerima'];
$no_transaksi = $_POST['no_transaksi']; 

$akun_kirim = $_POST['akun_kirim'];
$uang = $_POST['uang'];
$errorMSG = "";

if (empty($bayar_dari)) 
    {
         $errorMSG .= "satuan is required";
    }

    if (empty($penerima)) 
    {
         $errorMSG .= "satuan is required";
    }

    if (empty($no_transaksi)) 
    {
         $errorMSG .= "satuan is required";
    }


foreach ($akun_kirim as $key => $value) {
    if (empty($value)) 
    {
         $errorMSG = "akun_kirim is required";
    }
}

foreach ($uang as $key => $value) {
    if (empty($value)) 
    {
         $errorMSG .= "satuan is required";
    }
}

if(empty($errorMSG)){

$bayar_dari = $_POST['bayar_dari'];
$penerima = $_POST['penerima'];
$tanggalan = $_POST['tanggalan'];
$no_transaksi = $_POST['no_transaksi']; 
// $tag = $_POST['tag'];


$akun = $_POST['akun_kirim'];
// $deskripsi =$_POST['deskripsi'];
$pajak = $_POST['pajak'];
$uang = $_POST['uang']; 
$total_semua = $_POST['total_semua'];
$nama_pajak=$_POST['nama_pajak'];
$nama_pajak_ori = $_POST['nama_pajak_ori'];

$total = count($akun);

$sql ="INSERT INTO `transaksi_akun`(`no`, `kontak`, `kode_transaksi`, `tgl_transaksi`) VALUES ('NULL', '".$penerima."','".$no_transaksi."', '".$tanggalan."')";
mysqli_query($connect, $sql);

$query = "SELECT no as kode_child from transaksi_akun where kode_transaksi='".$no_transaksi."'";
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
                'uang' => $pajak[$id],
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

                $sql_kirim1 = "INSERT INTO `transaksi`(`kode_transaksi`, `tgl_transaksi`, `kode_akun`, `kolom`, `debit`, `kredit`, `no`, `nama_pajak_ori`) VALUES ('".$no_transaksi."', '".$tanggalan."', '".$data_pajak['akun_pajak_pembelian']."', 'kirim_uang_pajak','".$uang_pajak2[$key]."', '0', '".$noUrut."', '".$nama_pajak2[$key]."')";
                mysqli_query($connect, $sql_kirim1);          
        }
    }



//--------------------untuk insert pajak kredit
foreach ($akun as $key => $value) 
{
    $nama_pajak[$key]." | ";
    $arr = explode("|", $nama_pajak[$key], 2);
    $nama_pajak_saja = $arr[0];
    $pajak_masukkan = "SELECT akun_pajak_pembelian from pajak where nama_pajak='".$nama_pajak_saja."'";
    $hasil_query = mysqli_query($connect,$pajak_masukkan);
    $data_pajak = mysqli_fetch_array($hasil_query); 
    $sql_kirim1 = "INSERT INTO `transaksi`(`kode_transaksi`, `tgl_transaksi`, `kode_akun`, `kolom`, `debit`, `kredit`, `no`, `nama_pajak`, `harga_pajak`, `nama_pajak_ori`) VALUES ('".$no_transaksi."', '".$tanggalan."', '".$akun[$key]."', 'kirim_uang','".$uang[$key]."', '0', '".$noUrut."', '".$data_pajak['akun_pajak_pembelian']."', '".$pajak[$key]."', '$nama_pajak_ori[$key]')";
    mysqli_query($connect, $sql_kirim1);   
}

$sql_kirim = "INSERT INTO `transaksi`(`kode_transaksi`, `tgl_transaksi`, `kode_akun`, `kolom`, `debit`, `kredit`, `no`) VALUES ('".$no_transaksi."', '".$tanggalan."', '".$bayar_dari."', 'kirim_uang','0','".$total_semua."','".$noUrut."')";
mysqli_query($connect, $sql_kirim);
    echo json_encode(['code'=>'berhasil', 'msg'=>'berhasil']);
	exit;
}
echo json_encode(['code'=>'gagal', 'msg'=>$errorMSG]);







// $noUrut++;
// $kodeBarang = (int) $noUrut;





?>