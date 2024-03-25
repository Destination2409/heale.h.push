<?php
include("../conn.php");
session_start();
$val = '';
$val .= '"'.$_POST["name"].'",';
$val .= '"'.date("Y-m-d h:i:s").'",';
$val .= '"'.date("Y-m-d h:i:s").'"';
$qry = $conn->query("INSERT INTO product_type(name,created_at,updated_at) VALUES($val)");

if($qry){
    $json_data = [
    "status" => 'OK',
    "message" => 'เพิ่มสำเร็จ',
    ];
}else{
    $json_data = [
    "status" => 'ERROR',
    "message" => 'เพิ่มไม่สำเร็จ',
    ];
}
echo json_encode($json_data);
?>