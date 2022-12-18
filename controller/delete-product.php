<?php
include("../conn.php");
session_start();
$qry = $conn->query("DELETE FROM product WHERE id = '".$_POST["editid"]."'");

if($qry){
    $json_data = [
    "status" => 'OK',
    "message" => 'ลบสำเร็จ',
    ];
}else{
    $json_data = [
    "status" => 'ERROR',
    "message" => 'ลบไม่สำเร็จ',
    ];
}
echo json_encode($json_data);
?>