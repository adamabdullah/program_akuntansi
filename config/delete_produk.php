<?php 
include('connect.php');


if(empty($_POST))
{
    header('Location: /faktur_v2/');
    exit; 
}else{
    $kode = $_POST['kode'];
}
$sql_delete_produk = "DELETE FROM produk WHERE kode_produk = '$kode'";

$query = mysqli_query($connect, $sql_delete_produk);

if(!$query){

    printf("Errormessage: %s\n", mysqli_error($query));

}else{

    echo "Success";

}

?>