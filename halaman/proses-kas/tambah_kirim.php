<?php
foreach($_POST['query'] as $key=>$value) 
{ 
	echo $value[$key];
    // $surat[$key] = substr($value, strpos($value, "-") + 1);  
    // echo $value[$key] = strstr($value, '-', true); 
    // if($keterangan[$key] == "salah")
    // {
    //     $isi .='Surat = '.$surat[$key].' , Ketarangan = '.$keterangan[$key].'<br> ';
    // }
  
}
?>