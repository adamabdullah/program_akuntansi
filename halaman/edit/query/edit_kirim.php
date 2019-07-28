<?php 
include("../../../config/connect.php");

if(!empty($_POST)){
    $kode = $_POST['kode'];
    $_POST['pengirim'];
    $kontak = $_POST['kontak'];
    $tgl = $_POST['tgl']; 
    $_POST['kredit'];

    //--------------------------------update transaksi_akun-----------------------//
    $update_tAkun = "UPDATE transaksi_akun set `kontak` = '$kontak', `tgl_transaksi` = '$tgl' WHERE kode_transaksi = '$kode' ";
    mysqli_query($connect, $update_tAkun);
    
    //--------------------------------update transaksi_akun-----------------------//
    

    $arrPenerima = (array) $_POST['arrPenerima'];
    $arrTax = (array) $_POST['arrTax'];
    $arrNameTax = (array) $_POST['arrNameTax'];

    foreach($arrPenerima as $key => $value)
    {
        echo $arrNameTax[$key];
    }
    
   


    

}else{
    header("Location: /faktur_v2/");
}


?>