<?php
include('../../../../config/connect.php'); 

$kontak = $_POST['kontak'];
$tgl_transaksi = $_POST['tgl_transaksi']; 
$nomor_transaksi = $_POST['nomor_transaksi'];

$nama_produk = $_POST['nama_produk'];
$quantity = $_POST['quantity'];
$harga_satuan = $_POST['harga_satuan'];
$jumlah_uang_produk = $_POST['jumlah_uang_produk'];

$errorMSG = "";

if (empty($kontak)) 
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

foreach ($nama_produk as $key => $value) {
    if (empty($value)) 
    {
         $errorMSG = "akun_kirim is required";
    }
}

foreach ($quantity as $key => $value) {
    if (empty($value)) 
    {
         $errorMSG .= "satuan is required";
    }
}

foreach ($jumlah_uang_produk as $key => $value) {
    if (empty($value)) 
    {
         $errorMSG .= "satuan is required";
    }
}

foreach ($quantity as $key => $value) {
    if (empty($value)) 
    {
         $errorMSG .= "satuan is required";
    }
}

if(empty($errorMSG)){

    $kontak = $_POST['kontak'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat']; 
    $tgl_transaksi = $_POST['tgl_transaksi'];  
    $tgl_tempo = $_POST['tgl_tempo'];
    $syarat_pembayaran = $_POST['syarat_pembayaran']; 
    $nomor_transaksi = $_POST['nomor_transaksi'];
    $no_ref_pelanggan = $_POST['no_ref_pelanggan']; 
    $pesan = $_POST['pesan']; 
    $memo = $_POST['memo']; 
    $kode_rahasia = $_POST['kode_rahasia'];
    $total_semuanya = $_POST['total_semuanya'];
    // $tag = $_POST['tag'];

    $total_semuanya = $_POST['total_semuanya'];
    $nama_produk = $_POST['nama_produk'];
    $quantity = $_POST['quantity'];
    $uang_pajak = $_POST['uang_pajak'];
    $nama_pajak = $_POST['nama_pajak'];
    $harga_satuan = $_POST['harga_satuan'];
    $jumlah_uang_produk = $_POST['jumlah_uang_produk'];

    $sdh_dibayar = $_POST['sdh_dibayar'];
    $tagihan_baru = $total_semuanya-$sdh_dibayar;

     $query = "SELECT no as kode_child from transaksi_akun where kode_transaksi='".$kode_rahasia."'";
    $hasil = mysqli_query($connect,$query);
    $data = mysqli_fetch_array($hasil);
    $kodeBarang = $data['kode_child'];
    $noUrut = (int)$kodeBarang;

    $sql = "UPDATE `transaksi_produk` SET `pelanggan`='".$kontak."', `tgl_transaksi`='".$tgl_transaksi."', `kode`='".$nomor_transaksi."', `tgl_tempo`='".$tgl_tempo."', `syarat_pembayaran`='".$syarat_pembayaran."', `memo`='".$memo."' , `pesan`='".$pesan."', `sisa_tagihan`='".$tagihan_baru."', `total`='".$total_semuanya."' WHERE kode='".$kode_rahasia."'";
    mysqli_query($connect, $sql);


   

    $product1 = array_filter( $nama_pajak );
    $sum = count($product1);

    $sql_hapus =  "DELETE FROM `transaksi` where `kode_transaksi`='".$kode_rahasia."'";
        mysqli_query($connect, $sql_hapus);
        
    $sql_kirim = "INSERT INTO `transaksi`(`kode_transaksi`, `kode_akun`, `kolom`, `debit`, `kredit`, `no` ,`syarat_pembayaran`, `tgl_transaksi`) VALUES ('".$nomor_transaksi."', '1-10100 | Piutang Usaha', 'penjualan', '".$total_semuanya."' ,'0','".$noUrut."', '".$syarat_pembayaran."', '".$tgl_transaksi."')";
        mysqli_query($connect, $sql_kirim);

    if($sum > 0)
    {
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

        $uang_pajak_total1 = array_column($amount, 'uang');
        $nama_pajak_total1 = array_column($amount, 'nama');

        foreach ($nama_pajak_total1 as $key=>$isi) 
        {
            if($uang_pajak_total1[$key] > 0)
            {
                  $arr = explode("|", $nama_pajak_total1[$key], 2);
                  $nama_pajak_saja = $arr[0];
                  $pajak_masukkan = "SELECT akun_pajak_penjualan from pajak where nama_pajak='".$nama_pajak_saja."'";
                  $hasil_query = mysqli_query($connect,$pajak_masukkan);
                  $data_pajak = mysqli_fetch_array($hasil_query);

                    $sql_kirim1 = "INSERT INTO `transaksi`(`kode_transaksi`, `kode_akun`, `kolom`, `debit`, `kredit`, `no`,`syarat_pembayaran` , `nama_pajak_ori`, `tgl_transaksi`) VALUES ('".$nomor_transaksi."', '".$data_pajak['akun_pajak_penjualan']."', 'penjualan_pajak','0', '".$uang_pajak_total1[$key]."','".$noUrut."', '".$syarat_pembayaran."', '".$nama_pajak_total1[$key]."', '".$tgl_transaksi."')"; 
                mysqli_query($connect, $sql_kirim1); 
            }
            else
            {  
                continue;
            }
        }
    } 
    



    foreach ($nama_produk as $key => $value) 
    {
        $arr = explode("|", $nama_produk[$key], 2);
        $kode_produk_saja = $arr[0];
        $query_masukkan = "SELECT * from produk where kode_produk='".$kode_produk_saja."'";
        $hasil_query2 = mysqli_query($connect,$query_masukkan);
        $data_produk = mysqli_fetch_array($hasil_query2);

        $arr = explode("|", $nama_pajak[$key], 2);
        $nama_pajak_saja = $arr[0];
        $pajak_masukkan = "SELECT akun_pajak_penjualan from pajak where nama_pajak='".$nama_pajak_saja."'";
        $hasil_query = mysqli_query($connect,$pajak_masukkan);
        $data_pajak = mysqli_fetch_array($hasil_query);

        $sql_kirim1 = "INSERT INTO `transaksi`(`kode_transaksi`, `kode_akun`, `kolom`, `debit`, `kredit`, `no`, `nama_pajak`, `harga_pajak`, `jumlah_uang`, `qty_produk`, `nama_produk`, `nama_pajak_ori`,`syarat_pembayaran`, `tgl_transaksi`) VALUES ('".$nomor_transaksi."', '".$data_produk['akun_jual']."', 'penjualan','0', '".$jumlah_uang_produk[$key]."','".$noUrut."', '".$data_pajak['akun_pajak_penjualan']."', '".$uang_pajak[$key]."', '".$harga_satuan[$key]."', '".$quantity[$key]."', '".$nama_produk[$key]."',  '".$nama_pajak[$key]."', '".$syarat_pembayaran."', '".$tgl_transaksi."')";
        mysqli_query($connect, $sql_kirim1);   
    }
     echo json_encode(['code'=>'berhasil', 'msg'=>'berhasil']);
	exit;
}
echo json_encode(['code'=>'gagal', 'msg'=>$errorMSG]);

?>