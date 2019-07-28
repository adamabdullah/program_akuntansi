<?php 
include("../connect.php");

if(!empty($_POST['kode'])){
    $success = 1;
    $kode = $_POST['kode'];
    $createdate = $_POST['terima'];

    //array
    $tgl = $_POST['tgl'];
    $deskripsi = $_POST['deskripsi'];
    $debit = $_POST['debit'];
    $kredit = $_POST['kredit'];

    foreach($tgl as $key => $value){
       $sql_insert = "INSERT INTO `rekening_koran`( `kode`, `tgl`, `deskripsi`, `debit`, `kredit`, `status`, `created_at`) VALUES ('$kode', '$value', '$deskripsi[$key]', $debit[$key], $kredit[$key], 'belum', '$createdate')";
       $query_insert = mysqli_query($connect, $sql_insert);
       if(!$query_insert){
           $success = $success * 0;
           echo 'a';
       }
    }
    if($success >0){
        echo "success";
    }

}else{
    header("Location:/faktur_v2/");
}


?>