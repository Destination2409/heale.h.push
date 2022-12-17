<?php
include("../conn.php");
session_start();
$val = '';
$val .= "name='".$_POST["editname"]."',";
$val .= "updated_at='".date("Y-m-d h:i:sa")."'";
$qry = $conn->query("UPDATE product_type SET $val WHERE id = '".$_POST["editid"]."'");
if($qry){
    $json_data = [
    "status" => 'OK',
    "message" => 'แก้ไขสำเร็จ',
    ];
}else{
    $json_data = [
    "status" => 'ERROR',
    "message" => 'แก้ไขไม่สำเร็จ',
    ];
}
echo json_encode($json_data);
?>