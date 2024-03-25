<?php
include("../conn.php");
session_start();
$val = '';
$val .= "status=2,";
$val .= "updated_at='".date("Y-m-d h:i:s")."'";
$qry = $conn->query("UPDATE `order` SET $val WHERE id = '".$_POST["editid"]."'");
if($qry){
    $json_data = [
    "status" => 'OK',
    "message" => 'ยกเลิกสำเร็จ',
    ];
}else{
    $json_data = [
    "status" => 'ERROR',
    "message" => 'ยกเลิกไม่สำเร็จ',
    ];
}
echo json_encode($json_data);
?>