<?php
include('../../../../config/connect.php');


$setor_ke = $_POST['setor_ke'];
$kontak = $_POST['kontak'];
$id_transaksi = $_POST['no_transaksi']; 

$akun = $_POST['akun_terima']; 
$uang = $_POST['uang']; 

$errorMSG = "";

if (empty($setor_ke)) 
    {
         $errorMSG .= "satuan is required";
    }

    if (empty($kontak)) 
    {
         $errorMSG .= "satuan is required";
    }

    if (empty($id_transaksi)) 
    {
         $errorMSG .= "satuan is required";
    }


foreach ($akun as $key => $value) {
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

    $setor_ke = $_POST['setor_ke'];
    $kontak = $_POST['kontak'];
    $tanggalan = $_POST['tanggalan'];
    $id_transaksi = $_POST['no_transaksi']; 
    // $tag = implode($_POST['tag']);
    $akun = $_POST['akun_terima']; 
    $pajak = $_POST['pajak']; 
    $uang = $_POST['uang']; 
    // $deskripsi = $_POST['deskripsi'];
    $total_semua = $_POST['total_semua']; 
    $nama_pajak=$_POST['nama_pajak'];

    $sql ="INSERT INTO `transaksi_akun`(`no`, `kontak`, `kode_transaksi`, `tgl_transaksi`) VALUES ('NULL', '".$kontak."','".$id_transaksi."', '".$tanggalan."')";
    mysqli_query($connect, $sql);


   
    $product1 = array_filter( $nama_pajak );
    $sum = count($product1);


    $query = "SELECT no as kode_child from transaksi_akun where kode_transaksi='".$id_transaksi."'";
    $hasil = mysqli_query($connect,$query);
    $data = mysqli_fetch_array($hasil);
    $kodeBarang = $data['kode_child'];
    $noUrut = (int)$kodeBarang; 

     $sql_kirim = "INSERT INTO `transaksi`(`kode_transaksi`, `tgl_transaksi`, `kode_akun`, `kolom`, `debit`, `kredit`, `no`) VALUES ('".$id_transaksi."', '".$tanggalan."', '".$setor_ke."', 'terima_uang', '".$total_semua."' ,'0','".$noUrut."')";
        mysqli_query($connect, $sql_kirim);


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

            //--------------------untuk insert pajak kredit
        foreach ($nama_pajak2 as $key=>$isi) 
        {
            $arr = explode("|", $nama_pajak2[$key], 2);
            $nama_pajak_saja = $arr[0];
            $pajak_masukkan = "SELECT akun_pajak_pembelian from pajak where nama_pajak='".$nama_pajak_saja."'";
            $hasil_query = mysqli_query($connect,$pajak_masukkan);
            $data_pajak = mysqli_fetch_array($hasil_query); 

            $sql_kirim1 = "INSERT INTO `transaksi`(`kode_transaksi`, `tgl_transaksi`, `kode_akun`, `kolom`, `debit`, `kredit`, `no`, `nama_pajak_ori`) VALUES ('".$id_transaksi."', '".$tanggalan."', '".$data_pajak['akun_pajak_pembelian']."', 'terima_uang_pajak','0', '".$uang_pajak2[$key]."', '".$noUrut."', '".$nama_pajak2[$key]."')";
            mysqli_query($connect, $sql_kirim1);   
        }

    } 

   


    foreach ($akun as $key => $value) 
    {
        $nama_pajak[$key]." | ";
        $arr = explode("|", $nama_pajak[$key], 2);
        $nama_pajak_saja = $arr[0];
        $pajak_masukkan = "SELECT akun_pajak_pembelian from pajak where nama_pajak='".$nama_pajak_saja."'";
        $hasil_query = mysqli_query($connect,$pajak_masukkan);
        $data_pajak = mysqli_fetch_array($hasil_query); 
        $sql_kirim1 = "INSERT INTO `transaksi`(`kode_transaksi`, `tgl_transaksi`, `kode_akun`, `kolom`, `debit`, `kredit`, `no`, `nama_pajak`, `harga_pajak`, `nama_pajak_ori`) VALUES ('".$id_transaksi."', '".$tanggalan."', '".$akun[$key]."', 'terima_uang','0', '".$uang[$key]."', '".$noUrut."', '".$data_pajak['akun_pajak_pembelian']."', '".$pajak[$key]."', '".$nama_pajak[$key]."')";
        mysqli_query($connect, $sql_kirim1);   
    }
    echo json_encode(['code'=>'berhasil', 'msg'=>'berhasil']);
	exit;
}
echo json_encode(['code'=>'gagal', 'msg'=>$errorMSG]);


?>