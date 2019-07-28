<?php
include('../../../../config/connect.php');

$akun_bayar				= $_POST['akun_bayar'];
$nomor_transaksi		= $_POST['no_biaya'];
$penerima				= $_POST['penerima'];
$tgl_transaksi			= $_POST['tgl_transaksi']; 

$akun_val = $_POST['akun_val'];
$uang_val = $_POST['uang_val'];

$errorMSG = "";

if (empty($akun_bayar)) 
    {
         $errorMSG .= "satuan is required";
    }

    if (empty($penerima)) 
    {
         $errorMSG .= "satuan is required";
    }

    if (empty($nomor_transaksi)) 
    {
         $errorMSG .= "satuan is required";
	}
	
	if (empty($tgl_transaksi)) 
    {
         $errorMSG .= "satuan is required";
    }


foreach ($akun_val as $key => $value) {
    if (empty($value)) 
    {
         $errorMSG .= "akun_kirim is required";
    }
}

foreach ($uang_val as $key => $value) {
    if (empty($value)) 
    {
         $errorMSG .= "satuan is required";
    }
}

if(empty($errorMSG)){

$akun_bayar				= $_POST['akun_bayar'];
$total_semuanya	= $_POST['total_uang_tnpa_koma'];
$tgl_transaksi			= $_POST['tgl_transaksi']; 
$cara_pembayaran = $_POST['cara_pembayaran'];
// $tgl_tempo				=  

$nomor_transaksi		= $_POST['no_biaya'];
$penerima				= $_POST['penerima'];  

$memo					= $_POST['memo'];
// $deskripsi_lama			= $_POST['deskripsi_lama'];


$kode_rahasia 			= $_POST['kode_rahasia'];
$nama_pajak_total		= $_POST['nama_pajak_total'];
$uang_pajak_total		= $_POST['uang_pajak_total'];

$akun_val = $_POST['akun_val'];
$uang_val = $_POST['uang_val'];



// print_r($nama_pajak_patokan);
// print_r($nama_pajak_total);
$sql = "UPDATE `transaksi_akun` SET `kontak`='".$penerima."', `tgl_transaksi`='".$tgl_transaksi."', `kode_transaksi`='".$nomor_transaksi."', `memo`='".$memo."', `cara_pembayaran`='".$cara_pembayaran."' WHERE kode_transaksi='".$kode_rahasia."'";
mysqli_query($connect, $sql);

$sql_hapus = "DELETE from transaksi where kode_transaksi='".$kode_rahasia."'";
mysqli_query($connect, $sql_hapus);

$query = "SELECT no as kode_child from transaksi_akun where kode_transaksi='".$kode_rahasia."'";
$hasil = mysqli_query($connect,$query);
$data = mysqli_fetch_array($hasil);
$kodeBarang = $data['kode_child'];
$noUrut = (int)$kodeBarang; 

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

		$uang_pajak2 = array_column($amount, 'uang'); //nama_pajak_lama
		$nama_pajak2 = array_column($amount, 'nama');	

		foreach ($nama_pajak2 as $key=>$isi) 
	    {
	    	if($nama_pajak2 != '')
	    	{
	    		$arr = explode("|", $nama_pajak2[$key], 2);
		        $nama_pajak_saja = $arr[0];
		        $pajak_masukkan = "SELECT akun_pajak_pembelian from pajak where nama_pajak='".$nama_pajak_saja."'";
		        $hasil_query = mysqli_query($connect,$pajak_masukkan);
		        $data_pajak = mysqli_fetch_array($hasil_query); 

		        $sql_kirim1 = "INSERT INTO `transaksi`(`kode_transaksi`, `kode_akun`, `kolom`, `debit`, `kredit`, `no`, `nama_pajak_ori`, `tgl_transaksi`) VALUES ('".$nomor_transaksi."', '".$data_pajak['akun_pajak_pembelian']."', 'biaya_pajak', '".$uang_pajak2[$key]."', '0','".$noUrut."', '".$nama_pajak2[$key]."', '".$tgl_transaksi."')";
		        mysqli_query($connect, $sql_kirim1);   	
	    	}
	    	else
	    	{
	    		continue;
	    	}

	    }	
    }

//untuk akun
foreach ($akun_val as $key => $value) 
{

    $arr = explode("|", $nama_pajak_total[$key], 2);
    $nama_pajak_saja = $arr[0];
    $pajak_masukkan = "SELECT akun_pajak_pembelian from pajak where nama_pajak='".$nama_pajak_saja."'";
    $hasil_query = mysqli_query($connect,$pajak_masukkan);
    $data_pajak = mysqli_fetch_array($hasil_query); 

    $sql_biaya = "INSERT INTO `transaksi`(`kode_transaksi`, `kode_akun`, `kolom`, `debit`, `kredit`, `no`, `nama_pajak`, `harga_pajak`, `nama_pajak_ori`, `tgl_transaksi`) VALUES ('".$nomor_transaksi."', '".$akun_val[$key]."', 'biaya', '".$uang_val[$key]."', '0', '".$noUrut."', '".$data_pajak['akun_pajak_pembelian']."', '".$uang_pajak_total[$key]."', '".$nama_pajak_total[$key]."', '".$tgl_transaksi."')";
    mysqli_query($connect, $sql_biaya);  
}

$sql_kirim = "INSERT INTO `transaksi`(`kode_transaksi`, `kode_akun`, `kolom`, `debit`, `kredit`, `no`, `tgl_transaksi`) VALUES ('".$nomor_transaksi."', '".$akun_bayar."', 'biaya', '0', '".$total_semuanya."', '".$noUrut."', '".$tgl_transaksi."')";
	mysqli_query($connect, $sql_kirim);
	echo json_encode(['code'=>'berhasil', 'msg'=>'berhasil']);
	exit;
}
echo json_encode(['code'=>'gagal', 'msg'=>$errorMSG]);




?>