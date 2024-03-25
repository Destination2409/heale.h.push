<?php
include("../conn.php");
session_start();
$val = '';
$val .= "status='".$_POST["editstatus"]."',";
$val .= "updated_at='".date("Y-m-d h:i:s")."'";
$qry = $conn->query("UPDATE `order` SET $val WHERE id = '".$_POST["editid"]."'");
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