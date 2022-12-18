<?php
include("../conn.php");
session_start();
$val = '';
$val .= '"'.$_POST["amount"].'",';
$val .= '"'.$_POST["product_id"].'",';
$val .= '"'.$_POST["customer_id"].'",';
$val .= '"'.date("Y-m-d h:i:sa").'",';
$val .= '"'.date("Y-m-d h:i:sa").'"';

$qry = $conn->query("INSERT INTO `order`(amount,product_id,customer_id,created_at,updated_at) VALUES($val)");

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