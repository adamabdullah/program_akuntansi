<?php 
include('connect.php');  
$select_dept = "SELECT * FROM tag";
$q_select_dept1 = mysqli_query($connect, $select_dept);
$q_select_dept2 = mysqli_query($connect, $select_dept);
$q_select_dept3 = mysqli_query($connect, $select_dept);

$select_bankstatement = "SELECT *,max(ExtractNumber(kode)) as nom FROM rekening_koran";
$q_select_bankstatement1 = mysqli_query($connect, $select_bankstatement);
$q_select_bankstatement2 = mysqli_query($connect, $select_bankstatement);
$q_select_bankstatement3 = mysqli_query($connect, $select_bankstatement);

?>