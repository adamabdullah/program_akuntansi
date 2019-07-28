<?php
include('../../../../config/connect.php');

$akun_bayar				= $_POST['akun_bayar'];
$tgl_transaksi			= $_POST['tgl_transaksi'];
$nomor_transaksi		= $_POST['no_biaya']; 
$penerima				= $_POST['penerima'];
// $tag                    = $_POST['tag'];

$uang_val		        = $_POST['uang_val'];
$akun_val               = $_POST['akun_val'];

$errorMSG = "";

if (empty($akun_bayar)) 
    {
         $errorMSG .= "satuan is required";
    }

    if (empty($tgl_transaksi)) 
    {
         $errorMSG .= "satuan is required";
    }

    if (empty($nomor_transaksi)) 
    {
         $errorMSG .= "satuan is required";
    }

    if (empty($penerima)) 
    {
         $errorMSG .= "satuan is required";
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
         $errorMSG .= "satuan is required";
    }
}

if(empty($errorMSG)){

    $kode_rahasia = $_POST['kode_rahasia'];
    $akun_bayar				= $_POST['akun_bayar'];
    $total_semuanya	= $_POST['total_uang_tnpa_koma']; 
    $tgl_transaksi			= $_POST['tgl_transaksi'];
    // $tgl_tempo				= 

    $nomor_transaksi		= $_POST['no_biaya']; 
    $penerima				= $_POST['penerima'];

    $memo					= $_POST['memo'];

    $uang_pajak_total		= $_POST['uang_pajak_total'];
    $nama_pajak_total= $_POST['nama_pajak_total'];
    $uang_val		        = $_POST['uang_val'];
    $akun_val               = $_POST['akun_val'];
    // $deskripsi		        = $_POST['deskripsi'];

    $str = ltrim($kode_rahasia);
    $sql = "UPDATE `transaksi_akun` SET `kode_transaksi`='".$nomor_transaksi."', `kontak`='".$penerima."', `tgl_transaksi`='".$tgl_transaksi."', `kode_transaksi`='".$nomor_transaksi."', `memo`='".$memo."'  where kode_transaksi='".$kode_rahasia."' ";
    mysqli_query($connect, $sql);

    if (mysqli_connect_errno()) 
    {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    if (!mysqli_query($connect, $sql)) {
         printf("Errormessage: %s\n", mysqli_error($connect));
    }

    $query = "SELECT no as kode_child from transaksi_akun where kode_transaksi='".$kode_rahasia."'";
    $hasil = mysqli_query($connect,$query);
    $data = mysqli_fetch_array($hasil);
    $kodeBarang = $data['kode_child'];
    $noUrut = (int)$kodeBarang;

    $sql_hapus = "DELETE from transaksi where kode_transaksi='".$kode_rahasia."'";
    mysqli_query($connect, $sql_hapus);

    $sql_kirim = "INSERT INTO `transaksi`(`kode_transaksi`, `tgl_transaksi`, `kode_akun`, `kolom`, `debit`, `kredit`, `no`) VALUES ('".$nomor_transaksi."', '".$tgl_transaksi."', '".$akun_bayar."', 'terima_uang','".$total_semuanya."','0','".$noUrut."')";
        mysqli_query($connect, $sql_kirim);

    $product1 = array_filter( $nama_pajak_total );
    $sum = count($product1);
    if($sum > 0)
    {

        $hasil = array(); //-----------------------------pertama jadikan object json dulu
        foreach ($nama_pajak_total as $id => $key) 
        {
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



        //--------------------------

        $uang_pajak_total1 = array_column($amount, 'uang'); //nama_pajak_patokan
        $nama_pajak_total1 = array_column($amount, 'nama'); //nama_pajak_patokan

            foreach ($nama_pajak_total1 as $key => $value) 
            {
                if($uang_pajak_total1[$key] > 0)
                {
                    $arr = explode("|", $nama_pajak_total1[$key], 2);
                    $nama_pajak_saja = $arr[0];
                    $pajak_masukkan = "SELECT akun_pajak_pembelian from pajak where nama_pajak='".$nama_pajak_saja."'";
                    $hasil_query = mysqli_query($connect,$pajak_masukkan);
                    $data_pajak = mysqli_fetch_array($hasil_query);

                    $sql_insert_pajak_baru2 = "INSERT INTO `transaksi`(`kode_transaksi`,`kode_akun`, `kolom`, `kredit`, `no`, `nama_pajak_ori`,`tgl_transaksi`, `harga_pajak`, `nama_pajak`) VALUES('".$nomor_transaksi."', '".$data_pajak['akun_pajak_pembelian']."', 'terima_uang_pajak', '".$uang_pajak_total1[$key]."', '".$noUrut."', '".$nama_pajak_total1[$key]."', '".$tgl_transaksi."', '".$uang_pajak_total[$key]."', '".$data_pajak['akun_pajak_pembelian']."')";
                    mysqli_query($connect,$sql_insert_pajak_baru2);
                }
                else
                {
                    continue;
                }
            }
    }




    foreach ($akun_val as $key => $value) 
    {
        $arr = explode("|", $nama_pajak_total[$key], 2);
        $nama_pajak_saja = $arr[0];
        $pajak_masukkan = "SELECT akun_pajak_pembelian from pajak where nama_pajak='".$nama_pajak_saja."'";
        $hasil_query = mysqli_query($connect,$pajak_masukkan);
        $data_pajak = mysqli_fetch_array($hasil_query);

        $sql_kirim1 = "INSERT INTO `transaksi`(`kode_transaksi`, `tgl_transaksi`, `kode_akun`, `kolom`, `debit`, `kredit`, `no`, `nama_pajak`, `harga_pajak`, `nama_pajak_ori`) VALUES ('".$nomor_transaksi."', '".$tgl_transaksi."', '".$akun_val[$key]."', 'terima_uang','0', '".$uang_val[$key]."', '".$noUrut."', '".$data_pajak['akun_pajak_pembelian']."', '".$uang_pajak_total[$key]."', '".$nama_pajak_total[$key]."')";
        mysqli_query($connect, $sql_kirim1);   
    }
    echo json_encode(['code'=>'berhasil', 'msg'=>'berhasil']);
	exit;
}


echo json_encode(['code'=>'gagal', 'msg'=>$errorMSG]);
?>